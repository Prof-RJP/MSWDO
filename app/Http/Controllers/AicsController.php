<?php

namespace App\Http\Controllers;

use App\Models\Aics;
use App\Models\Clients;
use Illuminate\Http\Request;

class AicsController extends Controller
{
    public function show(Request $request)
    {
        // Get search and sort parameters
        $search = $request->input('q');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        // Build query
        $query = Aics::with('client');

        // Filter by client name if search query exists
        if ($search) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                  ->orWhere('mname', 'like', "%{$search}%")
                  ->orWhere('lname', 'like', "%{$search}%");
            });
        }

        // Sort by selected column
        if (in_array($sort, ['id', 'client_id', 'principal_client', 'gis', 'created_at'])) {
            $query->orderBy($sort, $direction);
        }

        // Execute query
        $aics = $query->paginate(10); // Use pagination for better performance

        return view('admin.aics', compact('aics', 'search', 'sort', 'direction'));
    }

    public function create()
    {
        $clients = Clients::all();
        return view('admin.aics.add-aics', compact('clients'));
    }

    public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'principal_client' => 'required|string|max:100',
        'diagnosis' => 'required|string|max:100',
        'gis' => 'required|string|max:100', // must specify assistance type
    ]);

    // Check last AICS record for the same client and same type of assistance
    $lastAics = Aics::where('client_id', $request->client_id)
        ->where('gis', $request->gis)
        ->latest('created_at')
        ->first();

    if ($lastAics) {
        $monthsSinceLast = now()->diffInMonths($lastAics->created_at);

        // If less than 3 months since last assistance, block creation
        if ($monthsSinceLast < 3) {
            return redirect()->back()->withInput()->with('error',
                "This client is not yet eligible for another {$request->gis}. Please wait until 3 months have passed.");
        }
    }

    // Create new AICS record
    Aics::create([
        'client_id' => $request->client_id,
        'principal_client' => $request->principal_client,
        'diagnosis' => $request->diagnosis,
        'gis' => $request->gis,
    ]);

    return redirect()->route('admin.AICS')->with('success', 'AICS record added successfully.');
}


    public function edit($id)
    {
        $aics = Aics::findOrFail($id);
        $clients = Clients::all();
        return view('admin.aics.edit-aics', compact('aics', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'principal_client' => 'required|string|max:100',
            'diagnosis' => 'required|string|max:100',
            'gis' => 'nullable|string|max:100',
            'created_at' => 'nullable|date',
        ]);

        $aics = Aics::findOrFail($id);

        $aics->update([
            'client_id' => $request->client_id,
            'principal_client' => $request->principal_client,
            'diagnosis' => $request->diagnosis,
            'gis' => $request->gis,
            'created_at' => $request->created_at,
        ]);

        return redirect()->route('admin.AICS')
                         ->with('success', 'AICS record updated successfully.');
    }
}

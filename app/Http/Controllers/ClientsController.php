<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Aics;
use App\Models\Barangay;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'desc');

        // Validate sorting direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Query with optional search filter
        $query = Clients::query()
        ->join('barangays', 'clients.brgy_id', '=', 'barangays.id')
        ->select('clients.*','barangays.*');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('clients.fname', 'like', "%{$search}%")
                  ->orWhere('clients.mname', 'like', "%{$search}%")
                  ->orWhere('clients.lname', 'like', "%{$search}%")
                  ->orWhere('barangays.barangay', 'like', "%{$search}%")
                  ->orWhere('clients.contact', 'like', "%{$search}%");
                //   $q->where('clients.fname', 'like', "%{$search}%")
                //   ->orWhere('clients.mname', 'like', "%{$search}%")
                //   ->orWhere('clients.lname', 'like', "%{$search}%")
                //   ->orWhere('barangay.barangay', 'like', "%{$search}%")
                //   ->orWhere('clients.contact', 'like', "%{$search}%");
            });
        }

        // Add sorting
        if (in_array($sortField, ['clients.id', 'fname','mname', 'lname', 'brgy_id', 'contact'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Optional accessor for full name in model
        $clients = $query->paginate(20)->appends($request->query());
        $barangay = Barangay::all();
        return view('admin.clients', compact('clients', 'sortField', 'sortDirection', 'search', 'barangay'));
    }
    public function create()
    {
        $barangay = Barangay::all();
        return view('admin.client.add-client',compact('barangay'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['nullable', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'civil_status' => ['required','string','max:50'],
            'occupation' => ['nullable','string','max:100'],
            'brgy_id' => ['required'],
            'contact' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255'],
            'educational_attainment' => ['nullable','string','max:100'],
        ]);

        Clients::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'birthdate' => $request->birthdate,
            'civil_status' => $request->civil_status,
            'occupation' => $request->occupation,
            'educational_attainment' => $request->educational_attainment,
            'brgy_id' => $request->brgy_id,
            'contact' => $request->contact,
            'gender' => $request->gender,
        ]);
        return redirect()->route('admin.client')->with('success', 'Successfully added client');
    }

    public function view(Clients $client)
    {
        $aics = $client->aics()->with('client')->get();
        return view('admin.client.view-client', compact('aics'));
    }

    public function edit($id)
    {
        $client = Clients::findOrFail($id);
        $barangay = Barangay::all();
        return view('admin.client.edit-client', compact('client', 'barangay'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['nullable', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'civil_status' => ['required','string','max:50'],
            'occupation' => ['nullable','string','max:100'],
            'brgy_id' => ['required'],
            'contact' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'string', 'max:255'],
            'educational_attainment' => ['nullable','string','max:100'],

        ]);

        $client = Clients::findOrFail($id);

        // Update client
        $client->update($validated);
        return redirect()->route('admin.client')
            ->with('success', 'Client updated successfully!');
    }
}

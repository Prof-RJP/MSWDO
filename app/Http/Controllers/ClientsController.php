<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Aics;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        // Validate sorting direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Query with optional search filter
        $query = Clients::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                  ->orWhere('mname', 'like', "%{$search}%")
                  ->orWhere('lname', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%");
            });
        }

        // Add sorting
        if (in_array($sortField, ['id', 'fname', 'lname', 'address', 'contact'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Optional accessor for full name in model
        $clients = $query->paginate(10)->appends($request->query());

        return view('admin.clients', compact('clients', 'sortField', 'sortDirection', 'search'));
    }
    public function create()
    {
        return view('admin.client.add-client');
    }
    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['nullable', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'civil_status' => ['required','string','max:50'],
            'occupation' => ['nullable','string','max:100'],
            'address' => ['required', 'string', 'max:255'],
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
            'address' => $request->address,
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
        return view('admin.client.edit-client', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fname' => ['required', 'string', 'max:50'],
            'mname' => ['nullable', 'string', 'max:50'],
            'lname' => ['required', 'string', 'max:50'],
            'civil_status' => ['required','string','max:50'],
            'occupation' => ['nullable','string','max:100'],
            'address' => ['required', 'string', 'max:255'],
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

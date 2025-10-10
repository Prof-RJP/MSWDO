<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Aics;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function show(Request $request)
    {
        $query = Clients::query();

        // Base query with full_name column
        $query = Clients::selectRaw("
            id,
            address,
            contact,
            CASE
                WHEN mname IS NULL OR mname = ''
                THEN CONCAT(lname, ', ', fname)
                ELSE CONCAT(lname, ', ', fname, ' ', mname)
            END as full_name
        ");

        // Search filter (searching in full_name + address + contact)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw("
                    CASE
                        WHEN mname IS NULL OR mname = ''
                        THEN CONCAT(lname, ', ', fname)
                        ELSE CONCAT(lname, ', ', fname, ' ', mname)
                    END LIKE ?
                ", ["%$search%"])
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('contact', 'like', "%$search%");
            });
        }

        // Sorting
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');

        // Make sure only allowed columns can be sorted
        $allowedSorts = ['id', 'full_name', 'address', 'contact'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $clients = $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->appends($request->all());
        return view('admin.clients', compact('clients', 'sortField', 'sortDirection'));
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
            'educational_attainment' => ['nullable','string','max:100'],
        ]);

        Clients::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
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
            'educational_attainment' => ['nullable','string','max:100'],

        ]);

        $client = Clients::findOrFail($id);

        // Update client
        $client->update($validated);
        return redirect()->route('admin.client')
            ->with('success', 'Client updated successfully!');
    }
}

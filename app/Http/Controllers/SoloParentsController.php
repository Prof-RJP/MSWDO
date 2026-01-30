<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Childrens;
use App\Models\Clients;
use App\Models\SoloParents;
use Illuminate\Http\Request;

class SoloParentsController extends Controller
{
    public function show(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $filterBarangay = $request->input('barangay');
        $sortDirection = $request->input('direction', 'desc');
        $filterYear = $request->input('year');


        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $barangays = Barangay::orderBy('barangay', 'asc')->get();

        $query = SoloParents::with(['client']);

        if ($filterYear) {
            $query->whereBetween(
                'solo_parents.applied_date',
                ["{$filterYear}-01-01", "{$filterYear}-12-31"]
            );
        }


        // ✅ Search through relationships
        if ($search) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                    ->orWhere('mname', 'like', "%{$search}%")
                    ->orWhere('lname', 'like', "%{$search}%")
                    ->orWhereHas('barangays', function ($b) use ($search) {
                        $b->where('barangays.barangay', 'like', "%{$search}%");
                    });
            });
        }

        if ($filterBarangay) {
            $query->whereHas('client', function ($q) use ($filterBarangay) {
                $q->where('brgy_id', $filterBarangay);
            });
        }

        // ✅ Sorting
        if ($sortField === 'full_name') {
            $query->join('clients', 'solo_parents.client_id', '=', 'clients.id')
                ->select('solo_parents.*')
                ->orderBy('clients.lname', $sortDirection)
                ->orderBy('clients.fname', $sortDirection);
        } elseif ($sortField === 'barangay') {
            $query->join('clients', 'solo_parents.client_id', '=', 'clients.id')
                ->join('barangays', 'clients.brgy_id', '=', 'barangays.id')
                ->select('solo_parents.*')
                ->orderBy('barangays.barangay', $sortDirection);
        } else {
            $query->orderBy("solo_parents.$sortField", $sortDirection);
        }

        // ✅ Use automatic pagination (no manual)
        $clients = $query->paginate(50)->appends($request->query());

        return view('admin.solo_parents', compact('clients', 'sortField', 'filterYear', 'filterBarangay', 'search', 'barangays', 'sortDirection'));
    }

    public function create()
    {
        $clients = Clients::all();
        return view('admin.soloParents.add-parent', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_no' => 'required|numeric',
            'client_id' => 'required|numeric',
            'case_no' => 'required|numeric',
            'applied_date' => 'required|date',
            'exp_date' => 'required|date',
            'category' => 'required|string',
            'benefits' => 'required|string',
            'solo_status' => 'required|string|max:10',
            'children.*.name' => 'required|string',
            'children.*.birthdate' => 'required|date',
        ]);

        $soloParent = SoloParents::create([
            'id_no' => $request->id_no,
            'case_no' => $request->case_no,
            'client_id' => $request->client_id,
            'applied_date' => $request->applied_date,
            'exp_date' => $request->exp_date,
            'category' => $request->category,
            'benefits' => $request->benefits,
            'solo_status' => $request->solo_status,
        ]);
        foreach ($request->children as $child) {
            Childrens::create([
                'parent_id' => $soloParent->id,
                'name' => $child['name'],
                'birthdate' => $child['birthdate'],
            ]);
        }

        return redirect()->route('admin.soloParents')->with('success', 'Solo Parent added successfully!');
    }

    public function edit($sp_id)
    {
        $soloParent = SoloParents::with('client', 'children')->findOrFail($sp_id);
        $clients = Clients::all();

        return view('admin.soloParents.edit-parent', compact('soloParent', 'clients'));
    }
    public function update(Request $request, $sp_id)
    {
        // ✅ Validate main fields + children fields
        $request->validate([
            'id_no' => 'required|numeric',
            'client_id' => 'required|numeric',
            'case_no' => 'required|numeric',
            'applied_date' => 'required|date',
            'exp_date' => 'required|date',
            'category' => 'required|string',
            'benefits' => 'required|string',
            'solo_status' => 'required|string|max:10',
            'children.*.name' => 'required|string',
            'children.*.birthdate' => 'required|date',
        ]);

        // ✅ Get the existing record
        $soloParent = SoloParents::findOrFail($sp_id);

        // ✅ Update solo parent record
        $soloParent->update([
            'id_no' => $request->id_no,
            'case_no' => $request->case_no,
            'client_id' => $request->client_id,
            'applied_date' => $request->applied_date,
            'exp_date' => $request->exp_date,
            'category' => $request->category,
            'benefits' => $request->benefits,
            'solo_status' => $request->solo_status,
        ]);

        // ✅ DELETE old children first (simple approach)
        Childrens::where('parent_id', $soloParent->id)->delete();

        // ✅ LOOP new children input and insert them again
        foreach ($request->children as $child) {
            Childrens::create([
                'parent_id' => $soloParent->id,  // link to parent
                'name' => $child['name'],
                'birthdate' => $child['birthdate'],
            ]);
        }

        // ✅ Redirect back with success message
        return redirect()->route('admin.soloParents')
            ->with('success', 'Solo Parent updated successfully!');
    }

    public function print(Request $request)
    {
        $search = $request->input('search');
        $barangay = $request->input('barangay');
        $year = $request->input('year'); // ✅ YEAR

        $clients = SoloParents::with(['client', 'client.barangays'])

            // Join clients table so we can sort & filter
            ->join('clients', 'solo_parents.client_id', '=', 'clients.id')
            ->select('solo_parents.*')

            // Barangay filter
            ->when($barangay, function ($query, $barangay) {
                return $query->where('clients.brgy_id', $barangay);
            })

            // Search filter
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('clients.lname', 'like', "%$search%")
                        ->orWhere('clients.fname', 'like', "%$search%");
                });
            })

            // ✅ YEAR filter
            ->when($year, function ($query, $year) {
                return $query->whereYear('solo_parents.applied_date', $year);
            })

            // Sort by barangay
            ->orderBy('clients.brgy_id', 'asc')

            ->get();

        return view(
            'admin.soloParents.print-solo-preview',
            compact('clients', 'year') // ✅ pass year to view
        );
    }
}

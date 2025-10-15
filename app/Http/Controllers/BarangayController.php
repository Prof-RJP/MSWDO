<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function show(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'ASC');

        // sorting validation direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = Barangay::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('barangay', 'like', "%{$search}%");
            });
        }

        // add sorting
        if (in_array($sortField, ['id', 'barangay'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        $barangay = $query->paginate(21)->appends($request->query());

        return view('admin.barangay', compact('barangay', 'sortField', 'sortDirection', 'search'));
    }

    public function create(){
        return view('admin.barangay.add-barangay');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'barangay'=> 'required|string|max:50'
        ]);

        Barangay::create($validated);
        return redirect()->route('admin.barangay')->with('success','Barangay added successfully');
    }
}

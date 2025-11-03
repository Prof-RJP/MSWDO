<?php

namespace App\Http\Controllers;

use App\Models\SoloParents;
use Illuminate\Http\Request;

class SoloParentsController extends Controller
{
    public function show(Request $request){
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'desc');

        // Validate sorting direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = SoloParents::query()
        ->join('clients', 'solo_parents.id', '=', 'clients.id')
        ->join('barangays', 'clients.brgy_id', '=', 'barangays.id')
        ->select('barangays.*', 'clients.*', 'solo_parents.*', 'CONCAT("clients.lname", "clients.fname" "clients.mname") as fullName');

        if($search){
            $query->where(function ($q) use ($search){
                $q->where('fullName', 'like', "%{$search}%")
                    ->orWhere('barangays.barangay', 'like', "%{$search}%");
            });
        }

        if (in_array($sortField, ['solo_parents.id', 'clients.fname','clients.mname', 'clients.lname', 'barangays.barangay'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        // Optional accessor for full name in model
        $soloParents = $query->paginate(20)->appends($request->query());

        return view('admin.solo_parents', compact('soloParents', 'sortField', 'search', 'sortDirection'));
    }
}

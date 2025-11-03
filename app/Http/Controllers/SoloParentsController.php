<?php

namespace App\Http\Controllers;

use App\Models\SoloParents;
use Illuminate\Http\Request;

class SoloParentsController extends Controller
{
    public function show(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'clients.id');
        $sortDirection = $request->input('direction', 'desc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = SoloParents::query()
            ->join('clients', 'solo_parents.client_id', '=', 'clients.id')
            ->join('barangays', 'clients.brgy_id', '=', 'barangays.id')
            ->select(
                'solo_parents.*',
                'clients.id as client_id',
                'clients.fname',
                'clients.mname',
                'clients.lname',
                'barangays.name as address'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('clients.fname', 'like', "%{$search}%")
                  ->orWhere('clients.mname', 'like', "%{$search}%")
                  ->orWhere('clients.lname', 'like', "%{$search}%")
                  ->orWhere('barangays.name', 'like', "%{$search}%");
            });
        }

        $sortable = ['clients.id', 'clients.fname', 'clients.lname', 'barangays.name'];
        if (in_array($sortField, $sortable)) {
            $query->orderBy($sortField, $sortDirection);
        }

        $clients = $query->paginate(20)->appends($request->query());

        return view('admin.solo_parents', compact('clients', 'sortField', 'search', 'sortDirection'));
    }
}

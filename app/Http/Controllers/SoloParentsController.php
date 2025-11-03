<?php

namespace App\Http\Controllers;

use App\Models\SoloParents;
use Illuminate\Http\Request;

class SoloParentsController extends Controller
{
    public function show(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = SoloParents::with(['client.barangay']);

        // ✅ Search through relationships
        if ($search) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                  ->orWhere('mname', 'like', "%{$search}%")
                  ->orWhere('lname', 'like', "%{$search}%")
                  ->orWhereHas('barangay', function ($b) use ($search) {
                      $b->where('name', 'like', "%{$search}%");
                  });
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
                  ->orderBy('barangays.name', $sortDirection);
        } else {
            $query->orderBy("solo_parents.$sortField", $sortDirection);
        }

        // ✅ Use automatic pagination (no manual)
        $clients = $query->paginate(20)->appends($request->query());

        return view('admin.solo_parents', compact('clients', 'sortField', 'search', 'sortDirection'));
    }
}

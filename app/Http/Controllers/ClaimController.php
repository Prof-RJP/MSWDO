<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Claims;
use App\Models\Events;
use App\Models\Seniors;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClaimController extends Controller
{
 
public function index(Request $request, $event_id)
{
    $event = Events::findOrFail($event_id);
    $barangay = Barangay::all();

    $eventMonth = Carbon::parse($event->starts_at)->month;

    // ✅ Get filters
    $search = $request->input('search');
    $barangayFilter = $request->input('barangay');
    $sortField = $request->input('sort', 'lname');
    $sortDirection = $request->input('direction', 'asc');

    // ✅ Query celebrants dynamically
    $celebrants = Seniors::query()
        ->whereMonth('birthdate', $eventMonth)
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                  ->orWhere('lname', 'like', "%{$search}%");
            });
        })
        ->when($barangayFilter, function ($query, $barangayFilter) {
            $query->where('brgy_id', $barangayFilter);
        })
        ->orderBy($sortField, $sortDirection)
        ->get();

    // ✅ Get claims for this event
    $claims = Claims::where('event_id', $event->id)->get();

    return view('admin.events.show-events', compact(
        'event',
        'celebrants',
        'claims',
        'barangay',
        'search',
        'barangayFilter',
        'sortField',
        'sortDirection'
    ));
}


    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'senior_id' => 'required|exists:seniors,id',
        ]);

        Claims::updateOrCreate(
            [
                'event_id' => $request->event_id,
                'senior_id' => $request->senior_id,
            ],
            [
                'status' => 'claimed',
                'claimed_at' => now(),
            ]
        );

        return back()->with('success', 'Marked as Claimed successfully!');
    }
}

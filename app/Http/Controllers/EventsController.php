<?php

// app/Http/Controllers/EventController.php
namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Seniors;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
{
    $query = Events::query();

    // 🔍 Search
    if ($search = $request->input('search')) {
        $query->where('title', 'like', "%{$search}%");
    }

    // ⬇️ Sorting
    $sortField = $request->input('sort', 'starts_at');
    $sortDirection = $request->input('direction', 'desc');

    $events = $query->orderBy($sortField, $sortDirection)->paginate(10);

    return view('admin.events', compact('events', 'sortField', 'sortDirection'));
}



    public function create()
    {
        return view('admin.events.add-event');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'starts_at' => 'required|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
            'description' => 'nullable|string',
        ]);

        Events::create($request->all());

        return redirect()->route('admin.events')->with('success', 'Event created successfully!');
    }
    public function show(Events $event)
    {
        // Get seniors whose birthday month matches the event month
        $month = date('m', strtotime($event->starts_at));
        $celebrants = Seniors::whereMonth('birthdate', $month)->get();
        $events = Events::orderBy('starts_at', 'desc')->get();
        return view('admin.events.show-events', compact('event', 'celebrants', 'events'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Claims;
use App\Models\Seniors;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeniorCetizenController extends Controller
{
    public function show()
    {
        $barangay = Barangay::all();
        return view('admin.senior-cetizens', compact('barangay'));
    }

    public function viewSenior(Request $request, $brgy_id)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'desc');

        // Validate direction to avoid invalid inputs
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = Seniors::with('barangay') // ✅ eager load
            ->where('brgy_id', $brgy_id);  // ✅ filter by barangay

        // ✅ Search logic
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('seniors.fname', 'like', "%{$search}%")
                    ->orWhere('seniors.mname', 'like', "%{$search}%")
                    ->orWhere('seniors.lname', 'like', "%{$search}%")
                    ->orWhere('seniors.birthdate', 'like', "%{$search}%")
                    ->orWhere('seniors.osca_id', 'like', "%{$search}%");
            });
        }

        // ✅ Sorting logic
        if (in_array($sortField, ['id', 'brgy_id', 'fname', 'mname', 'lname', 'birthdate', 'osca_id', 'status'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        $seniors = $query->paginate(50)->appends($request->query());
        $barangay = Barangay::all();

        return view('admin.seniorCetizens.view-seniors', compact(
            'sortField',
            'sortDirection',
            'search',
            'seniors',
            'brgy_id',
            'barangay'
        ));
    }


    public function create(Request $request, $brgy_id)
    {
        $barangay = Barangay::all();
        $age = Carbon::parse($request->birthdate);
        return view('admin.seniorCetizens.add-senior', compact('barangay', 'age', 'brgy_id'));
    }

    public function store(Request $request, $brgy_id)
    {
        $request->validate([
            'fname' => 'required|string|max:50',
            'mname' => 'nullable|string|max:50',
            'osca_id' => 'nullable|string|max:10',
            'lname' => 'required|string|max:50',
            'brgy_id' => 'required|integer|max:50',
            'contact' => 'required|string|max:50',
            'birthdate' => 'required|date|max:50',
            'gender' => 'required|string|max:20',
            'status' => 'required|string|max:10',
            'age' => 'nullable|string|max:10',
        ]);

        $age = Carbon::parse($request->birthdate)->age;
        Seniors::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'osca_id' => $request->osca_id,
            'brgy_id' => $request->brgy_id,
            'contact' => $request->contact,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'status' => $request->status,
            'age' => $age,
        ]);
        return redirect()->route('admin.view-senior', compact('age', 'brgy_id'))->with('success', 'Senior Cetizen added successfully!');
    }
    public function edit(Request $request, $id, $brgy_id)
    {
        $barangay = Barangay::all();
        $age = Carbon::parse($request->birthdate)->age;
        $seniors = Seniors::findOrFail($brgy_id);
        return view('admin.seniorCetizens.update-senior', compact('seniors', 'barangay', 'age', 'id', 'brgy_id'));
    }

    public function update(Request $request, $id, $brgy_id)
    {
        $request->validate([
            'fname' => 'required|string|max:50',
            'mname' => 'nullable|string|max:50',
            'osca_id' => 'nullable|string|max:10',
            'lname' => 'required|string|max:50',
            'brgy_id' => 'required|integer|max:50',
            'contact' => 'required|string|max:50',
            'birthdate' => 'required|date|max:50',
            'gender' => 'required|string|max:20',
            'status' => 'required|string|max:10',
            'age' => 'nullable|string|max:10',
        ]);

        $age = Carbon::parse($request->birthdate)->age;
        $senior = Seniors::findOrFail($id);
        $senior->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'osca_id' => $request->osca_id,
            'brgy_id' => $request->brgy_id,
            'contact' => $request->contact,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'status' => $request->status,
            'age' => $age,
        ]);
        return redirect()->route('admin.view-senior', compact('age', 'brgy_id'))->with('success', 'Senior Cetizen added successfully!');
    }
    public function destroy($brgy_id, $id)
    {
        $senior = Seniors::findOrFail($id);
        $senior->delete();

        return redirect()
            ->route('admin.view-senior', $brgy_id)
            ->with('success', 'Data deleted successfully!');
    }

    public function viewClaims($brgy_id, $senior_id)
    {
        // Get barangay & senior info
        $barangay = Barangay::findOrFail($brgy_id);
        $senior = Seniors::findOrFail($senior_id);

        // Get all claims for this senior (with event details)
        $claims = Claims::with('event')
            ->where('senior_id', $senior_id)
            ->orderBy('claimed_at', 'desc')
            ->paginate(10); // for pagination

        return view('admin.seniorCetizens.view-claims', compact('barangay', 'senior', 'claims'));
    }
}

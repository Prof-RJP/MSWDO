<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
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
        $sortField = $request->input('search', 'id');
        $sortDirection = $request->input('direction', 'asc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $query = Seniors::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                    ->orWhere('mname', 'like', "%{$search}%")
                    ->orWhere('lname', 'like', "%{$search}%")
                    ->orWhere('osca_id', 'like', "%{$search}%");
            });
        }

        if (in_array($sortField, ['id', 'brgy_id', 'fname', 'mname', 'lname', 'osca_id'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        $seniors = $query->paginate(20)->appends($request->query());
        $barangay = Barangay::all();
        return view('admin.seniorCetizens.view-seniors', compact('sortField', 'sortDirection', 'search', 'seniors', 'brgy_id', 'barangay'));
    }

    public function create(Request $request){
        $barangay = Barangay::all();
        $age = Carbon::parse($request->birthdate);
        return view('admin.seniorCetizens.add-senior',compact('barangay','age'));
    }

    public function store(Request $request){
        $request->validate([
            'fname' => 'required|string|max:50',
            'mname' => 'nullable|string|max:50',
            'osca_id' => 'required|integer',
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
        return redirect()->route('admin.senior', compact('age'))->with('success', 'Senior Cetizen added successfully!');

    }
}

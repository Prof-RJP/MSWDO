<?php

namespace App\Http\Controllers;

use App\Models\Aics;
use App\Models\Clients;
use Illuminate\Http\Request;

class AicsController extends Controller
{
    public function show(){
        $aics = Aics::with('client')->get();
        return view('admin.aics', compact('aics'));
    }

    public function create(){
        $clients = Clients::all();
        return view('admin.aics.add-aics', compact('clients'));
    }

    public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'principal_client' => 'required|string|max:100',
        'diagnosis' => 'required|string|max:100',
        'gis' => 'nullable|string|max:100',
    ]);

    Aics::create($request->all());

    return redirect()->route('admin.AICS')->with('success', 'AICS record added successfully.');
}
}

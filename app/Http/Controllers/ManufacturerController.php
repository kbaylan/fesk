<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $manufacturers = Manufacturer::latest()->paginate(10);

        return view('manufacturers.index', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required'
        ]);
    
        Manufacturer::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        //
        return view('manufacturers.show', compact('manufacturers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
        return view('manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required'
        ]);
        
        $manufacturer->name = $request->name;
        $manufacturer->description = $request->description;
        $manufacturer->status = $request->status;
        $manufacturer->save();

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
        $manufacturer->delete();

        return redirect()->route('manufacturers.index')->with('status', 'Manufacturer Delete Successfully');
    }
}

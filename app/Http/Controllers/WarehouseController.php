<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $warehouses = Warehouse::latest()->paginate(10);

        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);
    
        Warehouse::create([
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('warehouses.index')->with('status', 'Warehouse Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
        return view('warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        //
        return view('warehouses.edit', compact('warehouse'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);
        
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->status = $request->status;
        $warehouse->save();

        return redirect()->route('warehouses.index')->with('status', 'Warehouse Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
        $warehouse->delete();

        return redirect()->route('warehouses.index')->with('status', 'Warehouse Delete Successfully');
    }
}

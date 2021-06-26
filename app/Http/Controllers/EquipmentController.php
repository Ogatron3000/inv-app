<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\SerialNumber;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Equipment::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $equipment = Equipment::where('name', 'LIKE', "%$search%")
                ->paginate(Equipment::PAGINATE);
        } else {
            $equipment = Equipment::paginate(Equipment::PAGINATE);
        }

        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage', Equipment::class);

        $categories = EquipmentCategory::all();

        return view('equipment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        $this->authorize('manage', Equipment::class);

        Equipment::query()->create($request->validated());

        return redirect()->route('equipment.index')->with('success_message', 'Equipment added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        $this->authorize('manage', Equipment::class);

        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $this->authorize('manage', Equipment::class);

        $categories = EquipmentCategory::all();

        return view('equipment.edit', compact('categories','equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $this->authorize('manage', Equipment::class);

        $equipment->update($request->validated());

        return redirect()->route('equipment.index')->with('success_message', 'Equipment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $this->authorize('manage', Equipment::class);

        $equipment->delete();

        return redirect()->route('equipment.index')->with('success_message', 'Equipment deleted successfuly.');
    }

    /**
     * @param  \App\Models\Equipment  $equipment
     *
     * @return mixed
     */
    public function serial_numbers(Equipment $equipment)
    {
        return $equipment->serialNumbers()->available()->get();
    }
}

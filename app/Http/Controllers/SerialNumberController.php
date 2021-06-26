<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerialNumberRequest;
use App\Models\Equipment;
use App\Models\SerialNumber;
use Illuminate\Http\Request;

class SerialNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SerialNumberRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SerialNumberRequest $request, Equipment $equipment)
    {
        $this->authorize('manage', SerialNumber::class);

        $attributes = $request->validated();
        $attributes['equipment_id'] = $equipment->id;

        SerialNumber::create($attributes);

        return redirect()->route('equipment.show', $equipment->id)->with('success_message', 'Serial number added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function show(SerialNumber $serialNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SerialNumber  $serialNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(SerialNumber $serialNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SerialNumberRequest  $request
     * @param  \App\Models\Equipment                   $equipment
     * @param  \App\Models\SerialNumber                $serialNumber
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SerialNumberRequest $request, Equipment $equipment, SerialNumber $serialNumber)
    {
        $this->authorize('manage', SerialNumber::class);

        $attributes = $request->validated();

        $serialNumber->update($attributes);

        return redirect()->route('equipment.show', $equipment->id)->with('success_message', 'Serial number updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment     $equipment
     * @param  \App\Models\SerialNumber  $serialNumber
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment, SerialNumber $serialNumber)
    {
        $this->authorize('manage', SerialNumber::class);

        if ( ! $serialNumber->is_used) {
            $serialNumber->delete();
        }

        return redirect()->route('equipment.show', $equipment->id)->with('success_message', 'Serial number deleted successfully.');
    }
}

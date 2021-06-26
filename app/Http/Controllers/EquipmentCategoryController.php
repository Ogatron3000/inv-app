<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentCategoryRequest;
use App\Models\EquipmentCategory;
use Illuminate\Http\Request;

class EquipmentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // search
        if ($request->has('q')) {
            $search = $request->q;
            $equipmentCategories = EquipmentCategory::where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $equipmentCategories = EquipmentCategory::all();
        }

        return view('equipment_categories.index', compact('equipmentCategories'));
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
     * @param  \App\Http\Requests\EquipmentCategoryRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EquipmentCategoryRequest $request)
    {
        $this->authorize('manage', EquipmentCategory::class);

        EquipmentCategory::create($request->validated());

        return redirect()->back()->with('success_message', 'Equipment category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentCategory  $equipmentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentCategory $equipmentCategory)
    {
        return view('equipment_categories.show', compact('equipmentCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentCategory  $equipmentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentCategory $equipmentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentCategoryRequest  $request
     * @param  \App\Models\EquipmentCategory                $equipmentCategory
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentCategoryRequest $request, EquipmentCategory $equipmentCategory)
    {
        $this->authorize('manage', EquipmentCategory::class);

        $equipmentCategory->update($request->validated());

        return redirect()->back()->with('success_message', 'Equipment category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentCategory  $equipmentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentCategory $equipmentCategory)
    {
        $this->authorize('manage', EquipmentCategory::class);

        $equipmentCategory->delete();

        return redirect()->back()->with('success_message', 'Equipment category deleted successfully.');
    }
}

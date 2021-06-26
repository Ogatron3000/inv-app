<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Department::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $departments = Department::where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $departments = Department::all();
        }

        return view('departments.index', compact('departments'));
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
     * @param  \App\Http\Requests\DepartmentRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $this->authorize('manage', Department::class);

        Department::create($request->validated());

        return redirect()->back()->with('success_message', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @param  \App\Models\Department                $department
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $this->authorize('manage', Department::class);

        $department->update($request->validated());

        return redirect()->back()->with('success_message', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->authorize('manage', Department::class);

        $department->delete();

        return redirect()->back()->with('success_message', 'Department deleted successfully.');
    }

    public function positions(Department $department)
    {
        $this->authorize('manage', Department::class);

        return $department->positions;
    }
}

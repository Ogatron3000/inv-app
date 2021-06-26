<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Role::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $roles = Role::where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $roles = Role::all();
        }

        return view('roles.index', compact('roles'));
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
     * @param  \App\Http\Requests\RoleRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('manage', Role::class);

        Role::create($request->validated());

        return redirect()->back()->with('success_message', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Models\Role                $role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('manage', Role::class);

        $role->update($request->validated());

        return redirect()->back()->with('success_message', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('manage', Role::class);

        $role->delete();

        return redirect()->back()->with('success_message', 'Role deleted successfully.');
    }
}

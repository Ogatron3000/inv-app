<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Position::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $positions = Position::where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $positions = Position::all();
        }

        $departments = Department::all();

        return view('positions.index', compact('positions', 'departments'));
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
     * @param  \App\Http\Requests\PositionRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $this->authorize('manage', Position::class);

        Position::create($request->validated());

        return redirect()->back()->with('success_message', 'Position created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PositionRequest  $request
     * @param  \App\Models\Position                $position
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, Position $position)
    {
        $this->authorize('manage', Position::class);

        $position->update($request->validated());

        return redirect()->back()->with('success_message', 'Position updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $this->authorize('manage', Position::class);

        $position->delete();

        return redirect()->back()->with('success_message', 'Position deleted successfully.');
    }
}

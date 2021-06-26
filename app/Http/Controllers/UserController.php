<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Exports\UserEquipmentFileByDepartmentExport;
use App\Exports\UserEquipmentFileByPositionExport;
use App\Exports\UserEquipmentFileBySelectedExport;
use App\Exports\UserEquipmentFileExport;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEquipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $users = User::where('name', 'LIKE', "%$search%")
                ->paginate(User::PAGINATE);
        } else {
            $users = User::query()->paginate(User::PAGINATE);
        }

        $departments = Department::all();
        $positions = Position::all();

        return view('users.index', compact('users', 'departments', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage', User::class);

        $departments = Department::all();
        $roles = Role::all();

        return view('users.create', compact('departments', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->authorize('manage', User::class);

        User::query()->create($request->validated());

        return redirect()->route('users.index')->with('success_message', 'User added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $equipment = Equipment::query()->inStock()->get();
        $userEquipment = $user->items()->paginate(UserEquipment::PAGINATE);

        return view('users.show', compact('user', 'equipment', 'userEquipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('manage', User::class);

        $departments = Department::all();
        $roles = Role::all();

        return view('users.edit', compact('user', 'departments', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User                $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('manage', User::class);

        $user->update($request->validated());

        return redirect()->route('users.index')->with('success_message', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', User::class);

        if ($user->id != auth()->id()){
            $user->delete();

            return redirect()->route('users.index')->with('success_message', 'User deleted successfully.');
        }

        return redirect()->route('users.index');
    }

    public function autocomplete(Request $request)
    {
        $users = [];

        if ($request->has('q')) {
            $search = $request->q;
            $users = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }

        return response()->json($users);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct()
	{
		$this->middleware('permission:create user', ['only' => ['create','store']]);
		$this->middleware('permission:read user', ['only' => ['index']]);
		$this->middleware('permission:update user', ['only' => ['edit','update']]);
		$this->middleware('permission:delete user', ['only' => ['destroy']]);
	}

    public function index(Request $request)
    {
        $filters = $request->only([
            'name'
        ]);

        return inertia(
            'User/Index',
            [
                'filters' => $filters,
                'users' => User::with('roles')
                        ->filter($filters)
                        ->paginate(5)
            ]
        );
    }

    public function create()
    {
        return inertia(
            'User/Create',
            [
                'roles' => Role::paginate()
            ]
        );
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        (new UserService)->storeUser($validated);

        return redirect()->route('users.index')->with('success', 'User was created!');
    }

    public function edit(User $user)
    {
        $roles = Role::paginate();
        $userRoles = $user->roles->pluck('name')->toArray();
// dd($userRoles);
        return inertia(
            'User/Edit',
            [
                'user' => $user,
                'roles' => $roles,
                'userRoles' => $userRoles
            ]
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
// dd($request->roles);
        (new UserService)->updateUser($validated, $user);
    
        return redirect()->route('users.index')->with('success', 'User was updated!');
    }

    public function destroy(User $user)
    {
        $user->deleteOrFail();

        return redirect()->back()->with('success', 'User was deleted!');
    }
}

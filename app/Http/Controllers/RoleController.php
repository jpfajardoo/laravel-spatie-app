<?php

namespace App\Http\Controllers;

use App\Http\Requests\GivePermissionRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
	{
		$this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givepermissionTorole']]);
		$this->middleware('permission:read role', ['only' => ['index']]);
		$this->middleware('permission:update role', ['only' => ['edit','update']]);
		$this->middleware('permission:delete role', ['only' => ['destroy']]);
	}

    public function index(Request $request)
    {
        $filters = $request->only([
            'name'
        ]);

        $roles = Role::when(
                        $filters['name'] ?? false,
                        fn ($query, $value) => $query->where('name', 'LIKE', '%' . $value . '%')
                    )->paginate(5);

        return inertia(
            'Role/Index',
            [
                'filters' => $filters,
                'roles' => $roles
            ]
        );
    }

    public function create()
    {
        return inertia(('Role/Create'));
    }

    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
    	Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Role was created!');
    }

    public function edit(Role $role)
    {
        return inertia(
            'Role/Edit',
            [
                'role' => $role
            ]
        );
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();
        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Role was updated!');
    }

    public function destroy(Role $role)
    {
        $role->deleteOrFail();

        return redirect()->back()->with('success', 'Role was deleted!');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->leftJoin('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('permissions.name')
            ->all();
// dd($rolePermissions);
        return inertia(
            'Role/AddPermission',
            [
                'permissions' => $permissions,
                'role' => $role,
                'rolePermissions' => $rolePermissions
            ]
        );
    }

    public function givePermissionToRole(GivePermissionRequest $request, $roleId)
    {
        $validated = $request->validated();

        $role = Role::findOrFail($roleId);
	    $role->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('success', 'Role permissions was updated!');
    }
}

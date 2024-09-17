<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
	{
		$this->middleware('permission:create permission', ['only' => ['create','store']]);
		$this->middleware('permission:read permission', ['only' => ['index']]);
		$this->middleware('permission:update permission', ['only' => ['edit','update']]);
		$this->middleware('permission:delete permission', ['only' => ['destroy']]);
	}

    public function index(Request $request)
    {
        $filters = $request->only([
            'name'
        ]);

        $permissions = Permission::when(
                        $filters['name'] ?? false,
                        fn ($query, $value) => $query->where('name', 'LIKE', '%' . $value . '%')
                    )->paginate(5);

        return inertia(
            'Permission/Index',
            [
                'filters' => $filters,
                'permissions' => $permissions
            ]
        );
    }

    public function create()
    {
        return inertia(('Permission/Create'));
    }

    public function store(StorePermissionRequest $request)
    {
        $validated = $request->validated();
    	Permission::create($validated);

        return redirect()->route('permissions.index')->with('success', 'Permission was created!');
    }

    public function edit(Permission $permission)
    {
        return inertia(
            'Permission/Edit',
            [
                'permission' => $permission
            ]
        );
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $validated = $request->validated();
        $permission->update($validated);

        return redirect()->route('permissions.index')->with('success', 'Permission was updated!');
    }

    public function destroy(Permission $permission)
    {
        $permission->deleteOrFail();

        return redirect()->back()->with('success', 'Permission was deleted!');
    }
}

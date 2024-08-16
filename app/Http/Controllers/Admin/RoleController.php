<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $permissions = array_map('intval', $request->permissions);
            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Update the specified role in storage
    // public function update(Request $request, Role $role)
    // {
    //     // Validate incoming request
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
    //         'permissions' => 'nullable|array',
    //         'permissions.*' => 'exists:permissions,id', // Validate permission IDs
    //     ]);

    //     // Update the role
    //     $role->update(['name' => $request->name]);

    //     // Sync permissions for the role
    //     if ($request->has('permissions')) {
    //         $role->syncPermissions($request->permissions);
    //     } else {
    //         $role->syncPermissions([]);
    //     }

    //     return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    // }
    public function update(Request $request, Role $role)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id', // Validate permission IDs
        ]);

        // Update the role
        $role->update(['name' => $request->name]);

        // Map permission IDs to permission names
        if ($request->has('permissions')) {
            $permissionIds = $request->permissions;
            $validPermissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

            // Sync permissions by name
            $role->syncPermissions($validPermissionNames);
        } else {
            // Clear all permissions if none are provided
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }


    // Remove the specified role from storage
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    // Display the specified role
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    /************************************************ROLE CRUD***************************************************/

    /**
     * @return roles & permissions
     */
    public function getRolesPermissions()
    {
        $roles = Role::with('permissions')->get();

        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRole()
    {
        $permissions = Permission::latest()->get();

        return view('backend.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        // dd($request->all());
        // Get validation rules

        $validate = $this->create_role_rules($request);

        // // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->selected_permissions);

        // Try user save or catch error if any
        try {
            $role->save();

            return response()->json([
                'success' => true,
                'message' => 'Role Created Successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_role_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRole($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::latest()->get();

        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $role = Role::findById($id);
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->selected_permissions);

        // Try role save or catch error if any
        try {
            $role->save();

            return response()->json([
                'success' => true,
                'message' => 'Role Updated Successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /************************************************PERMISSION CRUD***************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPermission()
    {
        $permissions = Permission::latest()->get();
        $roles = Role::latest()->get();

        return view('backend.permissions.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        // dd($request->selected_roles);
        // Get validation rules

        $validate = $this->create_permission_rules($request);

        // // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        $permission = Permission::create(['name' => $request->name]);
        $permission->assignRole($request->selected_roles);

        $roles = Role::latest()->get();
        $permissions = Permission::latest()->get();

        return view('backend.permissions.create', compact('roles', 'permissions'));

        // // Try permission save or catch error if any
        try {
            $permission->save();

            return response()->json([
                'success' => true,
                'message' => 'Permission Created Successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_permission_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermission($id)
    {
        $permission = Permission::with('roles')->find($id);
        $roles = Role::latest()->get();

        return view('backend.permissions.edit', compact('roles', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findById($id);
        $permission->update(['name' => $request->name]);
        $permission->syncRoles($request->selectedroles);

        // return redirect()->route('roles-permissions');
        // Try permission save or catch error if any
        try {
            $permission->save();

            return response()->json([
                'success' => true,
                'message' => 'Permission Updated Successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $param = [
            'roles' => $roles,
        ];
        return view('backend.roles.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('backend.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);

            $role->permissions()->attach($request->permissions);
            DB::commit();
            return redirect()->route('role.index')->with([
                'success' => 'Thêm role thành công',
            ]);


        } catch (Exception $e) {
            DB::rollback();
            Log::error('error:' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        $rolePermission = DB::table('permission_role')->where('role_id', $id)->pluck('permission_id');
        $param = [
            'permissions' => $permissions,
            'role' => $role,
            'rolePermission' => $rolePermission,
        ];
        return view('backend.roles.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            DB::table('permission_role')->where('role_id', $id)->delete();
            $role->permissions()->attach($request->permissions);
            DB::commit();
            return redirect()->route('role.index')->with([
                'success' => 'Update role successfully',
            ]);


        } catch (Exception $e) {
            DB::rollback();
            Log::error('error:' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();
            $role->users()->detach();
            $role->permissions()->detach();
            DB::commit();
            return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}

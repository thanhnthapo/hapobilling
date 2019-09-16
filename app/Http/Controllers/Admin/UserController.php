<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\CountValidator\Exception;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = [
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department_id,
        ];
        $users = User::with('roles')->search($search)->paginate(config('app.paginate'));
        $departments = Department::all();
        $param = [
            'users' => $users,
            'departments' => $departments,
            'search' => $search,
        ];
//        $departmentId = $request->department_id;
//        $name = $request->name;
//        $email = $request->email;
//        $whereClause = [
//            ['name', 'like', "%$name%"],
//            ['email', 'like', "%$email%"]
//        ];
//        $data = [
//            'departments' => $departments,
//            'users' => $users,
//        ];
//        if ($departmentId !== -1) {
//            $whereClause[] = ['department_id', $departmentId];
//        }
//        if ($request->has(['department_id', 'name', 'email'])) {
//            $data['users'] = User::where($whereClause)->paginate(config('app.paginate'));
//            $data['department_id'] = $departmentId;
//            $data['name'] = $name;
//            $data['email'] = $email;
//            return view('backend.users.search', $data);
//        } else {
        return view('backend.users.index', $param);
    }

//}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        $param = [
            'departments' => $departments,
            'roles' => $roles,
        ];
        return view('backend.users.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['password'] = Hash::make($request->password);
            $input = $request->except(['avatar', 'role_id']);
            if ($request->hasFile('avatar')) {
                $storagePath = $request->avatar->store('avatar', ['disk' => 'public']);
                $input['avatar'] = $storagePath;
            } else {
                $input['avatar'] = config('app.avatar_icon');
            }
            $user = User::create($input);
            $user->roles()->attach($request->role);
            DB::commit();
            return redirect()->route('user.index')->with('success', 'User create successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('user.index')->with(['error', 'Vui lòng kiểm tra lại']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $user = User::findOrFail($id);
        $param = [
            'user' => $user,
        ];
        return view('backend.users.show', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        $rolesUser = DB::table('role_user')->where('user_id', $id)->pluck('role_id');
        $departments = Department::all();
        $param = [
            'user' => $user,
            'departments' => $departments,
            'roles' => $roles,
            'rolesUser' => $rolesUser,
        ];
        return view('backend.users.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $request['password'] = Hash::make($request->password);
            $input = $request->except(['avatar', 'role_id']);
            if ($request->hasFile('avatar')) {
                $storagePath = $request->avatar->store('avatar', ['disk' => 'public']);
                $input['avatar'] = $storagePath;
            } else {
                $input['avatar'] = config('app.avatar_icon');
            }
            $user->update($input);
            DB::table('role_user')->where('user_id', $id)->delete();
            $user->roles()->attach($request->role);

            DB::commit();
            return redirect()->route('user.index')->with('success', 'User create successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('user.index')->with(['error', 'Vui lòng kiểm tra lại']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
//            $user->assigns()->detach();
            $user->roles()->detach();
            DB::commit();
            return redirect()->route('user.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

}

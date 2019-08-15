<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::paginate(config('app.paginate'));
        $departments = Department::all();
        $param = [
            'users' => $users,
            'departments' => $departments,
        ];
        return view('backend.users.index', $param);
    }

//    function fetch_data(Request $request)
//    {
//        if ($request->ajax()) {
//            $users = User::paginate(config('app.paginate'));
//            return view('backend.user.pagination', compact('users'))->render();
//        }
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $param = [
            'departments' => $departments,
        ];
        return view('backend.users.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->except('avatar');
        $request['password'] = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            $storagePath = $request->avatar->store('avatar', ['disk' => 'public']);
            $input['avatar'] = $storagePath;
        } else {
            $input['avatar'] = config('app.avatar_icon');
        }
        User::create($input);
        return redirect()->route('user.index')->with('success', 'User create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $departments = Department::all();
        $param = [
            'user' => $user,
            'departments' => $departments,
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
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->except('avatar');
        $request['password'] = Hash::make($request->password);
        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete('/' . $user->avatar);
            $storagePath = $request->avatar->store('avatar', ['disk' => 'public']);
            $input['avatar'] = $storagePath;
        } else {
            $input['avatar'] = config('app.avatar_icon');
        }
        $user->update($input);
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}

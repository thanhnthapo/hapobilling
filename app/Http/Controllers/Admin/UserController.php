<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::paginate(config('app.user_paginate'));
        $param =  [
            'users' => $users,
        ];
        return view('backend.users.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->getClientOriginalName();
            $avatarName = uniqid() . "_" . time() . "_" . $avatar;
            $request->avatar = $avatarName;
            $request->file('avatar')->move('uploads', $avatarName);
        }else{
            $avatarName= config('app.avatar_icon');
        }
       User::create([
            'name' => $request->name,
            'avatar' => $avatarName,
            'email' => $request->email,
            'dob' => $request->dob,
            'password' => $request->password,
            'status' => $request->status,
        ]);
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
        $param = [
            'user' => $user
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
        $avatar = $request->file('avatar')->getClientOriginalName();
        $avatarName = uniqid(). "_" . time() . "_" . $avatar;
        $request->avatar =  $avatarName;
        $request->file('avatar')->move('uploads', $avatarName);;
        $user->update([
            'name' => $request->name,
            'avatar' => $avatarName,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'dob' => $request->dob,
            'password' => $request->password,
        ]);
        $user->save();
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
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');;
    }
}

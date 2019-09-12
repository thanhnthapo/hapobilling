@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="row profile">
            <div class="col-sm-12 tile-profile">
                <h2 class="font-weight-bold text-center">User profile</h2>
            </div>
            <div class="col-sm-2 avatar-profile">
                <div class="text-center">
                    <img src="{{ asset('storage/'.$user->avatar) }}" class="img-circle avatar-user" alt="Ảnh đại diện">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="username">Tên</label>
                            <input type="text" value="{{ $user->name }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" value="{{ $user->email }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="username">Quyền</label>
                            <input type="text" value="{{ $user->dob }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="username">Quyền</label>
                            <input type="text" value="{{ $role->display_name }}"
                                   class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="username">Phòng ban</label>
                            <input type="text" value="{{ $department->name }}"
                                   class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning"><a href="{{ route('user.edit',['id'=>$user->id]) }}"><i
                            class="fa fa-edit"></i> Edit Profile</a></button>
            </div>
        </div>
    </div>
@endsection


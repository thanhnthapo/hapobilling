@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Update User</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('user.update',['id' => $user->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="name" value="{{ old('name', $user->name) }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Avatar<span class="text-danger"> *</span></label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    <label for="">Avatar cũ: </label><img src="{{ asset('storage/'.$user->avatar) }}" alt=""
                                                          class="img-thumbnail img-user">
                    <p class="text-danger">{{ $errors->first('avatar')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Email<span class="text-danger">*</span></label>
                    <input class="form-control" name="email" value="{{ old('email', $user->email) }}">
                    <p class="text-danger">{{ $errors->first('email')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Role<span class="text-danger"> *</span></label>
                    <select name="role[]" id="role" class="form-control" multiple='multiple'>
                        @foreach ($roles as $role)
                            <option
                                {{ $rolesUser->contains($role->id) ? 'selected' : '' }}
                                value="{{ $role->id }}">
                                {{ $role->display_name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('role'))
                        <span class="text-danger">{{$errors->first('role')}}</span>
                    @endif
                </div>
                <div class="form-group col-sm-8">
                    <label>Department<span class="text-danger"> *</span></label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department_item)
                            <option
                                value="{{ $department_item->id }}" {{( $department_item->id == $user->department_id ) ? 'selected' : '' }}>
                                {{ $department_item->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('department_id')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Status<span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="" name="status" value="{{ old('status', $user->status) }}">
                    <p class="text-danger">{{ $errors->first('status')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Birthday<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ old('dob', $user->dob)  }}">
                    <p class="text-danger">{{ $errors->first('dob')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Password<span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password"
                           value="{{ old('password', $user->password)  }}">
                    <p class="text-danger">{{ $errors->first('password')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Lưu Lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection


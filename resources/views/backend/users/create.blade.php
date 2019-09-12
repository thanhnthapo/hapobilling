@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Create User</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('user.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger"> *</span></label>
                    <input class="form-control" name="name" value="{{ old('name') }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Avatar<span class="text-danger"> *</span></label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    <p class="text-danger">{{ $errors->first('avatar')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Email<span class="text-danger"> *</span></label>
                    <input class="form-control" name="email" value="{{ old('email') }}">
                    <p class="text-danger">{{ $errors->first('email')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Department<span class="text-danger"> *</span></label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department_item)
                            <option
                                value="{{ $department_item->id }}" {{ ($department_item->id ==  old('department_id')) ? 'selected' : '' }}>
                                {{ ($department_item->id == $department_item->department_id) ? "-" : "" }}  {{ $department_item->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('department_id')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Select Role<span class="text-danger"> *</span></label>
                    <select name="role[]" id="role" class="form-control" multiple="multiple">
                        @foreach ($roles as $role_item)
                            <option
                                value="{{ $role_item->id }}" {{ in_array($role_item->id, old('role', [])) ? 'selected' : '' }}>
                                {{$role_item->display_name}}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('department_id')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Birthday<span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ old('dob')  }}">
                    <p class="text-danger">{{ $errors->first('dob')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Password<span class="text-danger"> *</span></label>
                    <input class="form-control" type="password" name="password" value="{{ old('password')  }}">
                    <p class="text-danger">{{ $errors->first('password')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label for="status">Status<span class="text-danger"> *</span></label>
                    <label class="radio-custom">Active
                        <input type="radio" name="status"
                               value="{{ config('app.active') }}" {{(old('status')==config('app.active'))?"checked="."checked":""}}>
                        <span class="checkmark"></span>
                    </label>

                    <label class="radio-custom">Block
                        <input type="radio" name="status"
                               value="{{ config('app.block') }}" {{(old('status')==config('app.block'))?"checked="."checked":""}}>
                        <span class="checkmark"></span>
                    </label>
                    @if($errors->has('status'))
                        <span class="text-danger">{{$errors->first('status')}}</span>
                    @endif
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection


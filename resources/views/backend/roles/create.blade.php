@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Create Role</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('role.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger"> *</span></label>
                    <input class="form-control" name="name" value="{{ old('name') }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Display_name<span class="text-danger"> *</span></label>
                    <input class="form-control" name="email" value="{{ old('display_name') }}">
                    <p class="text-danger">{{ $errors->first('display_name')}}</p>
                </div>
                @foreach( $permissions as $permission)
                    <div class="form-check col-sm-8">
                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}">
                        <label class="form-check-label" for="exampleCheck1">{{ $permission->display_name }}</label>
                    </div>
                @endforeach
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection


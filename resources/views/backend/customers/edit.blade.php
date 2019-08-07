@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Update Customer</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('customer.update',['id' => $customer->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="name" value="{{ $customer->name }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Phone<span class="text-danger">*</span></label>
                    <input class="form-control" name="phone" value="{{ $customer->phone }}">
                    <p class="text-danger">{{ $errors->first('phone')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Birthday<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ $customer->dob  }}">
                    <p class="text-danger">{{ $errors->first('dob')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Email<span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="" name="email" value="{{ $customer->email  }}">
                    <p class="text-danger">{{ $errors->first('email')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Address<span class="text-danger">*</span></label>
                    <input class="form-control" name="address" value="{{ $customer->address  }}">
                    <p class="text-danger">{{ $errors->first('address')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Lưu Lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection


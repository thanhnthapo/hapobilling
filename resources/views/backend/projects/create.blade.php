@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Create Projects</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('project.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger"> *</span></label>
                    <input class="form-control" name="name" value="{{ old('name') }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Start Date<span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date')  }}">
                    <p class="text-danger">{{ $errors->first('start_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Finish Date<span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" name="finish_date" value="{{ old('finish_date')  }}">
                    <p class="text-danger">{{ $errors->first('finish_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Customer<span class="text-danger"> *</span></label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">Khách hàng</option>
                        @foreach ($customer as $customer_item)
                            <option value="{{ $customer_item->id }}" {{ ($customer_item->id ==  old('customer_id')) ? 'selected' : '' }}>
                                {{($customer_item->id==$customer_item->category_id)?"-":"" }}  {{$customer_item->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('customer_id')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection


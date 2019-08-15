@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Update Project</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('project.update',['id' => $project->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group col-sm-8">
                    <label>Name<span class="text-danger">*</span></label>
                    <input class="form-control" name="name" value="{{ old('name', $project->name) }}">
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Start Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $project->start_date) }}">
                    <p class="text-danger">{{ $errors->first('start_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Finish Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="finish_date" value="{{ old('finish_date', $project->finish_date) }}">
                    <p class="text-danger">{{ $errors->first('finish_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Customer<span class="text-danger">*</span></label>
                    <select name="customer_id" id="customer_id" class="form-control">
                        @foreach ($customer as $customer_item)
                            <option value="{{ $customer_item->id }}" {{ $customer_item->id ? 'selected' : '' }}>
                                {{($customer_item->id == $customer_item->customer_id)?"-":"" }}  {{$customer_item->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Lưu Lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection


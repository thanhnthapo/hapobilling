@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Assign User For Project</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('assign.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-sm-8">
                    <label>User Name<span class="text-danger"> *</span></label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">Vui lòng chọn</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ ($user->id ==  old('user_id')) ? 'selected' : '' }}>
                                {{($user->id==$user->user_id)?"-":"" }}  {{$user->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('user_id')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>User Name<span class="text-danger"> *</span></label>
                    <select name="project_id" id="project_id" class="form-control">
                        <option value="">Vui lòng chọn</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ ($project->id ==  old('project_id')) ? 'selected' : '' }}>
                                {{($project->id==$project->project_id)?"-":"" }}  {{$project->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('project_id')}}</p>
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Assign</button>
                </div>
            </form>
        </div>
    </div>
@endsection


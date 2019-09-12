@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Update Task</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('task.update',['id' => $task->id]) }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group col-sm-8">
                    <label>Content Task<span class="text-danger">*</span></label>
                    <input class="form-control" name="content" value="{{ $task->content }}">
                    <p class="text-danger">{{ $errors->first('content')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Project<span class="text-danger">*</span></label>
                    <select name="project_id" id="project_id" class="form-control">
                        @foreach ($project as $project_item)
                            <option
                                value="{{ $project_item->id }}" {{ ($project_item->id == $task->project_id)  ? 'selected' : '' }}>
                                {{$project_item->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('name')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Start Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="start_date" value="{{ $task->start_date }}">
                    <p class="text-danger">{{ $errors->first('start_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Finish Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="finish_date" value="{{ $task->finish_date }}">
                    <p class="text-danger">{{ $errors->first('finish_date')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Lưu Lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection


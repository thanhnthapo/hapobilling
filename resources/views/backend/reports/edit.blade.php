@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Danh sách công việc</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('report.update', $report->id)}}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group col-sm-8">
                    <label>Nội dung báo cáo<span class="text-danger"> *</span></label>
                    <textarea name="note" id="note" class="form-control">{{ old('note', $report->note)  }}</textarea>
                    <p class="text-danger">{{ $errors->first('note')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Link tham chiếu<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="link_reference"
                           value="{{ old('link_reference', $report->link_reference) }}">
                    <p class="text-danger">{{ $errors->first('link_reference')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Task project<span class="text-danger"> *</span></label>
                    <select name="role[]" id="role" class="form-control" multiple='multiple'>
                        @foreach ($tasks as $task_item)
                                <option
                                    value="{{ ($task_item->id) }}" {{ ( $task_item->id == $task_id->task_id) ? 'selected' : ''  }}>
                                    {{$task_item->content}}
                                </option>
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('task')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu Lại</button>
                </div>
            </form>
        </div>
    </div>
@endsection


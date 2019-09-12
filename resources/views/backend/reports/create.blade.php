@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Create report</h2>
</div>
@section('content')
    <div class="container">
        <div class="row box-body">
            <form class="form-horizontal" method="POST" action="{{ route('report.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group col-sm-8">
                    <label>Nội dung báo cáo<span class="text-danger"> *</span></label>
                    <textarea name="note" id="note" class="form-control">{{ old('note') }}</textarea>
                    <p class="text-danger">{{ $errors->first('note')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Link tham chiếu<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="link_reference" value="{{ old('link_reference')  }}">
                    <p class="text-danger">{{ $errors->first('link_reference')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <label>Task project<span class="text-danger"> *</span></label>
                    <select name="task[]" id="task" class="form-control" multiple="multiple">
                        @foreach ($tasks as $tasks_item)
                            @if($tasks_item->user_id == $userLogin)
                                <option
                                    value="{{ ($tasks_item->id) }}">
                                    {{$tasks_item->content}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-danger">{{ $errors->first('task')}}</p>
                </div>
                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Customer</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="page-header">
                    <button class="btn btn-success"><a href="{{ route('report.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>
                    <hr>
                    <form class="form-horizontal form-flex" action="{{ route('report.index') }}" method="GET">
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-adjust"></i></span>
                            <select class="form-control" id="search-header" name="user_id[]"
                                    multiple="multiple">
                                @foreach($userSearch as $user_item)
                                    <option value="{{ $user_item->id }}">{{ $user_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Tìm kiếm</button>
                    </form>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
                        <th width="10%">No.</th>
                        <th>Nội dung báo cáo</th>
                        <th>Người báo cáo <i class="fa fa-sort"></i></th>
                        <th width="10%">Hành động</th>
                    </tr>
                    <tbody>
                    @foreach($reports as $key => $report)
                        <tr>
                            <td><strong>{{ $key + 1 }}</strong></td>
                            <td>{{ $report->note }}</td>
                            <td>
                                @foreach($users as $user)
                                        {{ $user->name}}
                                @endforeach
                            </td>
                            <td class="action">
                                <button class="btn btn-info"><a
                                        href="{{ route('report.show',['id'=>$report->id]) }}"><i
                                            class="fa fa-eye"></i></a>
                                </button>

                                <button class="btn btn-warning"><a
                                        href="{{ route('report.edit',['id'=>$report->id]) }}"><i
                                            class="fa fa-edit"></i></a>
                                </button>
                                <button class="btn btn-danger"><a class="delete-report"
                                                                  report-id="{{ $report->id }}"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection

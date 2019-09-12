@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Danh sách công việc</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row box-body">
            <div class="col-sm-9">
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-tr-header">
                        <th>Công việc</th>
                        <th width="250">Nội Dung báo cáo</th>
                        <th>Link tham chiếu</th>
                        <th width="120">Thời gian</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $taskTime->content }}</td>
                            <td>{{ $report->note }}</td>
                            <td><a href="{{ $report->link_reference }}" target="_blank">{{ $report->link_reference }}</a></td>
                            <td>{{ $totalTime }} h</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
@endsection


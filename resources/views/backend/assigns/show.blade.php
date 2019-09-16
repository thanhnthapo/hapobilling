@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8">
                        <h2 class="title">
                            Khách hàng: {{ $customer->name }}
                        </h2>
                    </div>
                </div>
                <div class="row history-responsive">
                    <div class="col-sm-5">
                        <div class="row logo-customer">
                            <div class="col-sm-12 mr-left-55 logo-border">
                                <img id="displayFile" class="mt-4 mb-4 img-circle" width="200px"
                                     src="{{ asset('storage/'.$user->avatar) }}">
                            </div>
                        </div>
                        <div class="row content-customer">
                            <div class="col-sm-12 mr-left-55 leff-content">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <th width="20%">Tên khách hàng</th>
                                        <td width="80%">{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Tên dự án</th>
                                        <td width="80%">{{ $project->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Task</th>
                                        <td width="80%">{{ $taskUser->content }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Người thực hiện</th>
                                        <td width="80%" class="word-break">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Ngày bắt đầu</th>
                                        <td width="80%">{{ $assign->start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Ngày kết thúc</th>
                                        <td width="80%">{{ $assign->finish_date }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-3 col-12 history">
                        <div class="history-box mr-3" id="viewHistory">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

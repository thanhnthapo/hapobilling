@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Projects</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('project.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>

                </div>
                <div class="form-search d-flex">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search-user">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                    <button id="Mybtn" class="btn btn-primary"><i class="fa fa-plus"></i> Assign</button>
                    <form id="MyForm" action="{{ route('assign.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <label>User Name</label>
                        <select name="user_id" id="user_id">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}" {{ ($user->id ==  old('user_id')) ? 'selected' : '' }}>
                                    {{($user->id==$user->user_id)?"-":"" }}  {{$user->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('user_id')}}</span>
                        <label>Project Name</label>
                        <select name="project_id" id="project_id">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($projects as $project)
                                <option
                                    value="{{ $project->id }}" {{ ($project->id ==  old('project_id')) ? 'selected' : '' }}>
                                    {{($project->id==$project->project_id)?"-":"" }}  {{$project->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('user_id')}}</span>
                        <label>Start_Date</label>
                        <input type="date" name="start_date"/>
                        <label>Finish_Date</label>
                        <input type="date" name="finish_date"/>
                        <button type="submit" class="btn btn-success">Confirm</button>
                    </form>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr class="table-tr-header">
                        <th class="table-th-header pl-4">No.</th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Start_date <i class="fa fa-sort"></i></th>
                        <th>Finish_date <i class="fa fa-sort"></i></th>
                        <th>Customer</th>
                        <th>UserName</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{  $loop->iteration }}</td>
                            <td><strong>{{ $project->name }}</strong></td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->finish_date }}</td>
                            <td>
                                @foreach($customers as $customers_name)
                                    @if($customers_name->id == $project->customer_id)
                                        {{ $customers_name->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($users as $user)
                                    @foreach($assigns as $assign)
                                        @if($user->id == $assign->user_id && $project->id == $assign->project_id)
                                            {{ $user->name }} <span>,</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="action">
                                <button class="btn btn-warning" id="btnEdit"><i class="fa fa-edit"></i>
                                    <div id="dialog" class="form-edit">
                                        <form action="">
                                            <lable>UserName</lable>
                                            <input type="text">
                                            <lable>UserName</lable>
                                            <input type="text">
                                            <lable>UserName</lable>
                                            <input type="text"> <lable>UserName</lable>
                                            <input type="text">
                                        </form>
                                    </div>
{{--                                    <a--}}
{{--                                        href="{{  route('project.edit', ['id' => $project->id])}}"><i--}}
{{--                                            class="fa fa-edit"></i></a>--}}
                                </button>
                                <button class="btn btn-danger"><a class="delete-project"
                                                                  project-id="{{ $project->id }}"
                                                                  onclick="return confirm('Xác nhận xóa?')"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#Mybtn').click(function(){
                $('#MyForm').toggle(500);
            });
        });
        $(function () {
            $("#dialog").dialog({
                modal: true,
                autoOpen: false,
                title: "Chỉnh Sửa Project",
                width: 600,
                height: 500
            });
            $("#btnEdit").click(function () {
                $('#dialog').dialog('open');
            });

            $('.delete-project').click(function () {
                var projectId = $(this).attr('project-id');
                $(this).parent().parent().parent().remove();
                $.ajax({
                    url: '/admin/project/delete',
                    type: 'POST',
                    data: {id: projectId},
                    success: function (res) {

                    },
                    error: function (err) {

                    }
                })
                })
            })
    </script>
@endsection


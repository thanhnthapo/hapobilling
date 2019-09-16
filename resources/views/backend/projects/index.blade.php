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
                    <div class="col-sm-2">
                        <label>Employees</label>
                        <select name="user_id" id="user_id" class="input-sm">
                            <option selected disabled>-- Select a Employees --</option>
                            @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}" {{ ($user->id ==  old('user_id')) ? 'selected' : '' }}>
                                    {{($user->id==$user->user_id)?"-":"" }}  {{$user->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('user_id')}}</p>
                    </div>
                    <div class="col-sm-2">
                        <label>Project Name</label>
                        <select name="project_id" id="project_id" class="input-sm">
                            <option>-- Select a Project --</option>
                            @foreach ($projects as $project)
                                <option
                                    value="{{ $project->id }}" {{ ($project->id ==  old('project_id')) ? 'selected' : '' }}>
                                    {{($project->id==$project->project_id)?"-":"" }}  {{$project->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('project_id')}}</p>
                    </div>
                    <div class="col-sm-2">
                        <label>Tasks Name</label>
                        <select name="task_id" id="task_id" class="input-sm">
                            <option>-- Select a Task --</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('user_id')}}</p>
                    </div>
                    <div class="col-sm-2">
                        <label>Start_Date</label>
                        <input type="date" name="start_date" class="input-sm"/>
                        <p class="text-danger">{{ $errors->first('start_date')}}</p>
                    </div>
                    <div class="col-sm-2">
                        <label>Finish_Date</label>
                        <input type="date" name="finish_date" class="input-sm"/>
                        <p class="text-danger">{{ $errors->first('finish_date')}}</p>
                    </div>
                    <div class="col-sm-2 m-3">
                        <button type="submit" class="btn btn-success btn-assign">Confirm</button>
                    </div>
                </form>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr class="table-tr-header">
                        <th class="table-th-header pl-4">No.</th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Start_date <i class="fa fa-sort"></i></th>
                        <th>Finish_date <i class="fa fa-sort"></i></th>
                        <th>Customer</th>
                        <th>Employees</th>
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
                                            <button type="submit" class="btn btn-outline-light text-dark"
                                                    onclick="window.location.href='{{ route('assign.show', $assign->id) }}'">
                                                {{ $user->name }}
                                                {{--                                                    <a--}}
                                                {{--                                                        class="delete-assign"--}}
                                                {{--                                                        assign-id="{{ $assign->id }}"--}}
                                                {{--                                                        href="#"><i--}}
                                                {{--                                                            class="fa fa-times-circle"></i></a>--}}

                                            </button>
                                            <button class="btn btn-assign"><a href="{{ route('assign.edit', $assign->id) }}"><i class="fa fa-edit"></i></a></button>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="action">
                                <button class="btn btn-warning" id="btnEdit"><a
                                        href="{{ route('project.edit', $project->id) }}"><i class="fa fa-edit"></i></a>
                                </button>
                                <button class="btn btn-danger"><a class="delete-project"
                                                                  project-id="{{ $project->id }}"
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
@endsection
@section('js')
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('#project_id').on('change', function (e) {--}}
{{--                var project_id = e.target.value;--}}
{{--                $.post('/admin/project/ajax-task?project_id=' + project_id, function (data) {--}}
{{--                    $('#task_id').empty();--}}
{{--                    $.each(data, function (index, tasks) {--}}
{{--                        $('#task_id').append(`<option value="` + tasks.id + `">` + tasks.content + `</option>`)--}}
{{--                    })--}}
{{--                })--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
@endsection

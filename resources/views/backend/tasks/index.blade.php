@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Projects</h2>
</div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('task.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>

                </div>
                <div class="form-search d-flex">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search-user">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
                        <th>Project</th>
                        <th>Content <i class="fa fa-sort"></i></th>
                        <th>Start_date <i class="fa fa-sort"></i></th>
                        <th>Finish_date <i class="fa fa-sort"></i></th>
                        <th>UserName</th>
                        <th class="w-200">Action</th>
                    </tr>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                @foreach($projects as $project)
                                    @if($project->id == $task->project_id)
                                        {{ $project->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $task->content }}</td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->finish_date }}</td>
                            <td>
                                @foreach($users as $user)
                                    @foreach($assigns as $assign)
                                        @if($user->id == $assign->user_id && $project->id == $assign->project_id)
                                            <button class="btn btn-outline-light text-dark">
                                                {{ $user->name }}
                                                <a class="delete-assign"
                                                   assign-id="{{ $assign->id }}"
                                                   onclick="return confirm('Xóa {{ $user->name }} khỏi project {{ $project->name }}?')"
                                                   href="#"><i class="fa fa-times-circle"></i></a>
                                            </button>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="action">
                                <button class="btn btn-warning"><a
                                        href="{{  route('task.edit', ['id' => $task->id])}}"><i
                                            class="fa fa-edit"></i></a>
                                </button>
                                <button class="btn btn-danger"><a class="delete-project"
                                                                  project-id="{{ $task->id }}"
                                                                  onclick="return confirm('Xác nhận xóa?')"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
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

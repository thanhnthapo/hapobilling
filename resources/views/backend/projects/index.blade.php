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
                <div class="add-assign">
                    <button class="btn btn-success" style="margin: 10px 0px"><a
                            href="{{ route('assign.create') }}"><i
                                class="fa fa-plus"></i> Assign User</a>
                    </button>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Start_date <i class="fa fa-sort"></i></th>
                        <th>Finish_date <i class="fa fa-sort"></i></th>
                        <th>Customer</th>
                        <th>UserName</th>
                        <th class="w-200">Action</th>
                    </tr>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
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
                                @foreach($assigns as $assign)
                                    @foreach($users as $user)
                                        @if($assign->user_id == $user->id)
                                            {{ $user->name }} <span>,</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="action">
                                <button class="btn btn-warning"><a
                                        href="{{  route('project.edit', ['id' => $project->id])}}"><i
                                            class="fa fa-edit"></i></a>
                                </button>
                                <form method="POST" action="{{ route('project.destroy', [$project->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit" title="Delete"
                                            onclick="return confirm('Bạn có chắc chắng muốn xóa {{ $project->name }} ?')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
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

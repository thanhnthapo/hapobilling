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
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('assign.create') }}"><i
                                class="fa fa-plus"></i> Add User For Project</a></button>
                </div>
                <div class="form-search">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search-user">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
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
                            <td><strong>{{ $project->name }}</strong></td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->finish_date }}</td>
                            @foreach($customers as $customers_name)
                                @if($customers_name->id == $project->customer_id)
                                    <td>{{ $customers_name->name }}</td>
                                @endif
                            @endforeach
                            @foreach($users as $user)
                                @if($user->id == $user->user_id)
                                    <td>{{ $user->name }}</td>
                                @endif
                            @endforeach
                            <td class="d-flex">
                                <button class="btn btn-info"><a
                                        href="{{ route('project.show',['id'=>$project->id]) }}"><i
                                            class="fa fa-eye"></i></a></button>
                                <button class="btn btn-warning"><a
                                        href="{{ route('project.edit',['id'=>$project->id]) }}"><i
                                            class="fa fa-edit"></i></a></button>
                                {!! Form::open([
                                    'type' => 'hidden',
                                    'method'=>'post',
                                    'route'=>['project.destroy', $project->id]]) !!}
                                {!! Form::hidden('_method','delete') !!}
                                {!! csrf_field()!!}
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Xác nhận xóa?')"><i class="fa fa-trash-o"></i>
                                </button>
                                {!! Form::close() !!}
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

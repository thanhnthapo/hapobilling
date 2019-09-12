@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Users</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="page-header">
                    <button class="btn btn-success"><a href="{{ route('user.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>
                    <hr>
                    <form class="form-horizontal form-flex" action="{{ route('user.index') }}" method="GET">
                        <div class="input-group col-sm-2">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="name" value="" type="text"
                                   class="form-control" name="name" placeholder="Tên.....">
                        </div>
                        <div class="input-group col-sm-2">
                            <span class="input-group-addon"><i class="fa fa-inbox"></i></span>
                            <input id="email" value="" type="text"
                                   class="form-control" name="email" placeholder="Email....">
                        </div>
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-adjust"></i></span>
                            <select class="form-control" id="search-header" name="department_id[]"
                                    multiple="multiple">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Tìm kiếm</button>
                    </form>
                </div>
                <table class="table table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr class="table-tr-header">
                        <th>No.</th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($departments as $department_name)
                                    @if($department_name->id == $user->department_id)
                                        {{ $department_name->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    {{ $role->display_name }}
                                @endforeach
                            </td>
                            <td> {{ ($user->status == config('app.active')) ? 'active' : 'block' }}</td>
                            <td class="action">
                                <button type="submit" class="btn btn-info"><a
                                        href="{{ route('user.show',['id'=>$user->id]) }}"><i class="fa fa-eye"></i></a>
                                </button>
                                <button type="submit" class="btn btn-warning"><a
                                        href="{{ route('user.edit',['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>
                                </button>
                                <button class="btn btn-danger"><a class="delete-user"
                                                                  user-id="{{ $user->id }}"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

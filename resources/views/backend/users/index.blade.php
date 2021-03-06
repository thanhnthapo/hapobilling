@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Users</h2>
</div>
@section('content')
    <div class="container">
        <div class="col-12">
            @if ($message = Session::get('success'))
            @endif
            @if ($message = Session::get('error'))
            @endif
            <div class="">
                <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('user.create') }}"><i
                            class="fa fa-plus"></i> Thêm mới</a></button>
                <form class="form-search" action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search-user">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <table class="table table-bordered tablesorter table-hover text-center">
                <thead>
                <tr>
                    <th>Name <i class="fa fa-sort"></i></th>
                    <th>Avatar</th>
                    <th>Birthday <i class="fa fa-sort"></i></th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td><img class="img-thumbnail img-user"
                                 src="{{ asset('storage/'.$user->avatar) }}" alt=""></td>
                        <td>{{ $user->dob }}</td>
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
                        <td>{{ $user->status }}</td>
                        <td class="action">
                            <button type="submit" class="btn btn-info"><a
                                    href="{{ route('user.show',['id'=>$user->id]) }}"><i class="fa fa-eye"></i></a>
                            </button>
                            <button type="submit" class="btn btn-warning"><a
                                    href="{{ route('user.edit',['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>
                            </button>
                            <button class="btn btn-danger"><a class="delete-user"
                                                              user-id="{{ $user->id }}"
                                                              onclick="return confirm('Xác nhận xóa?')"
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
@endsection

@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Permissions</h2>
</div>
@section('content')
    <div class="container">
        <div class="col-12">
            @if ($message = Session::get('success'))
            @endif
            @if ($message = Session::get('error'))
            @endif
            <div class="">
                <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('permission.create') }}"><i
                            class="fa fa-plus"></i> Thêm mới</a></button>
                <form class="form-search" action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search-user">
                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <table class="table table-bordered tablesorter table-hover text-center">
                <thead>
                <tr>
                    <th>Permission <i class="fa fa-sort"></i></th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td><strong>{{ $permission->name }}</strong></td>
                        <td>{{ $permission->display_name }}</td>
                        <td class="action">
                            <button type="submit" class="btn btn-info"><a
                                    href="{{ route('user.show',['id'=>$permission->id]) }}"><i class="fa fa-eye"></i></a>
                            </button>
                            <button type="submit" class="btn btn-warning"><a
                                    href="{{ route('user.edit',['id'=>$permission->id]) }}"><i class="fa fa-edit"></i></a>
                            </button>
                            <button class="btn btn-danger"><a class="delete-user"
                                                              user-id="{{ $permission->id }}"
                                                              onclick="return confirm('Xác nhận xóa?')"
                                                              href="#"><i
                                        class="fa fa-trash-o"></i></a></button>
                    </tr>
                @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection

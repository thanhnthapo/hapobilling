@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Role</h2>
</div>
@section('content')
    <div class="container">
        <div class="col-12">
            @if ($message = Session::get('success'))
            @endif
            @if ($message = Session::get('error'))
            @endif
            <div class="">
                <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('role.create') }}"><i
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
                    <th>Display_name</th>
                    <th>Action</th>
                </tr>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td><strong>{{ $role->name }}</strong></td>
                        <td>{{ $role->display_name }}</td>
                        <td class="action">
                            <button type="submit" class="btn btn-info"><a
                                    href="{{ route('role.show',['id'=>$role->id]) }}"><i class="fa fa-eye"></i></a>
                            </button>
                            <button type="submit" class="btn btn-warning"><a
                                    href="{{ route('role.edit',['id'=>$role->id]) }}"><i class="fa fa-edit"></i></a>
                            </button>
                            <form method="POST" action="{{ route('role.destroy', [$role->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" type="submit" title="Delete"
                                        onclick="return confirm('Bạn có chắc chắng muốn xóa {{ $role->name }} ?')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection

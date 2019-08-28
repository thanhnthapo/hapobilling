@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Customer</h2>
</div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="table-responsive">
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('department.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>
                    <form class="form-search" action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search-user">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
                        <th>.No</th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($departments as $key => $department)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><strong>{{ $department->name }}</strong></td>
                            <td class="action">
                                <form action="{{ route('department.edit',['id'=>$department->id]) }}">
                                    <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                </form>
                                <button class="btn btn-danger"><a class="delete-department"
                                                                  department-id="{{ $department->id }}"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $departments->links() }}
            </div>
        </div>
    </div>
@endsection

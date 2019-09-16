@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Customer</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="table-responsive">
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('customer.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>
                    <form class="form-search" action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search-user">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-responsive table-bordered tablesorter table-hover text-center">
                    <thead>
                    <tr>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Email <i class="fa fa-sort"></i></th>
                        <th>Phone <i class="fa fa-sort"></i></th>
                        <th>Birthday <i class="fa fa-sort"></i></th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td><strong>{{ $customer->name }}</strong></td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->address }}</td>
                            <td class="action">
                                <button class="btn btn-info"><a
                                        href="{{ route('customer.show',['id'=>$customer->id]) }}"><i
                                            class="fa fa-eye"></i></a>
                                </button>

                                <button class="btn btn-warning"><a
                                        href="{{ route('customer.edit',['id'=>$customer->id]) }}"><i
                                            class="fa fa-edit"></i></a>
                                </button>
                                <button class="btn btn-danger"><a class="delete-customer"
                                                                  customer-id="{{ $customer->id }}"
                                                                  href="#"><i
                                            class="fa fa-trash-o"></i></a></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection

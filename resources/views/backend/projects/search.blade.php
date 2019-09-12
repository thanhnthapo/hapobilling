@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Projects</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="col-sm-12 btn-header">
                    <button id="btnAssign" class="btn btn-primary"><i class="fa fa-plus"></i> Assign</button>
                    <button class="btn btn-success"><a href="{{ route('project.create') }}"><i
                                class="fa fa-plus"></i> Thêm mới</a></button>
                </div>
                <div>
                    <form id="assignForm" action="{{ route('assign.store') }}" method="post"
                          class="col-sm-12 form-horizontal">
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
                </div>
                <div class=" col-sm-12 page-header">
                    <hr>
                    <form class="form-horizontal form-flex" action="{{ route('project.index') }}" method="GET">
                        <div class="input-group col-sm-2">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-bookmark"></i></span>
                            <input id="name" value="{{ isset($search['name']) ? $search['name'] : ''  }}" type="text"
                                   class="form-control" name="name" placeholder="Project...">
                        </div>
                        <div class="input-group col-sm-4">
                            <span class="input-group-addon"><i>Khách hàng</i></span>
                            <select class="form-control" id="search-header" name="customer_id[]"
                                    multiple="multiple">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" @if($customer_selected->contains($customer->id)) selected="selected"
                                            data-select2-id="{{ $customer->id }}" @endif>{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Tìm kiếm</button>
                    </form>
                </div>
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
                                            </button>
                                            <button class="btn btn-assign"><a
                                                    href="{{ route('assign.edit', $assign->id) }}"><i
                                                        class="fa fa-edit"></i></a></button>
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

                {{ $projects->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
@endsection

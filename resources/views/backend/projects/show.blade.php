@extends('layouts.backend')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card bg-info">
                <h1 class="text-center">User Profile</h1>
                    <div class="col-12">
                        <h2><span class="fa fa-user font-weight-bold "> UserName: </span> {{ $user->name }}</h2>
                    </div>
                    <div class="col-12">
                        <h3><span class="fa fa-calendar font-weight-bold "> BirthDay:</span> {{ $user->dob }}</h3>
                    </div>
                    <div class="col-12">
                        <h3><span class="fa fa-location-arrow font-weight-bold "> Address:</span> {{ $user->address }}</h3>
                    </div>
                    <div class="col-12">
                        <h3><span class="fa fa-phone font-weight-bold "> Phone:</span> {{ $user->phone }}</h3>
                    </div>
                    <div class="col-12">
                        <h3><span class="fa fa-info font-weight-bold "> Email:</span> {{ $user->email }}</h3>
                    </div>
                    <div class="text-center">

                            <button class="btn btn-warning"><a href="{{ route('user.edit',['id'=>$user->id]) }}"><i class="fa fa-edit"></i> Edit Profile</a></button>

                    </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app')

@php
    $route = 'employees';

@endphp

@section('content')

    <!-- start container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row justify-content-center centered">
                        <h3>
                            Profile
                        </h3>
                    </div>
                    <div class="card-body row justify-content-center centered align-items-center" style="padding: 30px">
                        <div class="col-md-6 col-sm-12">
                            <span style="font-weight: bold"> Name :</span><br>
                            <span>{{Auth::user()->name}}</span><br><br>
                            <span style="font-weight: bold"> E-mail :</span><br>
                            <span>{{Auth::user()->email}}</span><br><br>
                            <span style="font-weight: bold"> Department :</span><br>
                            <span>{{$department->name}}</span><br>
                        </div>
                        <div class="col-md-6 col-sm-12 row justify-content-center centered">
                            <img src="{{asset('uploads/users_images/' . Auth::user()->id .'/'. $employee->pic)}}">
                        </div>
                    </div>
                    <div class="card-footer row justify-content-center centered align-items-center">
                        <a href="{{url('Updating')}}" style="margin-right: 20px;cursor: pointer">
                            <button class="btn btn-success" style="cursor: pointer">
                                Edit
                            </button>
                        </a>
                        <a href="{{url('home')}}" style="margin-right: 20px;cursor: pointer">
                            <button class="btn btn-primary" style="cursor: pointer">
                                Back
                            </button>
                        </a>
                        <a href="{{url('rest')}}" >
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end container -->


@endsection

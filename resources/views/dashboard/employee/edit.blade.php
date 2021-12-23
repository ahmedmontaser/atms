@extends('layouts.app')

@php
    $route = 'employees';

@endphp

@section('content')

    <!-- start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 row justify-content-center ">

                <form class="card col-md-10" action="{{url('employees/edit')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header row justify-content-center centered">
                        <h3>
                            Update Profile
                        </h3>
                    </div>
                    <div class="card-body row justify-content-center centered align-items-center" style="padding: 30px">
                        <div class="col-md-6 col-sm-12">
                            <span style="font-weight: bold"> Name :</span><br><br>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{Auth::user()->name}}" name="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                            <br><br>
                            <span style="font-weight: bold"> E-mail :</span><br><br>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                            <br><br>
                        </div>
                        <div class="col-md-6 col-sm-12 row justify-content-center centered">
                            @foreach($employees as $employee)
                                @if($employee->user_id == Auth::user()->id)
                                    <img src="{{asset('uploads/users_images/' . Auth::user()->id .'/'. $employee->pic)}}" onclick="tiggerClick()" class="img-fluid" id="img-viewer"><br><br>
                                @endif
                            @endforeach
                            <input type="file" name="pic" class="form-control @error('pic') is-invalid @enderror" onchange="displayImage(this)" id="img-chooser">
                            @error('pic')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer row justify-content-center centered align-items-center">
                        <button type="submit" class="btn btn-primary" style="cursor: pointer">
                            Save Changes
                        </button>
                        <a href="{{route('employees.create')}}" style="margin-left: 20px">
                            <button type="button" class="btn btn-social" style="cursor: pointer">
                                Back
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end container -->

@endsection


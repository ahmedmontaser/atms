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
                            Changing Password
                        </h3>
                    </div>
                    <div class="card-body row justify-content-center centered align-items-center" style="padding: 30px">
                        <form class="col-md-8 col-sm-12" action="{{url('resting')}}" method="post">
                            @csrf
                            <input name="password" type="password"  value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                            <center>
                                <input type="submit" class="btn btn-success" style="margin: 15px">
                            </center>
                        </form>
                    </div>
                    <div class="card-footer row justify-content-center centered align-items-center">
                        <a href="{{url('home')}}" style="cursor: pointer">
                            <button class="btn btn-primary" style="cursor: pointer">
                                Back
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end container -->

@endsection

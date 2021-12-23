@extends('Dashboard\Layout\sidebar')

@php
    $route = 'departments';

@endphp

@section('content')


            <div class="card">
                <div class="card-header">
                    <center>
                    <h3> Adding Department</h3>
                    </center>
                </div>

                <div class="card-body ">



                <form method="POST" action="{{ route($route. '.create') }}">
    @csrf

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Department Name :</label>

        <div class="col-md-6">
            <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="form-group row">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn bg-primary text-light">
               Add
            </button>

            <a href="{{route($route. '.index')}}">
                <button type="button" class="btn bg-success text-light">
                    Cancel
                </button>
            </a>
        </div>
    </div>
</form>
                </div>
            </div>

    @endsection

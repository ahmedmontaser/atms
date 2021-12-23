@extends('layouts.app')

@php
    $route = 'employees';

@endphp


@section('content')
    <!---start container--->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card" style="padding: 15px">
                    <div class="card-header row justify-content-center centered">
                        <h2 >Profile Data </h2>
                    </div>

                    <div class="card-body row justify-content-center align-items-center">
                        <div class="col-md-6 col-sm-12" >
                            <div>
                                <span style="font-weight: bold">Employee  :</span>  {{$user->name}}
                            </div>
                            <br>
                            <div>
                                <span style="font-weight: bold">Email Address :</span> {{$user->email}}
                            </div>
                            <br>
                            <div>
                                <span style="font-weight: bold">Role :</span>
                                @if($user->head == 1)
                                    <span>Head of Department</span>
                                @elseif ($user->head == 0)
                                    <span>Employee</span>
                                @endif
                            </div>
                            <br>
                            <div>
                                <span style="font-weight: bold"> Department :</span>
                                @if($employees->count() > 0)
                                    @foreach($employees as $employee)
                                        @if($departments->count() > 0)
                                            @foreach($departments as $department)
                                                @if ($employee->user_id == $user->id)
                                                    @if ($department->id == $employee->department_id)
                                                        {{$department->name}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            @if($employees->count() > 0)
                                @foreach($employees as $employee)
                                    @if ($employee->user_id == $user->id)
                                        <img src="{{asset('uploads/users_images/'.$user->id .'/'. $employee->pic)}}">
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="card-footer row justify-content-center centered">
                        <a href="{{url('employees/destroy' , $user->id)}}" style="cursor: pointer; margin-right: 20px">
                            <button class="btn bg-success text-light" style="cursor: pointer">
                                Remove
                            </button>
                        </a>
                        @if($user->head == 0)
                            <a href="{{url('employees/update' , $user->id)}}" style="cursor: pointer">
                                <button class="btn bg-primary text-light" style="cursor: pointer">
                                    Make him Head
                                </button>
                            </a>
                        @elseif ($user->head == 1)
                            <a href="{{url('employees/update' , $user->id)}}" style="cursor: pointer">
                                <button class="btn btn-outline-primary" style="cursor: pointer">
                                    Back To Employee
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end container -->
@endsection


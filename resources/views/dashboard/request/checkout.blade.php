@extends('Dashboard\Layout\sidebar')

@php
    $route = 'requests';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <h3 style="padding: 20px">Check Out Requests</h3>


                </div>

                <div class="card-body">

                    @if($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($requests->count() > 0)
                                @foreach ($requests as $index=>$request)
                                    @foreach ($users as $user)
                                        @if ($user->id == $request->user_id)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>
                                                @if($employees->count() > 0)
                                                    @foreach ($employees as $employee)
                                                        @if ($employee->user_id == $user->id)
                                                            @foreach($departments as $department)
                                                                @if($employee->department_id == $department->id)
                                                                    {{$department->name}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                {{$request->reason}}
                                            </td>
                                            <td>
                                                <a href="{{url($route . '/update/'. $request->id , 1 )}}" style="cursor: pointer;font-size: 20px">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{url($route . '/update/'. $request->id , -1 )}}" style="cursor: pointer;font-size: 20px" class="text-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

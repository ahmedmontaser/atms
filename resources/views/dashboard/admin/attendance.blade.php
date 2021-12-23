@extends('Dashboard\Layout\sidebar')

@php
    $route = 'attendances';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">

                    <h3 style="padding: 20px">Attendance Hours </h3>

                    <select class="form-control centered col-md-6">
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">
                            {{$department->name}}
                        </option>
                        @endforeach
                    </select>

                </div>

                <div class="card-body">

                    @if($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Hours of Attendance</th>
                                <th scope="col">Hours of Absence</th>
                                <th scope="col">Head / Employee</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $index=>$user)
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
                                            {{$hours_of_user_attendance[$user->id]}} / {{date('d') * (14 - 9)}}
                                        </td>
                                        <td>
                                            {{(date('d') * (14 - 9)) - $hours_of_user_attendance[$user->id]}} / {{date('d') * (14 - 9)}}
                                        </td>
                                        <td>
                                            @if ($user->head == 0)
                                                Employee
                                            @elseif($user->head == 1)
                                                Head
                                            @endif
                                        </td>

                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

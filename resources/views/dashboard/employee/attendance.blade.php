@extends('layouts.app')


@section('content')

    <!----  start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3>Attence Hours </h3>

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
                                @if($employees->count() > 0)
                                    @foreach ($employees as $employee)
                                @foreach ($users as $index=>$user)
                                    @if ($employee->user_id != Auth::user()->id)
                                    @if ($employee->user_id == $user->id)

                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>



                                                                {{$employee->department->name}}


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
                                    @endif
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
    </div>


    <!----  end container -->


@endsection

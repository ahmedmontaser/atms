@extends('Dashboard\Layout\sidebar')

@php
    $route = 'admins';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Notifications
                </div>

                <div class="card-body">

                    <table class="table table-striped table-hover">
                        <thead>
                        <th>#</th>
                        <th>Name : </th>
                        <th>Department : </th>
                        <th>Reason :</th>
                        <th>Status : </th>
                        </thead>
                        <tbody>
                        @foreach($requests as $index=>$request)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$request->user->name}}</td>
                                <td>{{$request->user->employee->department->name}}</td>
                                <td>{{$request->reason}}</td>
                                <td>
                                    @if($request->status == 0)
                                        <a href="{{url('employees/acceptRequestNotification' , $request->id)}}" style="margin-right: 15px">
                                            <button type="button" class="btn bg-primary btn-sm text-light" >
                                                Accept
                                            </button>
                                        </a>
                                        <a href="{{url('employees/rejectRequestNotification' ,$request->id)}}">
                                            <button type="button" class="btn bg-dark btn-sm text-light" >
                                                Reject
                                            </button>
                                        </a>
                                    @endif
                                        @if($request->status == 1)
                                            Accepted
                                        @endif
                                        @if($request->status == -1)
                                            Rejected
                                        @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection

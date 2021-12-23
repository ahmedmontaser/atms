@extends('layouts.app')


@section('content')

    <!----  start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3>Notifications</h3>
                    </div>

                    <div class="card-body row justify-content-center align-items-center">
                        @if(Auth::user()->head == 1)
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
                                            <a href="{{url('employees/acceptRequestNotification' , $request->id)}}">
                                                <button type="button " class="btn btn-primary" >
                                                    Accept
                                                </button>
                                            </a>
                                            <a href="{{url('employees/rejectRequestNotification' ,$request->id)}}">
                                                <button type="button" class="btn btn-dark" >
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
                            @endif


                            @if(Auth::user()->head == 0)
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <th>#</th>
                                    <th>Reason :</th>
                                    <th>Status : </th>
                                    <th>Date : </th>
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
                                                   Pending
                                                @endif
                                                @if($request->status == 1)
                                                    Accepted
                                                @endif
                                                @if($request->status == -1)
                                                    Rejected
                                                @endif
                                            </td>
                                            <td>{{$request->created_at}}</td>

                                        </tr>
                                    @endforeach
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

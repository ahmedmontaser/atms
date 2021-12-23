@extends('Dashboard\Layout\sidebar')

@section('content')


    <!----  start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3>Request For Leaving from {{$user->name}}</h3>
                    </div>

                    <div class="card-body row justify-content-center align-items-center">
                        <div class="col-md-6 ">
                            <div class="about-box">
                                <h4> Request : </h4>

                                <span style="font-weight: bold"> Name :</span><br>
                                <span>{{$user->name}}</span><br><br>
                                <span style="font-weight: bold"> E-mail :</span><br>
                                <span>{{$user->email}}</span><br><br>
                                <span style="font-weight: bold"> Department :</span><br>
                                <span>{{$employee->department->name}}</span><br><br>
                                <span style="font-weight: bold"> Reason of Leaving :</span><br>
                                <span>{{$request->reason}}</span><br>


                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 row justify-content-center centered">
                            <img src="{{asset('uploads/users_images/' . $user->id .'/'. $employee->pic)}}">
                        </div>

                    </div>
                    <div id="options" class="card-footer row justify-content-center">
                        @if( $notification->accept == 0)
                            <a href="{{url('employees/acceptRequest' , $notification->id)}}">
                                <button type="button " class="btn bg-primary btn-sm text-light" >
                                    Accept
                                </button>
                            </a>
                            <a href="{{url('employees/rejectRequest' ,$notification->id)}}" style="margin-left: 20px">
                                <button type="button" class="btn bg-dark btn-sm text-light" >
                                    Reject
                                </button>
                            </a>
                        @endif

                        @if( $notification->accept == 1)
                            Accepted
                        @endif

                        @if( $notification->accept == -1)
                            Rejected
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----  end container -->


@endsection

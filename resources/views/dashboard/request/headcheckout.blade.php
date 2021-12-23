@extends('layouts.app')

@section('nav')


    <li class=" nav-item" style="margin-left:20px">
        <a href="#" class="nav-link "  data-toggle="dropdown">
            <i class="fas fa-bell"></i>
            @if(Auth::guard('admin')->check())
                <span class="notification" id="notification-counter-admin"></span>
            @endif
            @auth
                @if(Auth::user()->head == 1)
                    <span class="notification" id="notification-counter-head">7</span>
                @endif
                @if(Auth::user()->head == 0)
                    <span class="notification" id="notification-counter-user"></span>
                @endif
            @endauth

            <span class="d-lg-none">Notification</span>
        </a>
        <ul class="dropdown-menu">
            @if(Auth::guard('admin')->check())
                {{-------------
                @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                        @foreach($requests as $request)
                            @if ($notification->request_id == $request->id)
                                <a class="dropdown-item" href="#">
                                    {{$request->reason}}
                                </a>
                            @endif
                        @endforeach
                    @endforeach
                @endif
                ---------------}}
            @endif
            @auth
                {{--------
                @if($notifications->count() > 0)
                    @foreach($notifications as $item)
                        @if ($requests->count() > 0)
                            @foreach($requests as $request)
                                @if ($item->request_id == $request->id )
                                    @if(Auth::user()->head == 1)
                                        @if ($item->user_id != Auth::user()->id)
                                            <a class="dropdown-item" href="#">
                                                {{$request->reason}}
                                            </a>
                                        @endif
                                    @endif
                                    @if(Auth::user()->head == 0)
                                        @if ($item->user_id == Auth::user()->id)
                                            @if ($item->accept == 0)
                                                <a class="dropdown-item" href="#">
                                                    Pending
                                                </a>
                                            @endif
                                            @if ($item->accept == 1)
                                                <a class="dropdown-item" href="#">
                                                    Accepted
                                                </a>
                                            @endif
                                            @if ($item->accept == -1)
                                                <a class="dropdown-item" href="#">
                                                    Denied
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
                --------}}
            @endauth

            <a class="dropdown-item text-primary" data-toggle="modal" data-target="#notificationmodel">
                View All Notifications
            </a>

        </ul>
    </li>


    @auth
        @if (Auth::user()->head == 1)

            <li style="list-style:none; margin-left:20px">
                <a class="navbar-link text-dark" href="{{url('employees/list')}}" >
                    Employees
                </a>
            </li>
            <li style="list-style:none; margin-left:20px">
                <a class="navbar-link text-dark" href="{{url('check_out_list')}}" >
                    Leaving Requests
                </a>
            </li>
            <li style="list-style:none; margin-left:20px">
                <a class="navbar-link text-dark" href="{{route('attendances.create')}}" >
                    Attendance Tracked
                </a>
            </li>

        @endif

    @endauth

@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3 style="padding: 20px">Check out Requests</h3>
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
                                        @foreach ($users as $index=>$user)
                                            @if($user->id != Auth::user()->id)
                                                @if ($user->id == $request->user_id)
                                                    @if($employees->count() > 0)
                                                        @foreach ($employees as $employee)
                                                            @if ($employee->user_id == $user->id)
                                                                @if($employee->department_id == $department)
                                                                    <tr>
                                                                        <td>{{$index +1}}</td>
                                                                        <td>{{$user->name}}</td>
                                                                        <td>
                                                                            {{$department_data->name}}
                                                                        </td>
                                                                        <td>
                                                                            {{$request->reason}}
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{url('requests/update/'. $request->id , 1 )}}" style="cursor: pointer;font-size: 20px">
                                                                                <i class="fa fa-check text-primary"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{url('requests/update/'. $request->id , -1 )}}" style="cursor: pointer;font-size: 20px" class="text-danger">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
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

    <!-- end about -->
    <!-- Javascript files-->
    <script src="{{asset('js/employee/jquery-3.0.0.min.js')}}"></script>
    <script src="{{asset('js/employee/popper.min.js')}}"></script>
    <script src="{{asset('js/employee/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/employee/plugin.js')}}"></script>
    <!-- sidebar -->
    <script src="{{asset('js/employee/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('js/employee/custom.js')}}"></script>


    <script>
        $(document).ready(function() {

            //READ NUM OF NOTIFICATIONS BY AJAX FOR HEAD
            function getHeadNotifications(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getNewNotificationsNumberHead')}}",
                    success: function(response){
                        $('#notification-counter-head').html(response)
                    },
                    error: function(error){
                        $('#notification-counter-head').html(0)
                    }
                })
            }
            getHeadNotifications();

            window.setInterval(function(){
                getHeadNotifications();
            }, 5000);


            //READ NUM OF NOTIFICATIONS BY AJAX FOR USER
            function getUserNotifications(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getNewNotificationsNumberUser')}}",
                    success: function(response){
                        $('#notification-counter-user').html(response)
                    },
                    error: function(error){
                        $('#notification-counter-user').html(0)
                    }
                })
            }
            getUserNotifications();

            window.setInterval(function(){
                getUserNotifications();
            }, 5000);



            //SEND LEAVE REQUEST BY AJAX

            $('#leaverequest').on('submit' , function(e){
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{route('requests.store')}}",
                    data: $('#leaverequest').serialize(),
                    success: function(response){
                        alert('Request Send !');
                        $('#reason').val('')
                        $('.close').click();
                    },
                    error: function(error){
                        alert('Data Not send ' + error);
                    }
                })
            })



        });

        /*
            document.getElementById('leaverequest').addEventListener('submit' , postRequest);
                function postRequest(e){
                    e.preventDefault();
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST' , '{{route('requests.store')}}' , true);
            xhr.onload = function(){
                alert(this.responseText);
            }
            xhr.send();
        }
        */
    </script>

@endsection


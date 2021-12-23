<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Attendance') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Attendance
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto row justify-content-center align-items-center">

                        @auth
                            @if(Auth::user()->head == 0)
                            <li class=" nav-item" style="margin-left:20px">

                                <a id="user_notification_viewer" href="#" class="nav-link "  data-toggle="dropdown">
                                    <i class="fas fa-bell" id="user-bell"></i>
                                        <span class="notification" id="notification-counter-user" style="margin-left:-5px ; margin-top:-55px;  padding:0.5px 5px;border-radius:20px;color: white; background-color:gray;"></span>
                                    <span class="d-lg-none">Notification</span>
                                </a>

                                <ol id="user-notification-menu" class="dropdown-menu"  style="padding : 20px;list-style: decimal">

                                </ol>
                            </li>
                            @endif


                            @if(Auth::user()->head == 1)
                            <li class=" nav-item" style="margin-left:20px">

                                <a id="head_notification_viewer" class="nav-link "  data-toggle="dropdown"  style="cursor:pointer">
                                    <i class="fas fa-bell" id="head-bell"></i>
                                    <span class="notification" id="notification-counter-head" style="margin-left:-5px ; margin-top:-55px;  padding:0.5px 5px;border-radius:20px;color: white; background-color:gray;"></span>
                                    <span class="d-lg-none">Notification</span>
                                </a>

                            <ol id="head-notification-menu" class="dropdown-menu"  style="padding : 20px;list-style: decimal">

                            </ol>
                        </li>
                            @endif

                        @endauth

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
                                        <a class="navbar-link text-dark" href="{{url('getAttendanceHours')}}" >
                                            Attendance Tracked
                                        </a>
                                    </li>

                                @endif

                            @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        @guest


                        @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else


                            <li class="nav-item dropdown">
                                <a  class="nav-link  text-dark" href="{{route('employees.create')}}" >
                                    Profile
                                </a>
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>



    <script>
        $(document).ready(function() {


            //  View notifications for head

            $('#head_notification_viewer').on('click' , function () {
                $.getJSON("{{url('getNotificationsHead')}}" , function(data){

                    var jsonData = data.data;
                    var notifications = "";

                    if(jsonData.length < 5){
                        for(var i = 0; i< jsonData.length; i++ ){

                            @foreach($users as $user)
                            if(jsonData[i]['user_id'] == "{{$user->id}}"){
                                notifications += '<li style="margin: 5px">';
                                notifications += 'Employee : ' + '{{$user->name}}' + ' Asking for Leave .  <a href="../../employees/viewRequest/'+jsonData[i]["id"] +' ">' +
                                    '<button type="button" class="btn btn-light text-dark"> View Request </button>' +
                                    '</a>' +
                                    '</li>';
                            }

                            @endforeach

                        }
                    }
                    else {
                        if(jsonData.length >0){
                            for(var i = 0; i< 5; i++ ){
                                @foreach($users as $user)
                                if(jsonData[i]['user_id'] == "{{$user->id}}"){
                                    notifications += '<li>';
                                    notifications += 'Employee : ' + '{{$user->name}}' + ' Asking for Leave .  <a href="../../employees/viewRequest/'+jsonData[i]["id"] +' ">' +
                                        '<button type="button" class="btn btn-light text-dark" >View Request </button>' +
                                        '</a>' +
                                        '</li>';
                                }

                                @endforeach
                            }
                        } else {
                            notifications += "<li>";
                            notifications +=  'no notifications';
                            notifications += "</li>";

                        }
                    }


                        notifications += ' <a href="{{url('employees-notifications')}}" style=\"cursor: pointer\" class=\"btn dropdown-item text-primary\">\n' +
                            '                                        View All Notifications\n' +
                            '                                   </a>';


                    $('#head-notification-menu').html(notifications);
                })
            });


            //  View notifications for user

            $('#user_notification_viewer').on('click' , function () {
                $.getJSON("{{url('getNotificationsUser')}}" , function(data){

                    var notifications = "";
                    if(data.length < 5){
                        for(var i = 0; i< data.length; i++ ){
                            notifications += "<li>";
                            if(data[i]['accept'] == 0){
                                notifications += 'Status : Pending <br>';
                                notifications += 'Date : ' + data[i]['created_at'];
                            }
                            if(data[i]['accept'] == 1){
                                notifications += 'Status : Accepted <br>';
                                notifications += 'Date : ' + data[i]['created_at'];
                            }
                            if(data[i]['accept'] == -1){
                                notifications += 'Status : Rejected <br>';
                                notifications += 'Date : ' + data[i]['created_at'];
                            }
                            notifications += "</li> ";
                        }
                    }
                    else {
                        if(data.length >0){
                            for(var i = 0; i< 5; i++ ){
                                notifications += "<li>";
                                if(data[i]['accept'] == 0){
                                    notifications += 'Status : Pending <br>';
                                    notifications += 'Date : ' + data[i]['created_at'];
                                }
                                if(data[i]['accept'] == 1){
                                    notifications += 'Status : Accepted <br>';
                                    notifications += 'Date : ' + data[i]['created_at'];
                                }
                                if(data[i]['accept'] == -1){
                                    notifications += 'Status : Rejected <br>';
                                    notifications += 'Date : ' + data[i]['created_at'];
                                }
                                notifications += "</li> ";
                            }
                        } else {
                            notifications += "<li>";
                            notifications +=  'no notifications';
                            notifications += "</li>";

                        }
                    }


                        notifications += ' <a href="{{url('employees-notifications')}}" style=\"cursor: pointer\" class=\"btn dropdown-item text-primary\">\n' +
                            '                                        View All Notifications\n' +
                            '                                   </a>';


                    $('#user-notification-menu').html(notifications);
                });
            });



            //READ NUM OF NOTIFICATIONS BY AJAX FOR HEAD
            function getHeadNotifications(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getNewNotificationsNumberHead')}}",
                    success: function(response){
                        if(response > 0){
                            $('#notification-counter-head').css('background-color' , 'red')
                        }
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
                        if(response > 0){
                            $('#notification-counter-user').css('background-color' , 'red')
                        }
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
                        //alert('Request Send !');
                        $('#reason').val('')
                        $('#leaverequestmodel').modal('hide');
                        $('#colse-btn').click();
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

</body>
</html>

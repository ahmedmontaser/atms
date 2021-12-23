<html lang="en">

<head>

    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">

    <link rel="icon" type="image/png" href="{{asset('img/favicon.ico')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- CSS Files -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=2.0.0')}} " rel="stylesheet" />
    <!-- CSS Just for demo purpose, dont include it in your project -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('css/backend.css')}}" rel="stylesheet" />
    @yield('links')
    <style>

        a:hover{
            cursor: pointer;
        }
    </style>


</head>

<body>


    <div class="wrapper">
        <div class="sidebar" data-image="{{asset('img/sidebar-5.jpg')}}">

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{url('home')}}">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Attendance</p>
                        </a>
                    </li>

                    {{-----
                    <li class="nav-item {{is_active('users')}}">
                        <a class="nav-link" href="{{route('users.index')}}">
                            <i class="fa fa-user-cog"></i>
                            <p>Admin</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('clients')}}">
                        <a class="nav-link" href="{{route('clients.index')}}">
                            <i class="fa fa-users"></i>
                            <p>Client</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('posts')}}">
                        <a class="nav-link" href="{{route('posts.index')}}">
                            <i class="fa fa-flag"></i>
                            <p>post</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('likes')}}">
                        <a class="nav-link" href="{{route('likes.index')}}">
                            <i class="fa fa-flag"></i>
                            <p>Review</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('rents')}}">
                        <a class="nav-link" href="{{route('rents.index')}}">
                            <i class="fa fa-flag"></i>
                            <p>Rent</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('jobbers')}}">
                        <a class="nav-link" href="{{route('jobbers.index')}}">
                            <i class="fa fa-users"></i>
                            <p>Jobbers</p>
                        </a>
                    </li>

                    <li class="nav-item {{is_active('locations')}}">
                        <a class="nav-link" href="{{route('locations.index')}}">
                            <i class="fa fa-map-marked-alt"></i>
                            <p>Locations</p>
                        </a>
                    </li>--}}


                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('employees.index')}}">
                            <i class="fa fa-users"></i>
                            <p>Employees</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('departments.index')}}">
                            <i class="fa fa-building"></i>
                            <p>Departments</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('requests.create')}}">
                            <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                            <p>Check out Requests</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('attendances.index')}}">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                            <p>Attendance</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('requests.index')}}">
                            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                            <p>Join Requests</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{route('questions.index')}}">
                            <i class="fas fa-question"></i>
                            <p>Questions</p>
                        </a>
                    </li>


                    <li class="nav-item active active-pro">
                        <a class="nav-link active" href="upgrade.html">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li>
                </ul>
            </div>


        </div>

        @include('Dashboard\Layout\navbar')
        @include('Dashboard\Layout\footer')


    </div>

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
    <style>

        a:hover{
            cursor: pointer;
        }
    </style>


</head>

<body>
    <div class="sidebar" data-image="{{asset('img/sidebar-5.jpg')}}"></div>
    <div class="wrapper">
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <!--Right List-->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @if(Auth::user())
                                <li>
                                    <img src="{{Auth::user()->image_path}}" class="image-user" style="margin:21px 0px;">

                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">

                                            Welcome, {{ Auth::user()->name }}

                                        </div>

                                        <div class="card-body">
                                            <?php

                                            if(isset($_COOKIE['active'])){
                                                if( $_COOKIE['active'] == 0){
                                                    echo 'Please wait until Admins respond' ;
                                                }
                                                if( $_COOKIE['active'] == -1){
                                                    echo 'Sorry , your request denied' ;
                                                }
                                                if( $_COOKIE['active'] == -2){
                                                    echo 'removed' ;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        @include('Dashboard\Layout\footer')
    </div>
</body>
</html>

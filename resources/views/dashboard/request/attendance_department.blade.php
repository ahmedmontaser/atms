<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>{{ config('app.name', 'Attendance') }}</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">

    <link rel="icon" type="image/png" href="{{asset('img/favicon.ico')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- CSS Files -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- site metas -->
    <title>Home</title>
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('css/employee/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('css/employee/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/employee/jquery.mCustomScrollbar.min.css')}}">
</head>
<!-- body -->
<body class="main-layout">
@include('dashboard.Layout.navbar');
<div class="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 style="padding: 20px">Attendance Hours of {{$department->name}} Department</h3>
                    </div>
                    <div class="card-body">
                        @if($users->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Hours of Attendance</th>
                                    <th scope="col">Hours of Absence</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $index=>$user)
                                    @if($user->id != Auth::user()->id)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @if(isset($hours_of_user_attendance[$user->id]))
                                            {{$hours_of_user_attendance[$user->id]}} / {{date('d') * (14 - 9)}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($hours_of_user_attendance[$user->id]))
                                            {{(date('d') * (14 - 9)) - $hours_of_user_attendance[$user->id]}} / {{date('d') * (14 - 9)}}
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->
<!-- Javascript files-->
<script src="{{asset('js/employee/jquery.min.js')}}"></script>
<script src="{{asset('js/employee/popper.min.js')}}"></script>
<script src="{{asset('js/employee/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/employee/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('js/employee/plugin.js')}}"></script>
<!-- sidebar -->
<script src="{{asset('js/employee/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('js/employee/custom.js')}}"></script>
</body>
</html>

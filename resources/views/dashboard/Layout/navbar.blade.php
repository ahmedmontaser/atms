<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class="container-fluid">
            @auth
                <a class="navbar-brand" href="{{url('home')}}"> Home </a>
                <a class="navbar-brand" href="{{url('employees/create')}}" style="margin-left: 20px;margin-right: 20px">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </a>

            @endauth
            <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <!--Right List-->
                <ul class="nav navbar-nav mr-auto align-items-center">

                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-palette"></i>
                            <span class="d-lg-none">Attendance</span>
                        </a>
                    </li>

                    <li class="dropdown nav-item">
                        <a  id="admin_new_notification_viewer" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="nc-icon nc-planet"></i>
                            @if(Auth::guard('admin')->check())
                                <span class="notification" id="notification-counter-admin"></span>
                            @endif

                            <span class="d-lg-none">Notification</span>
                        </a>

                        {{-----------   ADMIN NOTIFICATION   -------}}
                        @if(Auth::guard('admin')->check())
                            <ul class="dropdown-menu" id="admin-notification-menu" style="padding:20px;list-style:decimal">

                                <a class="dropdown-item text-primary" data-toggle="modal" data-target="#notificationmodel">
                                    View All Notifications
                                </a>

                            </ul>
                        @endif


                    </li>
                            <!-- Modal -->
                            <div class="modal fade" id="notificationmodel" tabindex="-1" role="dialog" aria-labelledby="notificationmodelLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content" >
                                    <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="notificationmodelLabel">NOTIFICATIONS</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {{---------------
                                    @if ($notifications_list->count() > 0)
                                        @foreach ($notifications_list as $item)
                                            @foreach ($requests as $request)
                                                @if ($item->request_id == $request->id)
                                                    @foreach ($employees as $employee)
                                                        @if ($request->user_id == $employee->user_id)
                                                            @if(Auth::guard('admin')->check())
                                                                <div class="row ">
                                                                    <div class="container row justify-content-center align-items-center border-2" style="border: 1px solid gray;border-radius :10px;padding:7px;margin:7px;">
                                                                        <div class="col-md-9">
                                                                            @foreach ($users as $user)
                                                                                @if ($employee->user_id == $user->id)
                                                                                    Name : {{$user->name}}
                                                                                @endif
                                                                            @endforeach
                                                                            <br>
                                                                            @foreach ($departments as $department)
                                                                                @if ($employee->department_id == $department->id)
                                                                                    Department : {{$department->name}}
                                                                                @endif
                                                                            @endforeach
                                                                            <br>
                                                                            Reason :
                                                                            {{$request->reason}}
                                                                            <br>
                                                                            Date :
                                                                            {{$item->created_at}}
                                                                        </div>
                                                                        <div class="col-md-3 row justify-content-center align-items-center">

                                                                            <!----
                                                                            <a href="{{url('notifications/update/'. $request->id , 1 )}}" style="cursor: pointer;font-size: 20px">
                                                                                <i class="fa fa-check"></i>
                                                                            </a>

                                                                            <a href="{{url('notifications/update/'. $request->id , -1 )}}" style="cursor: pointer;font-size: 20px">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                           --->

                                                                            <form id="accept" class="col-md-6">
                                                                                @csrf
                                                                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                                                                <input type="hidden" name="notification_id" value="{{$item->id}}">
                                                                                <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                                                                <input type="hidden" name="accept" value="1">
                                                                                <button type="submit" class=" btn text-success">
                                                                                    <i class="fa fa-check"></i>
                                                                                </button>
                                                                            </form>

                                                                            <form id="deny" class="col-md-6">
                                                                                @csrf
                                                                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                                                                <input type="hidden" name="notification_id" value="{{$item->id}}">
                                                                                <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                                                                <input type="hidden" name="accept" value="-1">
                                                                                <button type="submit" class="btn text-danger">
                                                                                    <i class="fa fa-times"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @auth
                                                        @if(Auth::user()->head == 1)
                                                            @if($item->user_id != Auth::user()->id)
                                                                <div class="row ">
                                                                    <div class="container row justify-content-center align-items-center border-2" style="border: 1px solid gray;border-radius :10px;padding:7px;margin:7px;">
                                                                        <div class="col-md-9">
                                                                            @foreach ($users as $user)
                                                                                @if ($employee->user_id == $user->id)
                                                                                    Name : {{$user->name}}
                                                                                @endif
                                                                            @endforeach
                                                                            <br>
                                                                            Reason :
                                                                            {{$request->reason}}
                                                                            <br>
                                                                            Date :
                                                                            {{$item->created_at}}
                                                                        </div>
                                                                        <div class="col-md-3 row justify-content-center align-items-center">

                                                                                               <!----
                                                                                                <a href="{{url('notifications/update/'. $request->id , 1 )}}" style="cursor: pointer;font-size: 20px">
                                                                                                    <i class="fa fa-check"></i>
                                                                                                </a>

                                                                                                <a href="{{url('notifications/update/'. $request->id , -1 )}}" style="cursor: pointer;font-size: 20px">
                                                                                                    <i class="fa fa-times"></i>
                                                                                                </a>

-->
                                                                                                <form id="accept" class="col-md-6">
                                                                                                    @csrf
                                                                                                    <input type="hidden" name="request_id" value="{{$request->id}}">
                                                                                                    <input type="hidden" name="notification_id" value="{{$item->id}}">
                                                                                                    <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                                                                                    <input type="hidden" name="accept" value="1">
                                                                                                    <button type="submit" class=" btn text-success">
                                                                                                        <i class="fa fa-check"></i>
                                                                                                    </button>
                                                                                                </form>

                                                                                                <form id="deny" class="col-md-6">
                                                                                                    @csrf
                                                                                                    <input type="hidden" name="request_id" value="{{$request->id}}">
                                                                                                    <input type="hidden" name="notification_id" value="{{$item->id}}">
                                                                                                    <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                                                                                    <input type="hidden" name="accept" value="-1">
                                                                                                    <button type="submit" class="btn text-danger">
                                                                                                        <i class="fa fa-times"></i>
                                                                                                    </button>
                                                                                                </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                                                @if(Auth::user()->head == 0)
                                                                                    @if($item->user_id == Auth::user()->id)
                                                                                        @foreach ($users as $user)
                                                                                            @if ($employee->user_id == $user->id)
                                                                                                Name : {{$user->name}}
                                                                                            @endif
                                                                                        @endforeach
                                                                                        <br>
                                                                                        Reason :
                                                                                        {{$request->reason}}
                                                                                        <br>
                                                                                        Date :
                                                                                        {{$item->created_at}}
                                                                                        <br>
                                                                                        Status :
                                                                                        @if ($item->accept == 0)

                                                                                                Pending
                                                                                        @endif
                                                                                        @if ($item->accept == 1)

                                                                                                Accepted

                                                                                        @endif
                                                                                        @if ($item->accept == -1)

                                                                                                Denied

                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            @endauth
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                        ---------}}
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn bg-primary text-light" style="cursor: pointer" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                </ul>

                <div class="search" style="position: relative; top: 22px;">
{{------
                    <form action="{{ route($route . '.index') }}" method="GET">
                       {{csrf_field()}}
                       {{ method_field("GET") }}
                       <div class="form-group row">
                        <div class="col-sm-8">
                         <input type="search" name="search" value="{{ request()->search }}" class="form-control" placeholder="&nbsp;Search">
                        </div>
                        <div class="col-sm-4">
                          <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                       </div>
                      </form>
                      ----}}

                   </div>


                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    @if(Auth::guard('admin')->check())


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('logoutAdmin') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ url('logoutAdmin') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @elseif(Auth::user())

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

                    @else

                    @guest

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                    @endif

                </ul>


            </div>
        </div>
    </nav>

    <div class="content ">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>


    </div>

</div>

    <!-- End Navbar -->

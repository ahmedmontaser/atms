@extends('Dashboard\Layout\sidebar')

@php
    $route = 'employees';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <h3 style="padding: 20px">Head of Department</h3>

                    @if($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Head Name</th>
                                <th scope="col">E-mail</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $index=>$user)
                                @if($user->head == 1)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route($route. '.show' , $user->id)}}" style="cursor: pointer">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>

                <div class="card-body">

                    <h3 style="padding: 20px">Employees</h3>
                    @if($users->count() > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $index=>$user)
                            @if($user->head == 0)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{route($route. '.show' , $user->id)}}" style="cursor: pointer">
                                        View
                                    </a>
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


@endsection

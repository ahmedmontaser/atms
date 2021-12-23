@extends('Dashboard\Layout\sidebar')

@php
    $route = 'requests';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <h3 style="padding: 20px">Join Requests</h3>


                </div>

                <div class="card-body">

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

                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{url('requests/edit' ,$user->id )}}" style="cursor: pointer">
                                            Accept
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{url('requests/destroy' ,$user->id )}}" style="cursor: pointer" class="text-danger">
                                            Deny
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

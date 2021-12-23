@extends('layouts.app')

@section('content')

    <!----  start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3 style="padding: 20px">Employees</h3>
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
                                    @if($user->head == 0)
                                        <tr>
                                            <td>{{$index +1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <a href="{{route('employees.show' , $user->id)}}" style="cursor: pointer">
                                                    View
                                                </a>
                                            </td>
                                            <td>
                                                <i style="color: green" class="fa fa-circle"></i>
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

    <!----  end container -->


@endsection


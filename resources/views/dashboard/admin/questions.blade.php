@extends('Dashboard\Layout\sidebar')

@php
    $route = 'admins';

@endphp

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   Questions
                </div>

                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-primary text-light" data-toggle="modal" data-target="#exampleModal">
                        Add
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('questions.store')}}" method="post">
                                    @csrf
                                <div class="modal-body">

                                        Question :
                                        <input type="text" name="text" class="form-control" placeholder="Question">
                                        Department :
                                        <select class="form-control" name="department_id">
                                            @if($departments->count() > 0)
                                                @foreach($departments  as $department)
                                                     <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                             @endif
                                        </select>

                                        Answer  1 :

                                        <input type="text" name="answer1" class="form-control" placeholder="Answer 1 ">


                                        Answer  2 :

                                        <input type="text" name="answer2" class="form-control" placeholder="Answer 2 ">


                                        Answer  3 :

                                        <input type="text" name="answer3" class="form-control" placeholder="Answer 3 ">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg-primary text-light" style="cursor:pointer">Save</button>
                                    <button type="button" class="btn bg-dark text-light" data-dismiss="modal" style="cursor:pointer">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Department</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($questions as $index=>$question)

                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$question->text}}</td>
                                <td>{{$question->department->name}}</td>
                                <td>
                                    <a href="{{url('questions/destroy' , $question->id)}}">
                                        <button type="button" class="btn bg-dark text-light btn-sm"  style="cursor:pointer">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

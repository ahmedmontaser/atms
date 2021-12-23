@extends('layouts.app')


@section('content')

    <!----  start container -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h3>Prove your Attendance , By Checking the Day.</h3>
                    </div>

                    <div class="card-body row justify-content-center align-items-center">
                            <div class="col-md-6 ">
                                <div class="about-box">
                                    <h4> Today is :</h4>
                                    <p> {{date('l jS \of F Y h:i A')}}</p>

                                    @if ((date('H') > 7) && (date('H') < 14))
                                        <a class="btn btn-primary" href="{{url('check')}}">Check</a>

                                    @else
                                        <a class="btn btn-dark text-light" style="cursor:not-allowed ;" disabled="disabled">Check</a>
                                    @endif

                                    @if (date('H') > 14)
                                        <a class="btn btn-success" href="{{url('out')}}">Check out</a>

                                    @else
                                        <a class="btn btn-dark text-light" style="cursor:not-allowed " disabled="disabled">Check out</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 row justify-content-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary text-light" data-toggle="modal" data-target="#leaverequestmodel">
                                    Send Leaving Request
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="leaverequestmodel" tabindex="-1" role="dialog" aria-labelledby="leaverequestlabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="leaverequestlabel">Leaving Request</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form id="leaverequest">
                                                    @csrf
                                                    <input id="reason" type="text" placeholder="Reason of Leaving .." name="reason" style="border: 1px solid green;border-radius: 10px;margin-bottom: 10px;"  class="form-control">

                                                    <button type="button" id="colse-btn" class=" btn btn-secondary" data-dismiss="modal">Close</button>

                                                    <input type="submit" class="btn btn-success" value="Send" style="cursor: pointer">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


    <!----  end container -->


@endsection

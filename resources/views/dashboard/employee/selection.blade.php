<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/employee/select-style.css">
        <title>Selection</title>
    </head>
    <body>
        <section>
            <form class="contain" method="post" action="{{url( 'addingEmployee')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <label for="img-viewer" >Upload your Picture</label>
                <div class="img-contain">
                    <img src="{{asset('images/default/img_212908.png')}}" onclick="tiggerClick()" class="img-fluid" id="img-viewer">
                    <input type="file" onchange="displayImage(this)" id="img-chooser" style="display: none" name="pic" class=" @error('pic') is-invalid @enderror"  value="{{ old('pic') }}">

                    @error('pic')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <label for="select" >Choose your Department</label>
                <select class="form-control  @error('department_id') is-invalid @enderror"  value="{{ old('department_id') }}" id="select" name="department_id">
                    @if($departments->count() > 0)
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">
                                {{$department->name}}
                            </option>
                        @endforeach
                    @endif
                </select>

                @error('department_id')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button class="btn btn-success" type="submit">Save</button>
            </form>
        </section>
        <script src="js/employee/selection/custom.js"></script>
    </body>
</html>

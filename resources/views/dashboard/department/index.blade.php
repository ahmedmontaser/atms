@extends('Dashboard\Layout\sidebar')

@php
	$route = 'departments'
@endphp

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<a href="{{route($route. '.create')}}">
						<button class="btn bg-primary text-light">Add</button>
					</a>
				</div>

				<div class="card-body">
					@if($departments->count() > 0)

						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Department</th>
							</tr>
							</thead>
							<tbody>

							@foreach ($departments as $index=>$department)
								<tr>
									<td>{{$index +1}}</td>
									<td>{{$department->name}}</td>
									<td>
										<a href="{{ url('departments/destroy' ,$department->id )}}" class="text-danger">Delete</a>
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

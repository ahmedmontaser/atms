<footer class="footer">
	<div class="container-fluid">
		<nav>
			<ul class="footer-menu">
				<li><a href="#">Home</a></li>
				<li><a href="#">Company</a></li>
				<li><a href="#">Portfolio</a></li>
				<li><a href="#">Blog</a></li>
			</ul>
			<p class="copyright text-center">
				©
				<script>
					document.write(new Date().getFullYear())
				</script>
				<a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
			</p>
		</nav>
	</div>
</footer>
</div>


<div class="fixed-plugin">
	<div class="dropdown show-dropdown">
		<a href="#" data-toggle="dropdown">
			<i class="fa fa-cog fa-2x"> </i>
		</a>

		<ul class="dropdown-menu">
			<li class="header-title"> Sidebar Style</li>
			<li class="adjustments-line">
				<a href="javascript:void(0)" class="switch-trigger">
					<p>Background Image</p>
					<label class="switch">
						<input type="checkbox" data-toggle="switch" checked="" data-on-color="primary"
							   data-off-color="primary"><span class="toggle"></span>
					</label>
					<div class="clearfix"></div>
				</a>
			</li>
			<li class="adjustments-line">
				<a href="javascript:void(0)" class="switch-trigger background-color">
					<p>Filters</p>
					<div class="pull-right">
						<span class="badge filter badge-black" data-color="black"></span>
						<span class="badge filter badge-azure" data-color="azure"></span>
						<span class="badge filter badge-green" data-color="green"></span>
						<span class="badge filter badge-orange" data-color="orange"></span>
						<span class="badge filter badge-red" data-color="red"></span>
						<span class="badge filter badge-purple active" data-color="purple"></span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<li class="header-title">Sidebar Images</li>

			<li class="active">
				<a class="img-holder switch-trigger" href="javascript:void(0)">
					<img src="{{asset('img/sidebar-1.jpg')}}" alt=""/>
				</a>
			</li>
			<li>
				<a class="img-holder switch-trigger" href="javascript:void(0)">
					<img src="{{asset('img/sidebar-3.jpg')}}" alt=""/>
				</a>
			</li>
			<li>
				<a class="img-holder switch-trigger" href="javascript:void(0)">
					<img src="{{asset('img/sidebar-4.jpg')}}" alt=""/>
				</a>
			</li>
			<li>
				<a class="img-holder switch-trigger" href="javascript:void(0)">
					<img src="{{asset('img/sidebar-5.jpg')}}" alt=""/>
				</a>
			</li>


			<li class="header-title pro-title text-center">Want more components?</li>


			<li class="header-title" id="sharrreTitle">Thank you for sharing!</li>

			<li class="button-container">
				<button id="twitter" class="btn btn-social btn-outline btn-twitter btn-round sharrre"><i
							class="fa fa-twitter"></i> · 256
				</button>
				<button id="facebook" class="btn btn-social btn-outline btn-facebook btn-round sharrre"><i
							class="fa fa-facebook-square"></i> · 426
				</button>
			</li>
		</ul>
	</div>
</div>


</body>
<!--   Core JS Files   -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here-->
<script src="{{asset('js/plugins/bootstrap-switch.js')}}"></script>

<!-- Include this in your blade layout -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!--  Notifications Plugin    -->
<script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>

<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('js/light-bootstrap-dashboard.js?v=2.0.0')}}" type="text/javascript"></script>

<!-- Light Bootstrap Dashboard DEMO methods, dont include it in your project! -->
<script src="{{asset('js/demo.js')}}"></script>

<script src="{{asset('js/backend.js')}}"></script>

<script>

	$(document).ready(function() {

		// view Admin Notifications

		$('#admin_new_notification_viewer').on('click', function() {
			$.getJSON("{{url('getNotificationsAdmin')}}", function( data ) {

				var jsonData = data.data;
				var notifications = "";

				if ( jsonData.length < 5 ) {
					for ( var i = 0; i < jsonData.length; i++ ) {

						@if(isset($users))
								@foreach($users as $user)
						if ( jsonData[i]['user_id'] == "{{$user->id}}" ) {
							notifications += '<li style="margin: 5px">';
							notifications += 'Employee : ' + '{{$user->name}}' + ' Asking for Leave .  <a href="../../admins/viewRequest/' + jsonData[i]["id"] + ' ">' +
								'<button type="button" class="btn btn-light text-dark"> View Request </button>' +
								'</a>' +
								'</li>';
						}

						@endforeach
						@endif

					}
				} else {
					if ( jsonData.length > 0 ) {
						for ( var i = 0; i < 5; i++ ) {
							@if(isset($users))
									@foreach($users as $user)
							if ( jsonData[i]['user_id'] == "{{$user->id}}" ) {
								notifications += '<li>';
								notifications += 'Employee : ' + '{{$user->name}}' + ' Asking for Leave .  <a href="../../admins/viewRequest/' + jsonData[i]["id"] + ' ">' +
									'<button type="button" class="btn btn-light text-dark" >View Request </button>' +
									'</a>' +
									'</li>';
							}

							@endforeach
							@endif
						}
					} else {
						notifications += "<li>";
						notifications += 'no notifications';
						notifications += "</li>";

					}
				}

				notifications += ' <a href="{{url('admins/notifications')}}" style=\"cursor: pointer\" class=\"btn dropdown-item text-primary\">\n' +
					'                                        View All Notifications\n' +
					'                                   </a>';

				console.log('clicked');

				$('#admin-notification-menu').html(notifications);
			})
		});

//READ NUM OF NOTIFICATIONS BY AJAX FOR ADMIN
		function getAdminNotifications() {
			$.ajax({
				type: "GET",
				url: "{{url('getNewNotificationsNumberAdmin')}}",
				success: function( response ) {
					$('#notification-counter-admin').html(response)
					if ( response == 0 ) {
						$('#notification-counter-admin').css('background-color', 'gray');
					}

					if ( response > 0 ) {
						$('#notification-counter-admin').css('background-color', 'red');
					}

				},
				error: function( error ) {
					$('#notification-counter-admin').html(0);
					$('#notification-counter-admin').css('background-color', 'gray');
				}
			})
		}

		getAdminNotifications();

		window.setInterval(function() {
			getAdminNotifications();
		}, 5000);

	})

</script>

</html>

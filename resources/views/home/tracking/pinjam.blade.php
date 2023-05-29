@extends('home.partials.public')
<link rel="shortcut icon" href="{{ asset('assets/images/jabar.png') }}">
<nav class="navbar bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <!-- <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 25px;"> -->
  </a>
  <marquee><img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 35px;">Selamat datang di website IT Solution Dinas Komunikasi & Informatika Provinsi Jawa Barat <img src="{{ asset('assets/images/logo_diskom.svg') }}" alt="Diskominfo" class="brand-image" style="height: 50px; width: 150px; margin-left: 0px;"></marquee>
  </div>
</nav>
@section('container')
<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
		<script>
			$(document).ready(function() {
			var calendar = $('#calendar').fullCalendar({
				editable:true,
				header:{
				left:'prev,next today',
				center:'title',
				right:'month,agendaWeek,agendaDay'
				},
				events: 'load.php',
				// selectable:true,
				// selectHelper:true,
				select: function(start, end, allDay)
				{
				var title = prompt("Enter Event Title");
				if(title)
				{
				var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
				var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
				$.ajax({
				url:"insert.php",
				type:"POST",
				data:{title:title, start:start, end:end},
				success:function()
				{
					calendar.fullCalendar('refetchEvents');
					alert("Added Successfully");
				}
				})
				}
				},
				editable:true,
				eventResize:function(event)
				{
				var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				var title = event.title;
				var id = event.id;
				$.ajax({
				url:"update.php",
				type:"POST",
				data:{title:title, start:start, end:end, id:id},
				success:function(){
				calendar.fullCalendar('refetchEvents');
				alert('Event Update');
				}
				})
				},

				eventDrop:function(event)
				{
				var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				var title = event.title;
				var id = event.id;
				$.ajax({
				url:"update.php",
				type:"POST",
				data:{title:title, start:start, end:end, id:id},
				success:function()
				{
				calendar.fullCalendar('refetchEvents');
				alert("Event Updated");
				}
				});
				},

				//ini query contoh untuk delete (diweb lengkapnya) udh ada di wa linknya
				eventClick:function(event)
				{
				if(confirm("Are you sure you want to remove it?"))
				{
				var id = event.id;
				$.ajax({
				url:"delete.php",
				type:"POST",
				data:{id:id},
				success:function()
				{
					calendar.fullCalendar('refetchEvents');
					alert("Event Removed");
				}
				})
				}
				},

			});
			});
		</script>
	</head>
	<body><br>
		<div class="row">
			<div class="col-md-4 grid-margin stretch-card">
				<div class="row">
						<div class="card mx-auto" style="width:350px;height: 220px;" id="box1" >
						<div class="card-body">
							<h5 class="card-body text-center">Permohonan Peminjaman Aset</h5>
							</div>
							<a href="/peminjaman/" class="btn btn-danger">Ajukan Peminjaman</a>
						</div>
						</div>
						<div class="row">
						<div class="card mx-auto" style="width:350px;height: 250px;" id="box1">
							<div class="card-body">
							<h5 class="card-body text-center">Cek Status Peminjaman Anda Disini</h5>
						</div>
						<a href="/tracking" class="btn btn-primary">Cek Status</a>
						</div>
					</div>
				</div>
			<div class="col-md-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-row justify-content-between">
							<h4 class="card-title mb-1"><b>Jadwal Peminjaman</b></h4>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="preview-list">
									<div id="dataTable_wrapper">
										<div id="calendar" class="table table-bordered table-responsive">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
@endsection
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard | EMonev Kab. Sanggau</title>

		<!-- Bootstrap CSS -->
		<link href="{{URL::to('source/css/bootstrap.min.css')}}" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="{{URL::to('source/css/font-awesome.min.css')}}" rel="stylesheet">
		<!-- Plugin Style CSS -->
		<link rel="stylesheet" href="{{URL::to('source/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
		<!-- Plugin Datatable CSS-->
		<link rel="stylesheet" href="{{URL::to('source/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
		<!-- Other Plugin Style CSS -->
		@yield('style')
		<!-- Style CSS -->
		<link href="{{URL::to('source/css/style.css')}}" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background:#f1f1f1;">
		<!-- SIDEBAR -->
		<div id="sidebar">
			<a href="{{URL::to('/')}}"><div class="sidebar__logo">
				<img src="{{URL::to('source/images/logo-sanggau.png')}}" alt="">
				<h1>EMonev</h1>
				<p>Sistem Informasi Monitoring dan Evaluasi</p>
			</div></a>
			<p style="color: #fff; margin-left: 15px; font-weight: 700;"> Username: {{Auth::user()->username}}</p>
			<ul class="list sidebar__list">
				<li><a href="{{URL::to('/emonevpanel')}}">Dashboard</a></li>
				<li class="@if($menu=='program') active @endif"><a href="{{URL::to('/emonevpanel/program')}}">Program</a></li>
				<li class="@if($menu=='kegiatan') active @endif"><a href="{{URL::to('/emonevpanel/kegiatan')}}">Kegiatan</a></li>
				<li class="@if($menu=='paket') active @endif"><a href="{{URL::to('/emonevpanel/daftar-paket')}}">Daftar Paket</a></li>
				<li class="@if($menu=='lelang') active @endif"><a href="{{URL::to('/emonevpanel/paket-lelang')}}">Paket Lelang</a></li>
				<li class="@if($menu=='progress') active @endif"><a href="{{URL::to('/emonevpanel/progres-lelang')}}">Progres Lelang</a></li>
				<li class="@if($menu=='progres-paket') active @endif"><a href="{{URL::to('/emonevpanel/progres-paket')}}">Progres Paket</a></li>
				<li class="@if($menu=='realisasi') active @endif"><a href="{{URL::to('/emonevpanel/realisasi')}}">Realisasi Kegiatan</a></li>

				<li class="@if($menu=='summary') active @endif" style="margin-top:20px;"><a href="{{URL::to('/emonevpanel/summary')}}">Summary</a></li>

				@if(Auth::user()->level != 'adminskpd')
				<li class="@if($menu=='rencana') active @endif" style="margin-top:20px;"><a href="{{URL::to('/emonevpanel/rencana-realisasi')}}">Rencana Realisasi</a></li>
				<li class="@if($menu=='grup-deviasi') active @endif"><a href="{{URL::to('/emonevpanel/grup-deviasi')}}">Grup Deviasi</a></li>

				@endif
				<li class="@if($menu=='pegawai') active @endif" ><a href="{{URL::to('/emonevpanel/pegawai')}}">Pegawai</a></li>
				<li class="@if($menu=='akun') active @endif" style="margin-top:20px;"><a href="{{URL::to('/emonevpanel/akun')}}">Akun</a></li>
				<li><a href="{{URL::to('logout')}}">Logout</a></li>
			</ul>
		</div> <!-- END SIDEBAR -->

		<!-- SECTION CONTENT -->
		<section class="section__content">
			<!-- WRAPPER -->
			<div id="wrapper">
				<!-- Costum Content -->
				@yield('content')
				<!-- End Costum Content -->
			</div> <!-- END WRAPPER -->
		</section> <!-- END SECTION CONTENT -->

		<!-- jQuery -->
		<script src="{{URL::to('source/js/jquery-1.11.3.min.js')}}"></script>
		<!-- Bootstrap JavaScript -->
		<script src="{{URL::to('source/js/bootstrap.min.js')}}"></script>
		<!-- Plugin JavaScript -->
		<!-- Plugin Bootstrap Select -->
		<script type="text/javascript" src="{{URL::to('source/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
		<!-- Plugin Bootstrap Validation -->
		<script type="text/javascript" src="{{URL::to('source/plugins/bootstrap-validator/dist/validator.min.js')}}"></script>
		<!-- Plugin Datatable -->
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/dataTables.bootstrap.min.js')}}"></script>
		<!-- Other Plugin Style CSS -->
		@yield('script')
		<!-- App JavaScript -->
		<script src="{{URL::to('source/js/app.js')}}"></script>
	</body>
</html>
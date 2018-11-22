<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | EMonev Kab. Sanggau</title>
	<link rel="stylesheet" href="{{URL::to('source/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
	@yield('style')
	<link rel="stylesheet" href="{{URL::to('source/css/style.css')}}">
	<style type="text/css">
		form{
			margin-left: 30px;
		}
	</style>
</head>
<body>
	<header>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">
						<img src="{{URL::to('source/images/logo-sanggau-front.png')}}" alt="">
						<h1>E-Monev</h1>
						<p>Kabupaten Sanggau</p>
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="{{URL::to('/emonevpanel')}}">Dashboard</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{URL::to('/emonevpanel/program')}}">Program</a></li>
								<li><a href="{{URL::to('/emonevpanel/kegiatan')}}">Kegiatan</a></li>
								<li><a href="{{URL::to('/emonevpanel/daftar-paket')}}">Daftar Paket</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{URL::to('/emonevpanel/paket-lelang')}}">Paket Tender</a></li>
								<li><a href="{{URL::to('/emonevpanel/progres-lelang')}}">Progres Tender</a></li>
								<li><a href="{{URL::to('/emonevpanel/progres-paket')}}">Progres Paket</a></li>
								<li><a href="{{URL::to('/emonevpanel/realisasi')}}">Realisasi Kegiatan</a></li>
						</ul>
						</li>		
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 3 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{URL::to('/emonevpanel/summary')}}">Summary</a></li>
						@if(Auth::user()->level != 'adminskpd')
						<li><a href="{{URL::to('/emonevpanel/rencana-realisasi')}}">Rencana Realisasi</a></li>
						<li><a href="{{URL::to('/emonevpanel/grup-deviasi')}}">Grup Deviasi</a></li>
						@endif
						</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 4 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{URL::to('/emonevpanel/pegawai')}}">Pegawai</a></li>
								<li><a href="{{URL::to('/emonevpanel/akun')}}">Akun</a></li>
								<li><a href="{{URL::to('logout')}}">Logout</a></li>
						</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->

			</div><!-- /.container -->
		</nav>
	</header>
	<section style="padding:10px 20px;">
<div class="container" style="background: #acc5da36;margin-top: -10px;min-height: 80vh;">
<div class="row">
	@yield('content')
	</div>
</div>
</section>
	
	<footer style="position: static;bottom: 0px;width: 100%;">
		<p>Copyright 2013 - {{date("Y")}} Bagian Pembangunan Sekretariat Daerah Kabupaten Sanggau</p>
	</footer>

	<script type="text/javascript" src="{{URL::to('source/js/jquery-1.11.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::to('source/js/bootstrap.min.js')}}"></script>

	<!-- Plugin Bootstrap Select -->
		<script type="text/javascript" src="{{URL::to('source/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
		<!-- Plugin Bootstrap Validation -->
		<script type="text/javascript" src="{{URL::to('source/plugins/bootstrap-validator/dist/validator.min.js')}}"></script>
		<!-- Plugin Datatable -->
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
		<script type="text/javascript" src="{{URL::to('source/plugins/datatables/js/dataTables.bootstrap.min.js')}}"></script>
	@yield('script')
	<!-- App JavaScript -->
		<script src="{{URL::to('source/js/app.js')}}"></script>
</body>
</html>

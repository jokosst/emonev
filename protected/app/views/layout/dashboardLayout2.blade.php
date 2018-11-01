<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard | EMonev Kab. Sanggau</title>
	<link rel="stylesheet" href="{{URL::to('source/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/css/font-awesome.min.css')}}">
	@yield('style')
	<link rel="stylesheet" href="{{URL::to('source/css/style.css')}}">
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
								<li><a href="{{URL::to('/emonevpanel/paket-lelang')}}">Paket Lelang</a></li>
								<li><a href="{{URL::to('/emonevpanel/progres-lelang')}}">Progres Lelang</a></li>
								<li><a href="{{URL::to('/emonevpanel/progres-paket')}}">Progres Paket</a></li>
								<li><a href="{{URL::to('/emonevpanel/realisasi')}}">Realisasi Kegiatan</a></li>
						</ul>
						</li>		
						
						<li><a href="{{URL::to('/emonevpanel/summary')}}">Summary</a></li>
						@if(Auth::user()->level != 'adminskpd')
						<li><a href="{{URL::to('/emonevpanel/rencana-realisasi')}}">Rencana Realisasi</a></li>
						<li><a href="{{URL::to('/emonevpanel/grup-deviasi')}}">Grup Deviasi</a></li>
						@endif
					</ul>
				</div><!-- /.navbar-collapse -->

			</div><!-- /.container -->
		</nav>
	</header>
	@yield('content')
	<footer>
		<p>Copyright 2013 - {{date("Y")}} Bagian Pembangunan Sekretariat Daerah Kabupaten Sanggau</p>
	</footer>
	<script type="text/javascript" src="{{URL::to('source/js/jquery-1.11.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::to('source/js/bootstrap.min.js')}}"></script>
	@yield('script')
</body>
</html>
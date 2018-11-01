@extends('layout.dashboardLayout')

@section('content')
	<h2 class="menu__header">Summary</h2>
	<div class="row">
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-a1')}}"><div class="box__section">
				<h3>Format A1</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-a2')}}"><div class="box__section">
				<h3>Format A2</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-a3')}}"><div class="box__section">
				<h3>Format A3</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-a4')}}"><div class="box__section">
				<h3>Format A4</h3>
			</div></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-b')}}"><div class="box__section">
				<h3>Format B</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-d')}}"><div class="box__section">
				<h3>Format D</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-dk1')}}"><div class="box__section">
				<h3>Format DK1</h3>
			</div></a>
		</div>
		<div class="col-md-3">
			<a href="{{URL::to('emonevpanel/summary/format-fiskeu')}}"><div class="box__section">
				<h3>Format RFK</h3>
			</div></a>
		</div>
	</div>
@endsection
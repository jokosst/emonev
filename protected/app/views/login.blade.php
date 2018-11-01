<!doctype html>
<html>
<head>
	<title>Halaman Login EMonev Kab. Sanggau</title>
	<link rel="stylesheet" href="{{URL::to('source/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('source/css/style.css')}}">
</head>
<body style="background:#f1f1f1;">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="box__login">
				<img src="{{URL::to('source/images/logo-sanggau.png')}}" alt="">
				<h1>E-Monev Kab. Sanggau</h1>
				{{ Form::open(array('url' => 'login')) }}
					<div class="form-group">
						<input type="text" name="username" class="form-control" id="" placeholder="Username">
						@if($errors->has('username'))
							{{ $errors->first('username') }}
						@endif
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" id="" placeholder="Password">
						@if($errors->has('password'))
							{{ $errors->first('password') }}
						@endif
					</div>
					<button type="submit" class="btn btn-primary btn-lg" style="background:#85C225; border:none;">Submit</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</body>
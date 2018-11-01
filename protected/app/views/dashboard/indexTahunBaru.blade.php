@extends('layout.dashboardLayout')

@section('content')
<h2 class="menu__header">Tahun Baru</h2>
<p style="background:#f1f1f1; padding:10px; margin-bottom:15px;"><b>Perhatian :</b> <br>
	Halaman ini ditujukan untuk melakukan <b>Tambah Tahun baru</b> pada sistem. Halaman ini hanya dikhususkan untuk superadmin, dan apabila telah dilakukan proses penambahan tahun, tidak bisa di batalkan.</p>
	<form action="" method="POST" role="form">
		<button type="submit" class="btn btn-primary" id="submitTahun">Tambah Tahun</button>
	</form>
@endsection

@section('script')
	<script type="text/javascript">
	$("#submitTahun").click(function() {
		var c = confirm("Apakah Anda Yakin akan melakukan menambahkan tahun baru?");
		if(c == true) {
			return true;
		}
		return false;
	})
	</script>
@endsection
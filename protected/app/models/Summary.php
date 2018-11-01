<?php

class Summary extends Eloquent {

	public static function ubah_hasil_kegiatan($hasil) {
		if($hasil == 'non-konstruksi') {
			$result = 'NK';
		} elseif($hasil == 'konstruksi') {
			$result = 'K';
		}
		return $result;
	}

	public static function ubah_jenis_belanja_paket($belanja) {
		if($belanja == 'barang-jasa') {
			$result = 'BJ';
		} elseif($belanja == 'modal') {
			$result = 'BM';
		}
		return $result;
	}

	public static function ubah_metode_pengadaan($metode) {
		if($metode == 'lelang-sederhana') {
			$result = 'LS';
		} elseif($metode == 'lelang-terbatas') {
			$result = 'LT';
		} elseif($metode == 'lelang-umum') {
			$result = 'LU';
		} elseif($metode == 'pemilihan-langsung') {
			$result = 'PML';
		} elseif($metode == 'pengadaan-langsung') {
			$result = 'PK';
		} elseif($metode == 'penunjukan-langsung') {
			$result = 'PL';
		} elseif($metode == 'sayembara') {
			$result = 'SY';
		} elseif($metode == 'seleksi-sederhana') {
			$result = 'SS';
		} elseif($metode == 'seleksi-umum') {
			$result = 'SU';
		} elseif($metode == 'swakelola-program') {
			$result = 'SWAP';
		} elseif($metode == 'swakelola-rutin') {
			$result = 'SWAT';
		}
		return $result;
	}

	public static function ubah_milyar($uang) {
		$milyar = $uang / 1000000000;
		return round($milyar,2);
	}

	public static function ubah_jenis_pengadaan($jenis) {
		if($jenis == 'barang') {
			$result = 'B';
		} elseif($jenis == 'konstruksi') {
			$result = 'K';
		} elseif($jenis == 'konsultan_supervisi') {
			$result = 'S';
		} elseif($jenis == 'lainnya') {
			$result = 'J';
		}
		return $result;
	}


	public function hitung_total_paket($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->first();
		return $total;
	}



	public function hitung_jenis_belanja($skpd_id,$tahun_id,$jenis_belanja)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id','=',$skpd_id)
					->where('daftar_paket.tahun_id','=',$tahun_id)
					->where('kegiatan.jenis_belanja','=',$jenis_belanja)
					->first();
		return $total;
	}

	public function hitung_jenis_belanja_langsung($skpd_id,$tahun_id,$jenis_belanja_langsung)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id','=',$skpd_id)
					->where('daftar_paket.tahun_id','=',$tahun_id)
					->where('kegiatan.jenis_belanja','=','bl')
					->where($jenis_belanja_langsung,'>',0)
					->first();
		return $total;
	}

	public function hitung_kpa_paket($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket,pegawai,sumber_dana,hasil_kegiatan'))
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id','=',$skpd_id)
					->where('daftar_paket.tahun_id','=',$tahun_id)
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blp','>',0)
					->get();
		return $total;
	}

	public function hitung_kontraktual($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('metode','!=','swakelola-program')
					->where('metode','!=','swakelola-rutin')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function hitung_swakelola($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where(function($query)
					{
						$query->where('metode','=','swakelola-program')
							  ->orWhere('metode','=','swakelola-rutin');
					})
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function hitung_kontraktual1($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','lelang-umum')
							  ->orWhere('metode','=','seleksi-umum')
							  ->orWhere('metode','=','lelang-terbatas');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_kontraktual1($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','lelang-umum')
							  ->orWhere('metode','=','seleksi-umum')
							  ->orWhere('metode','=','lelang-terbatas');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_kontraktual2($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','pemilihan-langsung')
							  ->orWhere('metode','=','lelang-sederhana')
							  ->orWhere('metode','=','seleksi-sederhana');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_kontraktual2($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','pemilihan-langsung')
							  ->orWhere('metode','=','lelang-sederhana')
							  ->orWhere('metode','=','seleksi-sederhana');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_kontraktual3($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','penunjukan-langsung')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_kontraktual3($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','penunjukan-langsung')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_kontraktual4($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','sayembara')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_kontraktual4($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','sayembara')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_kontraktual5($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','pengadaan-langsung')
							  ->orWhere('metode','=','e-purchasing');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_kontraktual5($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where(function($query)
					{
						$query->where('metode','=','pengadaan-langsung')
							  ->orWhere('metode','=','e-purchasing');
					})
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_swakelola_rutin($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','swakelola-rutin')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_swakelola_rutin($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','swakelola-rutin')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

	public function hitung_swakelola_program($skpd_id,$tahun_id)
	{
		$total = DB::table('daftar_paket')
					->select(DB::raw('COUNT(paket) as jmlPaket, SUM(nilai_pagu_paket) as paguPaket'))
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','swakelola-program')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->first();
		return $total;
	}

	public function data_swakelola_program($skpd_id,$tahun_id)
	{
		$data = DB::table('daftar_paket')
					->leftJoin('kegiatan','kegiatan.id','=','daftar_paket.kegiatan_id')
					->leftJoin('lokasi','lokasi.id','=','daftar_paket.lokasi_id')
					->leftJoin('pegawai','pegawai.id','=','daftar_paket.pegawai_id')
					->where('daftar_paket.skpd_id',$skpd_id)
					->where('daftar_paket.tahun_id',$tahun_id)
					->where('metode','swakelola-program')
					->where('kegiatan.jenis_belanja','=','bl')
					->where('kegiatan.blnp','>',0)
					->get();
		return $data;
	}

}

?>
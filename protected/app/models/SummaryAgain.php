<?php

class SummaryAgain extends Eloquent {

	public function formatA4($skpd_id,$tahun_id,$jenis_pengadaan)
	{
		$data = DB::select(
			"SELECT paket,nilai_pagu_paket, sumber_dana,lokasi.lokasi, metode, pegawai.pegawai FROM `daftar_paket`
			 LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			 LEFT JOIN lokasi ON lokasi.id = daftar_paket.lokasi_id
			 LEFT JOIN pegawai ON pegawai.id = daftar_paket.pegawai_id
			 WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id AND jenis_pengadaan = '$jenis_pengadaan'");
		return $data;
	}

	public function formatB($skpd_id,$tahun_id,$jenis_pengadaan)
	{
		$data = DB::select(
			"SELECT kegiatan.sumber_dana, lokasi.lokasi, pegawai.pegawai, daftar_paket.*, paket_lelang.*  FROM `daftar_paket`
			 LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			 LEFT JOIN paket_lelang ON paket_lelang.paket_id = daftar_paket.id
			 LEFT JOIN lokasi ON lokasi.id = daftar_paket.lokasi_id
			 LEFT JOIN pegawai ON pegawai.id = daftar_paket.pegawai_id
			 WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id AND jenis_pengadaan = '$jenis_pengadaan'");
		return $data;
	}

	public function formatD($skpd_id,$tahun_id)
	{
		$data = DB::select(
			"SELECT kegiatan.sumber_dana, lokasi.lokasi, pegawai.pegawai, daftar_paket.*, paket_lelang.*,progres_lelang.*  FROM `daftar_paket`
			 LEFT JOIN paket_lelang ON paket_lelang.paket_id = daftar_paket.id
			 LEFT JOIN progres_lelang ON progres_lelang.lelang_id = paket_lelang.id
			 LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			 LEFT JOIN lokasi ON lokasi.id = daftar_paket.lokasi_id
			 LEFT JOIN pegawai ON pegawai.id = daftar_paket.pegawai_id
			 WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id ");
		return $data;
	}

	public function formatDK1($skpd_id,$tahun_id)
	{
		$Lokasi = DB::table('lokasi')->get();
		foreach($Lokasi as $lokasi)
		{
			$total[$lokasi->lokasi] = DB::select(
				"SELECT kegiatan.sumber_dana, lokasi.lokasi, pegawai.pegawai, daftar_paket.*, paket_lelang.*,progres_lelang.*  FROM `daftar_paket`
				 LEFT JOIN paket_lelang ON paket_lelang.paket_id = daftar_paket.id
				 LEFT JOIN progres_lelang ON progres_lelang.lelang_id = paket_lelang.id
				 LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
				 LEFT JOIN lokasi ON lokasi.id = daftar_paket.lokasi_id
				 LEFT JOIN pegawai ON pegawai.id = daftar_paket.pegawai_id
				 WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id AND daftar_paket.lokasi_id = $lokasi->id");
		}
		return $total;
	}
}

?>
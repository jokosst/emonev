<?php

class Summary3 extends Eloquent {

	public function hitung_total_paket_summary3($skpd_id,$tahun_id)
	{
		$total = DB::select(
			"SELECT
				COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P,
				COUNT(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then 1 else null end) as jmlMetode1,
				SUM(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then nilai_pagu_paket else null end) as paguMetode1,
				COUNT(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then 1 else null end) as jmlMetode2,
				SUM(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then nilai_pagu_paket else null end) as paguMetode2,
				COUNT(case when metode = 'penunjukan-langsung' then 1 else null end) as jmlMetode3,
				SUM(case when metode = 'penunjukan-langsung' then nilai_pagu_paket else null end) as paguMetode3,
				COUNT(case when metode = 'sayembara' then 1 else null end) as jmlMetode4,
				SUM(case when metode = 'sayembara' then nilai_pagu_paket else null end) as paguMetode4,
				COUNT(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then 1 else null end) as jmlMetode5,
				SUM(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then nilai_pagu_paket else null end) as paguMetode5,
				COUNT(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then 1 else null end) as jmlMetode6,
				SUM(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then nilai_pagu_paket else null end) as paguMetode6
			FROM daftar_paket
			LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id");
		return $total;
	}

	public function hitung_belanja_tidak_langsung($skpd_id,$tahun_id)
	{
		$total = DB::select(
			"SELECT
				COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P
			FROM daftar_paket
			LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id AND kegiatan.jenis_belanja = 'btl'");
		return $total;
	}

	public function hitung_belanja_tidak_langsung_pegawai($skpd_id,$tahun_id)
	{
		$total = DB::select(
			"SELECT
				COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P
			FROM daftar_paket
			LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			WHERE daftar_paket.skpd_id = $skpd_id
			AND daftar_paket.tahun_id = $tahun_id
			AND kegiatan.jenis_belanja = 'btl'
			AND kegiatan.btlp > 0");
		return $total;
	}


	public function hitung_belanja_langsung($skpd_id,$tahun_id)
	{
		$total = DB::select(
			"SELECT
				COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P,
				COUNT(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then 1 else null end) as jmlMetode1,
				SUM(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then nilai_pagu_paket else null end) as paguMetode1,
				COUNT(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then 1 else null end) as jmlMetode2,
				SUM(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then nilai_pagu_paket else null end) as paguMetode2,
				COUNT(case when metode = 'penunjukan-langsung' then 1 else null end) as jmlMetode3,
				SUM(case when metode = 'penunjukan-langsung' then nilai_pagu_paket else null end) as paguMetode3,
				COUNT(case when metode = 'sayembara' then 1 else null end) as jmlMetode4,
				SUM(case when metode = 'sayembara' then nilai_pagu_paket else null end) as paguMetode4,
				COUNT(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then 1 else null end) as jmlMetode5,
				SUM(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then nilai_pagu_paket else null end) as paguMetode5,
				COUNT(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then 1 else null end) as jmlMetode6,
				SUM(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then nilai_pagu_paket else null end) as paguMetode6
			FROM daftar_paket
			LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			WHERE daftar_paket.skpd_id = $skpd_id AND daftar_paket.tahun_id = $tahun_id AND kegiatan.jenis_belanja = 'bl'");
		return $total;
	}

	public function hitung_jenis_belanja_langsung($skpd_id,$tahun_id,$jenis_belanja)
	{
		$total = DB::select(
			"SELECT
				COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P,
				COUNT(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then 1 else null end) as jmlMetode1,
				SUM(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then nilai_pagu_paket else null end) as paguMetode1,
				COUNT(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then 1 else null end) as jmlMetode2,
				SUM(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then nilai_pagu_paket else null end) as paguMetode2,
				COUNT(case when metode = 'penunjukan-langsung' then 1 else null end) as jmlMetode3,
				SUM(case when metode = 'penunjukan-langsung' then nilai_pagu_paket else null end) as paguMetode3,
				COUNT(case when metode = 'sayembara' then 1 else null end) as jmlMetode4,
				SUM(case when metode = 'sayembara' then nilai_pagu_paket else null end) as paguMetode4,
				COUNT(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then 1 else null end) as jmlMetode5,
				SUM(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then nilai_pagu_paket else null end) as paguMetode5,
				COUNT(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then 1 else null end) as jmlMetode6,
				SUM(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then nilai_pagu_paket else null end) as paguMetode6
			FROM daftar_paket
			LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
			WHERE daftar_paket.skpd_id = $skpd_id
			AND daftar_paket.tahun_id = $tahun_id
			AND kegiatan.jenis_belanja = 'bl'
			AND $jenis_belanja > 0");
		return $total;
	}

	function hitung_total_lokasi($skpd_id,$tahun_id)
	{
		$Lokasi = DB::table('lokasi')->get();
		foreach($Lokasi as $lokasi)
		{
			$total[$lokasi->lokasi] = DB::select(
				"SELECT
					COUNT(paket) as jmlPaket,
				SUM(nilai_pagu_paket) as paguPaket,
				COUNT(case when sumber_dana = 'APBD' then 1 else null end) as jmlAPBD,
				SUM(case when sumber_dana = 'APBD' then nilai_pagu_paket else null end) as paguAPBD,
				COUNT(case when sumber_dana = 'APBN' then 1 else null end) as jmlAPBN,
				SUM(case when sumber_dana = 'APBN' then nilai_pagu_paket else null end) as paguAPBN,
				COUNT(case when sumber_dana = 'APBD-P' then 1 else null end) as jmlAPBD_P,
				SUM(case when sumber_dana = 'APBD-P' then nilai_pagu_paket else null end) as paguAPBD_P,
				COUNT(case when sumber_dana = 'APBN-P' then 1 else null end) as jmlAPBN_P,
				SUM(case when sumber_dana = 'APBN-P' then nilai_pagu_paket else null end) as paguAPBN_P,
				COUNT(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then 1 else null end) as jmlMetode1,
				SUM(case when metode = 'lelang-umum' or metode = 'seleksi-umum' or metode = 'lelang-terbatas' then nilai_pagu_paket else null end) as paguMetode1,
				COUNT(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then 1 else null end) as jmlMetode2,
				SUM(case when metode = 'pemilihan-langsung' or metode = 'lelang-sederhana' or metode = 'seleksi-sederhana' then nilai_pagu_paket else null end) as paguMetode2,
				COUNT(case when metode = 'penunjukan-langsung' then 1 else null end) as jmlMetode3,
				SUM(case when metode = 'penunjukan-langsung' then nilai_pagu_paket else null end) as paguMetode3,
				COUNT(case when metode = 'sayembara' then 1 else null end) as jmlMetode4,
				SUM(case when metode = 'sayembara' then nilai_pagu_paket else null end) as paguMetode4,
				COUNT(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then 1 else null end) as jmlMetode5,
				SUM(case when metode = 'pengadaan-langsung' or metode = 'e-purchasing' then nilai_pagu_paket else null end) as paguMetode5,
				COUNT(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then 1 else null end) as jmlMetode6,
				SUM(case when metode = 'swakelola-program' or metode = 'swakelola-rutin' then nilai_pagu_paket else null end) as paguMetode6
				FROM daftar_paket
				LEFT JOIN kegiatan ON kegiatan.id = daftar_paket.kegiatan_id
				WHERE daftar_paket.skpd_id = $skpd_id
				AND daftar_paket.tahun_id = $tahun_id
				AND daftar_paket.lokasi_id = $lokasi->id");
		}
		return $total;
	}

}

?>
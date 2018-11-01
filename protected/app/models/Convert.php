<?php

class Convert extends Eloquent
{
	public static function make_slug($judul)
	{
		$slug = strtolower($judul);
		$slug = str_replace('"', '', $slug);
		$slug = str_replace("'", "", $slug);
		$slug = str_replace(',', '', $slug);
		$slug = str_replace('-', '', $slug);
		$slug = str_replace(' ', '-', $slug);
		$slug = str_replace(':', '', $slug);
		$slug = str_replace('(', '', $slug);
		$slug = str_replace(')', '', $slug);
		$slug = str_replace('?', '', $slug);
		$slug = str_replace('/', '-', $slug);
		return $slug;
	}
	public static function escape_quote($text)
	{
		$slug = str_replace('"', "'", $text);
		return $slug;
	}

	// Konvesi dd-mm-yyyy -> yyyy-mm-dd
	public static	function tgl_ind_to_eng($tgl) {
		$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
		return $tgl_eng;
	}

	// Konvesi yyyy-mm-dd -> dd-mm-yyyy
	public static function tgl_eng_to_ind($tgl) {
		$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
		return $tgl_ind;
	}

	public static function ambil_tanggal($tanggal)
	{
		$date = explode('-',$tanggal);
		$date = $date[2];
		return $date;
	}
	public static function ambil_bulan($bulan)
	{
		$mounth = explode('-',$bulan);
		$mounth = $mounth[1];
		return $mounth;
	}
	public static function ubah_bulan($bulan)
	{
		if($bulan==1){$nama='Januari';}
		elseif($bulan==2){$nama='Februari';}
		elseif($bulan==3){$nama='Maret';}
		elseif($bulan==4){$nama='April';}
		elseif($bulan==5){$nama='Mei';}
		elseif($bulan==6){$nama='Juni';}
		elseif($bulan==7){$nama='Juli';}
		elseif($bulan==8){$nama='Aguustus';}
		elseif($bulan==9){$nama='September';}
		elseif($bulan==10){$nama='Oktober';}
		elseif($bulan==11){$nama='November';}
		elseif($bulan==12){$nama='Desember';}

		return $nama;
	}

	public static function TanggalIndo($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);

		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return $result;
	}

	public static function ubah_jenis_belanja($jenis) {
		if($jenis == 'bl'){
			$jenis_belanja = 'Belanja Langsung (BL)';
		} elseif($jenis = 'btl') {
			$jenis_belanja = 'Belanja Tidak Langsung (BTL)';
		}
		return $jenis_belanja;
	}

	public static function ubah_status_kontrak($status) {
		if($status == 'blt'){
			$status_kontrak = 'Belum Tanda Tangan Kontrak';
		} elseif($status = 'sdt') {
			$status_kontrak = 'Sudah Tanda Tangan Kontrak';
		}
		return $status_kontrak;
	}

	public static function ubah_tanda_strip($data) {
		$hasil = ucwords(str_replace('-', ' ', $data));
		return $hasil;
	}

	public static function ubah_kab($kab) {
		if($kab == 'Kabupaten Sanggau') {
			return 'Kab. Sanggau';
		} else {
			return $kab;
		}
	}


}
<?php

class Skpd extends Eloquent {

	protected $table = 'skpd';
	public function Pegawai() {
		return $this->hasMany('Pegawai');
	}
	public function Program() {
		return $this->hasMany('Program');
	}
	public function Kegiatan() {
		return $this->hasMany('Kegiatan');
	}
	public function Paket() {
		return $this->hasMany('Paket');
	}
	public function Lelang() {
		return $this->hasMany('Lelang');
	}
	public function Progres() {
		return $this->hasMany('Progres');
	}


	public static function getSkpd($id) {
		if (Auth::user()->level != 'adminskpd') {
			$skpd = Skpd::where('kode_skpd','!=','other')->get();
		} else {
		  $skpd = Skpd::find($id);
		}
		return $skpd;
	}

	public static function totalSkpd() {
		$total = Skpd::where('id','!=',1)->count();
		return $total;
	}
}

?>
<?php

class Tahun extends Eloquent {

	protected $table = 'tahun';
	public function Kegiatan() {
		return $this->hasMany('Kegiatan');
	}
	public function Progres() {
		return $this->hasMany('Progres');
	}
	public function Lelang() {
		return $this->hasMany('Lelang');
	}

}

 ?>
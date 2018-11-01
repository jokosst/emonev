<?php

class Lelang extends Eloquent {
	protected $table = 'paket_lelang';

	public function kegiatan() {
		return $this->belongsTo('Kegiatan');
	}
	public function paket() {
		return $this->belongsTo('Paket');
	}
	public function skpd() {
		return $this->belongsTo('Skpd');
	}
	public function tahun() {
		return $this->belongsTo('Tahun');
	}
	public function progres() {
		return $this->hasOne('Progres');
	}
}

?>
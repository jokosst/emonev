<?php

	class Paket extends Eloquent {
		protected $table = 'daftar_paket';

		public function Lelang() {
			return $this->hasMany('Lelang');
		}
		public function Realisasi() {
			return $this->hasMany('Realisasi');
		}
		public function skpd() {
			return $this->belongsTo('Skpd');
		}
		public function tahun() {
			return $this->belongsTo('Tahun');
		}
		public function kegiatan() {
			return $this->belongsTo('Kegiatan');
		}
		public function lokasi() {
			return $this->belongsTo('Lokasi');
		}
	}

?>
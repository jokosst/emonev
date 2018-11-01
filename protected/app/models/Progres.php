<?php

	class Progres extends Eloquent {

		protected $table = 'progres_lelang';
		public function tahun() {
			return $this->belongsTo('Tahun');
		}
		public function lelang() {
			return $this->belongsTo('Lelang');
		}
		public function skpd() {
			return $this->belongsTo('skpd');
		}
	}

?>
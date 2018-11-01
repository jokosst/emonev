<?php

	class Lokasi Extends Eloquent {
		protected $table = 'lokasi';

		public function Paket() {
			return $this->hasMany('Paket');
		}
	}
?>
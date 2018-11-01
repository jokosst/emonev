<?php 

class pegawai extends Eloquent {

	protected $table = 'pegawai';

	public function user() {
		return $this->hasOne('User');
	}

	public static function getKpa($id) {
		if (Auth::user()->level != 'adminskpd') {
			$kpa = Pegawai::where('skpd_id','!=',1)->where('kpa','=',1)->get();
		} else {
		  $kpa = Pegawai::where('skpd_id','=',$id)->where('kpa','=',1)->get();
		} /* END OF GET SKPD */
		return $kpa;
	}

	public function skpd() {
		return $this->belongsTo('Skpd');
	}

	public function kegiatan() {
		return $this->hasOne('Kegiatan');
	}

}

?>
<?php 

class Program extends Eloquent {
	protected $table = 'program';
	
	public function skpd() {
		return $this->belogsTo('Skpd');
	}

	public function Kegiatan() {
		return $this->hasMany('Kegiatan');
	}
}

?>
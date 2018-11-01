<?php

class Kegiatan extends Eloquent {

	protected $table = 'kegiatan';
	public function paket() {
		return $this->hasMany('Paket');
	}
	public function Lelang() {
		return $this->hasMany('Lelang');
	}
	public function Realisasi() {
		return $this->hasMany('Realisasi');
	}
	public function pegawai() {
		return $this->belongsTo('Pegawai');
	}
	public function tahun() {
		return $this->belongsTo('Tahun');
	}
	public function skpd() {
		return $this->belongsTo('Skpd');
	}
	public function program() {
		return $this->belongsTo('Program');
	}

	public static function totalKegiatan($skpd_id,$tahun_id) {
		$total = Kegiatan::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->count();
		return $total;
	}

	public static function totalKegiatanKab($tahun_id) {
		$total = Kegiatan::where('tahun_id',$tahun_id)->count();
		return $total;
	}

	public static function hitungBobot($skpd_id,$tahun_id,$kegiatan) {
		$pagu = DB::table('kegiatan')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('kegiatan',$kegiatan)->first()->pagu;
		$paguTotal = DB::table('kegiatan')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->sum('pagu');
		if($paguTotal != 0) {
			$bobot = ($pagu / $paguTotal) * 100;
		} else {
			$bobot = 0;
		}

		return $bobot;
	}

	public static function hitungTertimbang($bobot,$fisik)
	{
		$tertimbang = ($bobot * $fisik) / 100;
		return $tertimbang;
	}


	public static function getRencanaFisik($tahun_id,$bulan) {
		$rencanaFisik = DB::table('rencana_realisasi')
							->where('tahun_id',$tahun_id)
							->where('bulan',$bulan)->first()->rencana_fisik;
		return $rencanaFisik;
	}

	public static function hitungPaguSkpd($skpd_id,$tahun_id) {
		$total = DB::table('kegiatan')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->sum('pagu');
		return $total;
	}

	public static function hitungPaguKab($tahun_id) {
		$total = DB::table('kegiatan')->where('tahun_id',$tahun_id)->sum('pagu');
		return $total;
	}

	public static function hitungPaguAwal($skpd_id,$tahun_id) {
		$total = DB::table('kegiatan')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->sum('pagu_awal');
		return $total;
	}

	public static function hitungPaguPerubahan($skpd_id,$tahun_id) {
		$total = DB::table('kegiatan')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->sum('pagu_perubahan');
		return $total;
	}

	public static function hitungTotalBobot($skpd_id, $tahun_id)
	{
		$Kegiatan = DB::table('kegiatan')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->get();
		$total = '';
		foreach($Kegiatan as $kegiatan)
		{
			$bobot = self::hitungBobot($skpd_id, $tahun_id, $kegiatan->kegiatan);
			$total += $bobot;
		}
		return $total;
	}

	public static function hitungTotalFisik($skpd_id, $tahun_id, $bulan)
	{
		$fisik = DB::table('realisasi_kegiatan')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('bulan',$bulan)->sum('fisik');
		$total = $fisik / self::totalKegiatan($skpd_id, $tahun_id);
		return $total;
	}

	public static function hitungTotalTertimbang($skpd_id, $tahun_id, $bulan)
	{
		$Kegiatan = DB::table('kegiatan')->leftJoin('realisasi_kegiatan', 'kegiatan.id', '=', 'realisasi_kegiatan.kegiatan_id')->where('kegiatan.skpd_id',$skpd_id)->where('kegiatan.tahun_id',$tahun_id)->where('bulan', $bulan)->get();
		$total = '';
		foreach($Kegiatan as $kegiatan)
		{
			$bobot = self::hitungBobot($skpd_id, $tahun_id, $kegiatan->kegiatan);
			$tertimbang = self::hitungTertimbang($bobot, $kegiatan->fisik);
			$total += $tertimbang;
		}
		// $hasil = $total / self::totalKegiatan($skpd_id, $tahun_id);
		return $total;
	}

	public static function hitungTotalPengeluaran($skpd_id, $tahun_id, $bulan)
	{
		$pengeluaran = DB::table('realisasi_kegiatan')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('bulan',$bulan)->sum('pengeluaran');

		return $pengeluaran;
	}

}

?>
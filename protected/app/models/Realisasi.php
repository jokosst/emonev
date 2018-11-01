<?php

class Realisasi extends Eloquent {

	protected $table = 'realisasi_kegiatan';
	public function skpd() {
		return $this->belongsTo('Skpd');
	}
	public function tahun() {
		return $this->belongsTo('Tahun');
	}
	public function kegiatan() {
		return $this->belongsTo('Kegiatan');
	}
	public function paket() {
		return $this->belongsTo('Paket');
	}

	public function hitungUang($pengeluaran, $pagu) 
	{
		// var_dump($pagu);
		if($pagu == 0)
		{
			return $hitung = 0;
		}
		else
		{
			return $hitung = round($pengeluaran / $pagu * 100,2);
		}
	}

	public function hitungFisik($fisikSkpd, $totalKegiatan)
	{
		if($totalKegiatan == 0)
		{
			return $hitung = 0;
		}
		else
		{
			return $hitung = round($fisikSkpd / $totalKegiatan, 2);
		}
		
		
	}

	public function perhitunganSkpd($skpd_id,$tahun_id,$bulan, $parameter)
	{
		$hitung = DB::table('realisasi_kegiatan')
							->where('tahun_id',$tahun_id)
							->where('skpd_id',$skpd_id)
							->where('bulan', $bulan)
							->sum($parameter);

		return $hitung;
	}

	public function perhitunganKab($tahun_id, $bulan, $parameter)
	{
		$hitung = DB::table('realisasi_kegiatan')
							->where('tahun_id',$tahun_id)
							->where('bulan', $bulan)
							->sum($parameter);

		return $hitung;
	}


	public function realisasiKegiatan($skpd_id,$kegiatan_id,$tahun_id,$bulan) 
	{
		$realisasi = DB::table('realisasi_kegiatan')
						->where('skpd_id',$skpd_id)
						->where('kegiatan_id',$kegiatan_id)
						->where('tahun_id',$tahun_id)
						->where('bulan',$bulan)->first();
		return $realisasi;
	}

	public function realisasiSkpd($skpd_id,$tahun_id,$bulan) 
	{
		$pagu = Kegiatan::hitungPaguSkpd($skpd_id, $tahun_id);
		$totalKegiatan = Kegiatan::totalKegiatan($skpd_id,$tahun_id);
		$pengeluaran = $this->perhitunganSkpd($skpd_id,$tahun_id,$bulan, 'pengeluaran');
		$totalFisik = $this->perhitunganSkpd($skpd_id,$tahun_id,$bulan, 'fisik');

		$uang = $this->hitungUang($pengeluaran, $pagu);
		$fisik = $this->hitungFisik($totalFisik, $totalKegiatan);
		$skpd = DB::table('skpd')->where('id', '=', $skpd_id)->first()->skpd;

		$data = array('pengeluaran' => $pengeluaran, 
					  'fisik' => $fisik, 
					  'uang' => $uang, 
					  'skpd_id' => $skpd_id, 
					  'tahun_id' => $tahun_id,
					  'skpd' => $skpd,
					  'bulan' => $bulan);

		return $data;
	}

	public function realisasiKab($tahun_id,$bulan) 
	{
		$pagu = Kegiatan::hitungPaguKab($tahun_id);
		$totalKegiatan = Kegiatan::totalKegiatanKab($tahun_id);
		$pengeluaran = $this->perhitunganKab($tahun_id,$bulan, 'pengeluaran');
		$fisik = $this->perhitunganKab($tahun_id,$bulan, 'fisik');

		$uang = $this->hitungUang($pengeluaran, $pagu);
		$fisik = $this->hitungFisik($fisik, $totalKegiatan);

		$data = array('pengeluaran' => $pengeluaran, 
					  'fisik' => $fisik, 
					  'uang' => $uang, 
					  'tahun_id' => $tahun_id,
					  'bulan' => $bulan);
		return $data;
	}

	public function updateRealisasiKegiatan($skpd_id,$kegiatan_id,$tahun_id,$bulan, $pengeluaran, $paguKegiatan, $fisik) 
	{
		$uang = $this->hitungUang($pengeluaran, $paguKegiatan);
      $id = $this->realisasiKegiatan($skpd_id,$kegiatan_id,$tahun_id,$bulan)->id;
	
        DB::table('realisasi_kegiatan')
				->where('id',$id)
				->update(array('fisik'=>$fisik,
							 'uang'=>$uang,
							 'pengeluaran'=>$pengeluaran)); 
	}

	public function updateRealisasiPaket($skpd_id,$kegiatan_id,$tahun_id,$paket_id,$bulan) {
		$uang = $this->hitungUangKegiatan();
		$id = DB::table('realisasi_paket')
						->where('skpd_id',$skpd_id)
						->where('kegiatan_id',$kegiatan_id)
						->where('tahun_id',$tahun_id)
						->where('paket_id',$paket_id)
						->where('bulan',$bulan)
						->first()->id;

		DB::table('realisasi_paket')->where('id',$id)
									->update(array('fisik'=>$this->fisik,
											 	   'uang'=>$uang,
												   'pengeluaran'=>$this->pengeluaran));
	}
	
	public function getTotalBelanja($tahun_id, $skpd_id, $bulan, $jenis_belanja)
	{	
		if($skpd_id == 1)
		{
			$total_belanja = DB::table('realisasi_kegiatan')
							->leftJoin('kegiatan', 'kegiatan.id', '=', 'realisasi_kegiatan.kegiatan_id')
							->select(DB::raw('SUM(pengeluaran) as pengeluaran, SUM(fisik) as fisik'))
							->where('realisasi_kegiatan.tahun_id', '=', $tahun_id);
			
			if ($jenis_belanja != 'all')
			{
				$total_belanja = $total_belanja->where('kegiatan.jenis_belanja', '=', $jenis_belanja);
			}
			$total_belanja = $total_belanja->where('bulan', '=', $bulan)->first();

			$pagu = Kegiatan::hitungPaguKab($tahun_id);
			$totalKegiatan = Kegiatan::totalKegiatanKab($tahun_id);

			$uang = $this->hitungUang($total_belanja->pengeluaran, $pagu);
			$fisik = $this->hitungFisik($total_belanja->fisik, $totalKegiatan);
		}
		else
		{
			$total_belanja = DB::table('realisasi_kegiatan')
							->leftJoin('kegiatan', 'kegiatan.id', '=', 'realisasi_kegiatan.kegiatan_id')
							->select(DB::raw('SUM(pengeluaran) as pengeluaran, SUM(fisik) as fisik'))
							->where('realisasi_kegiatan.tahun_id', '=', $tahun_id)
							->where('realisasi_kegiatan.skpd_id', '=', $skpd_id);
							
			if ($jenis_belanja != 'all')
			{
				$total_belanja = $total_belanja->where('kegiatan.jenis_belanja', '=', $jenis_belanja);
			}
			$total_belanja = $total_belanja->where('bulan', '=', $bulan)->first();

			$pagu = Kegiatan::hitungPaguSkpd($skpd_id, $tahun_id);
			$totalKegiatan = Kegiatan::totalKegiatan($skpd_id,$tahun_id);

			$uang = $this->hitungUang($total_belanja->pengeluaran, $pagu);
			$fisik = $this->hitungFisik($total_belanja->fisik, $totalKegiatan);
		}
		
		
		return (object) array('uang' => $uang, 'fisik' => $fisik, 'pengeluaran' => $total_belanja->pengeluaran);
	}



}

?>
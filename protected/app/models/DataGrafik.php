<?php

class DataGrafik extends Eloquent{

	protected $table_realisasi_skpd = 'realisasi_skpd';
	protected $table_tahun = 'tahun';
	protected $table_rencana_realisasi = 'rencana_realisasi';
	protected $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

	/**
	* mengambil data realisasi dari suatu skpd pada tahun tertentu
	*
	* @param int $skpd_id, int $tahun_id
	* @return array
	*/
	public function getDataGrafikRealisasi($skpd_id, $tahun_id)
	{
		$tahun = Tahun::where('id', '=', $tahun_id)->pluck('tahun');
		$tahun_sebelum = $tahun - 1;
		$tahun_sebelum_id = Tahun::where('tahun', '=', $tahun_sebelum)->pluck('id');

		if ($skpd_id == 1){
			$data_realisasi = $this->getRealisasiKab($tahun_id, 'tahun_sekarang');
			$data_realisasi_sebelum = $this->getRealisasiKab($tahun_sebelum_id, 'tahun_sebelum');
		} else {
			$data_realisasi = $this->getRealisasiSkpd($skpd_id, $tahun_id, 'tahun_sekarang');
			$data_realisasi_sebelum = $this->getRealisasiSkpd($skpd_id, $tahun_sebelum_id, 'tahun_sebelum');
		}

		$data_realisasi_fisik = array();
		$data_realisasi_keuangan = array();
		$bulan = array();

		foreach($data_realisasi as $key => $item_data_realisasi)
		{
			$data_realisasi_fisik[] = $item_data_realisasi->fisik;
			$data_realisasi_keuangan[] = $item_data_realisasi->uang;
			$bulan[] = $this->bulan[($item_data_realisasi->bulan - 1)];
		}

		$series = array();

		$data_rencana = $this->getRencanaRealisasi($tahun_id);

		if (count($data_rencana['fisik']) > 0){
			$series[] = array(
							'name' => 'Rencana Fisik',
							'data' => $data_rencana['fisik']
						);
			$series[] =	array(
						'name' => 'Realisasi Fisik',
						'data' => $data_realisasi_fisik
					);
			$series[] = array(
							'name' => 'Rencana Keuangan',
							'data' => $data_rencana['uang']
						);
			$series[] =	array(
						'name' => 'Realisasi Keuangan',
						'data' => $data_realisasi_keuangan
					);
			if (count($data_rencana['bulan']) > count($bulan)){
				$bulan = $data_rencana['bulan'];
			}
		}

		
		

		//get data realisasi sebelum fisik dan keuangan
		$data_realisasi_fisik_sebelum = array();
		$data_realisasi_keuangan_sebelum = array();
		$bulan_sebelum = array();

		foreach($data_realisasi_sebelum as $key => $item_data_realisasi){
			$data_realisasi_fisik_sebelum[] = round($item_data_realisasi->fisik, 2);
			$data_realisasi_keuangan_sebelum[] = round($item_data_realisasi->uang, 2);
			$bulan_sebelum[] = $this->bulan[($item_data_realisasi->bulan - 1)];
		}

		// if (count($data_realisasi_sebelum) > 0) {
		// 	$series[] = array(
		// 					'name' => 'Realisasi Fisik '.$tahun_sebelum,
		// 					'data' => $data_realisasi_fisik_sebelum
		// 				);
		// 	$series[] = array(
		// 					'name' => 'Realisasi Keuangan '.$tahun_sebelum,
		// 					'data' => $data_realisasi_keuangan_sebelum
		// 				);
		// 	if (count($bulan_sebelum) > count($bulan)){
		// 		$bulan = $bulan_sebelum;
		// 	}
		// }

		$table_realisasi = $this->createTableRealisasiSkpd($series, $bulan);

		return array('series'=> $series, 'categories'=> $bulan, 'table'=> $table_realisasi);
	}

	public function createTableRealisasiSkpd($series, $bulan)
	{
		$data['series'] = $series;
		$data['bulan'] = $bulan;
		$view = View::make('public.table-realisasi-skpd', $data)->render();

		return $view;
	}

	public function getRealisasiSkpd($skpd_id, $tahun_id, $kondisi){
		$bulan_sekarang = date('m');
		$realisasi = New Realisasi;

		if($kondisi == 'tahun_sekarang')
		{
			for($bulan = 1; $bulan <= $bulan_sekarang; $bulan++)
			{
				$data_realisasi[] = (object) $realisasi->realisasiSkpd($skpd_id,$tahun_id,$bulan); 
			}
		}
		else if($kondisi == 'tahun_sebelum')
		{
			for($bulan = 1; $bulan <= 12; $bulan++)
			{
				$data_realisasi[] = (object) $realisasi->realisasiSkpd($skpd_id,$tahun_id,$bulan); 
			}
		}
		
		return $data_realisasi;
	}

	public function getRealisasiKab($tahun_id, $kondisi){
		$bulan_sekarang = date('m');
		$realisasi = New Realisasi;

		if($kondisi == 'tahun_sekarang')
		{
			for($bulan = 1; $bulan <= $bulan_sekarang; $bulan++)
			{
				$data_realisasi[] = (object) $realisasi->realisasiKab($tahun_id,$bulan); 
			}
		}
		else if($kondisi == 'tahun_sebelum')
		{
			for($bulan = 1; $bulan <= 12; $bulan++)
			{
				$data_realisasi[] = (object) $realisasi->realisasiKab($tahun_id,$bulan); 
			}
		}
		

		return $data_realisasi;
	}

	public function getRencanaRealisasi($tahun_id)
	{
		$data_rencana_realisasi = DB::table($this->table_rencana_realisasi)
									->where('tahun_id', '=', $tahun_id)
									->orderBy('bulan', 'ASC')
									->groupBy('bulan')
									->get();

		$data_rencana_fisik = array();
		$data_rencana_uang = array();
		$bulan = array();


		foreach($data_rencana_realisasi as $key => $item_rencana_realisasi){
			$data_rencana_fisik[] = (int) $item_rencana_realisasi->rencana_fisik;
			$data_rencana_uang[] = (int) $item_rencana_realisasi->rencana_uang;
			$bulan[] = $this->bulan[($item_rencana_realisasi->bulan - 1)];
		}

		return array('fisik' => $data_rencana_fisik, 'uang' => $data_rencana_uang, 'bulan' => $bulan);
	}

	/**
	 * Tampilkan data realisasi perbulan, deviasi
	 *
	 * @param int $tahun_id, int $skpd_id, int $bulan
	 * @return array
	 */
	public function getRealisasiSkpdBulanan($tahun_id, $skpd_id, $bulan)
	{
		$tahun = Tahun::where('id', '=', $tahun_id)->pluck('tahun');
		if (date('Y') > $tahun)
		{
			$bulan = 12;
		} 
		$bulan_sebelum = $bulan - 1;

		$realisasi = new Realisasi;

		$total_belanja_btl = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan, 'btl');
		$total_belanja_bl = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan, 'bl');
		$total_belanja = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan, 'all');

		$data_realisasi = array(
							round($total_belanja_btl->uang, 2),
							round($total_belanja_btl->fisik, 2),
							round($total_belanja_bl->uang, 2),
							round($total_belanja_bl->fisik, 2),
							round($total_belanja->uang, 2),
							round($total_belanja->fisik, 2)
						  );

		$data_kenaikan = array(0, 0, 0, 0, 0, 0);
		if ($bulan_sebelum > 0)
		{
			$total_belanja_btl_sebelum = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan_sebelum, 'btl');
			$total_belanja_bl_sebelum = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan, 'bl');
			$total_belanja_sebelum = $realisasi->getTotalBelanja($tahun_id, $skpd_id, $bulan, 'all');

			$data_kenaikan = array(
								round(($total_belanja_btl->uang - $total_belanja_btl_sebelum->uang), 2),
								round(($total_belanja_btl->fisik - $total_belanja_btl_sebelum->fisik), 2),
								round(($total_belanja_bl->uang - $total_belanja_bl_sebelum->uang), 2),
								round(($total_belanja_bl->fisik - $total_belanja_bl_sebelum->fisik), 2),
								round(($total_belanja->uang - $total_belanja_sebelum->uang), 2),
								round(($total_belanja->fisik - $total_belanja_sebelum->fisik), 2)
							 );
		}

		$rencana_realisasi = DB::table('rencana_realisasi')
							 ->where('tahun_id', '=', $tahun_id)
							 ->where('bulan', '=', $bulan)
							 ->first();

		$data_deviasi = array('-', '-', '-', '-', 0, 0);

		$data_deviasi[4] = $rencana_realisasi->rencana_uang - $data_realisasi[4];
		$data_deviasi[5] = $rencana_realisasi->rencana_fisik - $data_realisasi[5];
		// $data_deviasi[5] = round($total_rencana_fisik / $n - ($data_realisasi[5] + $data_kenaikan[5]), 2);

		$series = array(
					array(
						'name' => 'Realisasi',
						'data' => $data_realisasi
					),
					array(
						'name' => 'Kenaikan',
						'data' => $data_kenaikan
					),
					array(
						'name' => 'Deviasi',
						'data' => $data_deviasi
					) 
				  );

		$table_realisasi = $this->createTableRealisasiBulanan($series);

		return array('series' => $series, 'table'=>$table_realisasi);
	}

	public function createTableRealisasiBulanan($series)
	{
		$series_total = $series;
		unset($series_total[2]);
		$total_realisasi = array(0, 0, 0, 0, 0, 0);
		foreach($series_total as $series_content){
			foreach($series_content['data'] as $key => $value){
				$total_realisasi[$key] += $value;
			}
		}

		$data['series'] = $series;
		$data['total_realisasi'] = $total_realisasi;

		$view = View::make('public.table-realisasi-detail', $data)->render();

		return $view;
	}

	public function getTotalBelanja($tahun_id, $skpd_id, $bulan, $jenis_belanja = 'all'){
		

		return $total_belanja;
	}


	public function getIdTahunTerakhir($tahun = 0){
		// if ( $tahun == 2016 )
		// {
		// 	$tahun = 2015;
		// }

		if ($tahun == 0){
			$tahun_id = DB::table($this->table_tahun)->orderBy('tahun', 'DESC')->first()->id;
		} else {
			$tahun_id = DB::table($this->table_tahun)->where('tahun', '=', $tahun)->first()->id;
		}

		return $tahun_id;
	}

	public function getSkpd(){
		$skpd = Skpd::all();

		$list_skpd = array();
		foreach($skpd as $item_skpd){
			$list_skpd[$item_skpd->id] = $item_skpd->skpd;
		}

		return $list_skpd;
	}

	public function getTahun(){
		$tahun = DB::table($this->table_tahun)->orderBy('tahun', 'DESC')->get();

		$list_tahun = array();
		foreach($tahun as $item_tahun){
			$list_tahun[$item_tahun->id] = $item_tahun->tahun;
		}

		return $list_tahun;
	}
}
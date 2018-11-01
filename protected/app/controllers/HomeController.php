<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function homeIndex()
	{
		$tahun = date('Y'); // seharusnya
		$bulan = date('m');
		$skpd_id = 1;


		$model = new DataGrafik;
		$tahun_id = $model->getIdTahunTerakhir($tahun);
		// get realisasi fisik & keuangan
		// get rencana realisasi fisik & keuangan
		$data_realisasi = $model->getDataGrafikRealisasi($skpd_id, $tahun_id);

		// data untuk grafik realisasi
		$data['series'] = json_encode($data_realisasi['series']);
		$data['categories'] = json_encode($data_realisasi['categories']);
		$data['chart_title'] = 'Grafik Realisasi Fisik dan Keuangan<br>Seluruh Perangkat Daerah Tahun '.$tahun;

		// data untuk grafik realisasi bulanan
		$data_realisasi_bulanan = $model->getRealisasiSkpdBulanan($tahun_id,$skpd_id, $bulan);
		$data['series_bulanan'] = json_encode($data_realisasi_bulanan['series']);

		// echo $data['series'];
		// print_r($data_realisasi).'<br>';
		// print_r($data_realisasi_bulanan);
		// die();
		// data untuk
		$data['skpd'] = $model->getSkpd();
		$data['tahun'] = $model->getTahun();
		$data['tahun_id'] = $tahun_id;
		$data['skpd_id'] = $skpd_id;

		// table
		$data['table_realisasi'] = $data_realisasi['table'];
		$data['table_realisasi_bulanan'] = $data_realisasi_bulanan['table'];

		return View::make('public.indexHome',$data);
	}

	public function newGrafik() {
		$tahun = date('Y'); // seharusnya
		// $tahun = 2014;
		$skpd_id = 1;

		$model = new DataGrafik;
		$tahun_id = $model->getIdTahunTerakhir($tahun);
		// get realisasi fisik & keuangan
		// get rencana realisasi fisik & keuangan
		$data_realisasi = $model->getDataGrafikRealisasiSkpd($skpd_id, $tahun_id);

		// data untuk grafik realisasi
		$data['series'] = json_encode($data_realisasi['series']);
		$data['categories'] = json_encode($data_realisasi['categories']);
		$data['chart_title'] = 'Grafik Realisasi Fisik dan Keuangan<br>Seluruh Perangkat Daerah Tahun '.$tahun;

		// data untuk grafik realisasi bulanan
		$data_realisasi_bulanan = $this->getRealisasiSkpdBulanan($tahun_id,$skpd_id);
		$data['series_bulanan'] = json_encode($data_realisasi_bulanan['series']);

		// data untuk
		$data['skpd'] = $model->getSkpd();
		$data['tahun'] = $model->getTahun();
		$data['tahun_id'] = $tahun_id;
		$data['skpd_id'] = $skpd_id;

		// table
		$data['table_realisasi'] = $data_realisasi['table'];
		$data['table_realisasi_bulanan'] = $data_realisasi_bulanan['table'];

		return View::make('public.newGrafik', $data);
	}

	public function indexMockup() {
		return View::make('public.indexMockup');
	}

	public function kinerjaSkpd() 
	{
		$bulan = date('m');
		$tahun = date('Y'); // seharusnya
		$tahun_id = Tahun::where('tahun',$tahun)->first()->id;

		if(Input::has('tahun_id') && Input::has('bulan')) 
		{
			$tahun_id = Input::get('tahun_id');
			$bulan = Input::get('bulan');
			$tahun = Tahun::find($tahun_id)->tahun;
		}

		$Grup = DB::table('grup_realisasi')->where('bulan',$bulan)->where('tahun_id',$tahun_id)->get();
		$rencana = DB::table('rencana_realisasi')->where('bulan',$bulan)->where('tahun_id',$tahun_id)->first();
		
		$Skpd = DB::table('skpd')->where('id', '!=', 1)->get();

		$realisasi = new Realisasi;
		foreach($Skpd as $skpd)
		{
			$data_realisasi[] = $realisasi->realisasiSkpd($skpd->id,$tahun_id,$bulan); 
		}
		// print_r($data_realisasi);
		// die();
		if(count($data_realisasi) == 0)
		{
			$Deviasi = 0;
		}
		else
		{
			foreach($data_realisasi as $key => $value)
			{
				// $DeviasiDetail[$value['skpd']] = array('deviasi' => round($rencana->rencana_uang - $value['uang'], 2), 'realisasi' => $value['uang'], 'rencana' => $rencana->rencana_uang);
				$Deviasi[$value['skpd']] = round($rencana->rencana_uang - $value['uang'], 2);

			}
		}
		// print_r($DeviasiDetail);
		// die();

		$dataDeviasi[$Grup[0]->grup] = array();
		$dataDeviasi[$Grup[1]->grup] = array();
		$dataDeviasi[$Grup[2]->grup] = array();
		$dataDeviasi[$Grup[3]->grup] = array();

		if($Deviasi > 0) {
			foreach($Deviasi as $skpd => $deviasi)
			{
				// Grup A
				if($deviasi >= $Grup[0]->batas_bawah && $deviasi <= $Grup[0]->batas_atas)
				{
					$dataDeviasi[$Grup[0]->grup][] = (object) array('deviasi'=>$deviasi,'skpd'=>$skpd);
				}
				
				// Grup B
				if($deviasi >= $Grup[1]->batas_bawah && $deviasi < $Grup[1]->batas_atas)
				{
					$dataDeviasi[$Grup[1]->grup][] = (object) array('deviasi'=>$deviasi,'skpd'=>$skpd);
				}
				
				// Grup C
				if($deviasi >= $Grup[2]->batas_bawah && $deviasi < $Grup[2]->batas_atas)
				{
					$dataDeviasi[$Grup[2]->grup][] = (object) array('deviasi'=>$deviasi,'skpd'=>$skpd);
				}
				
				// Grup D
				if($deviasi < $Grup[3]->batas_atas)
				{
					$dataDeviasi[$Grup[3]->grup][] = (object) array('deviasi'=>$deviasi,'skpd'=>$skpd);
				}
			}
		}

		$dataDeviasi = array('A' => $dataDeviasi[$Grup[0]->grup], 
							 'B' => $dataDeviasi[$Grup[1]->grup],
							 'C' => $dataDeviasi[$Grup[2]->grup],
							 'D' => $dataDeviasi[$Grup[3]->grup]);
		
		
		// print_r($dataDeviasi);
		$listTahun = Tahun::latest()->get();
		return View::make('public.kinerjaSkpd')
							 ->with('Grup',$Grup)
							 ->with('DataDeviasi',$dataDeviasi)
							 ->with('tahun',$tahun)
							 ->with('tahun_id',$tahun_id)
							 ->with('bulan',$bulan)
							 ->with('listTahun',$listTahun);
		
	}

	public function kegiatanSkpd() {
		$tahun = date('Y');
		$tahun_id = Tahun::where('tahun',$tahun)->first()->id;
		$bulan = date('m');

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
			$tahun = Tahun::where('id',$tahun_id)->first()->tahun;
		}

		$Skpd = DB::table('skpd')->where('id', '!=', 1)->get();

		$realisasi = new Realisasi;
		foreach($Skpd as $skpd)
		{
			$data_realisasi = (object) $realisasi->realisasiSkpd($skpd->id,$tahun_id,$bulan);
			$data_kegiatan = DB::table('kegiatan')
								->select(DB::raw("SUM(pagu) AS pagu,
												  COUNT(kegiatan) AS kegiatan"))
								->where('skpd_id', '=', $skpd->id)
								->where('tahun_id', '=', $tahun_id)
								->first();
			$data_paket = DB::table('daftar_paket')
								->select(DB::raw("COUNT(paket) AS paket,
												  COUNT(case when hasil_kegiatan = 'konstruksi' then 1 else null end) AS konstruksi,
												  COUNT(case when hasil_kegiatan = 'non-konstruksi' then 1 else null end) AS nonkonstruksi"))
								->where('skpd_id', '=', $skpd->id)
								->where('tahun_id', '=', $tahun_id)
								->first();

			$kegiatanSkpd[] = (object) array('id' => $skpd->id,
									'skpd' => $skpd->skpd,
									'kode_skpd' => $skpd->kode_skpd,
									'pagu' => $data_kegiatan->pagu,
									'kegiatan' => $data_kegiatan->kegiatan,
									'paket' => $data_paket->paket,
									'konstruksi' => $data_paket->konstruksi,
									'nonkonstruksi' => $data_paket->nonkonstruksi,
									'pengeluaran' => $data_realisasi->pengeluaran,
									'realisasi_uang' => $data_realisasi->uang);
		}

		$listTahun = Tahun::latest()->get();
		return View::make('public.kegiatanSkpd')
						->with('Kegiatan',$kegiatanSkpd)
						->with('listTahun',$listTahun)
						->with('tahun_id',$tahun_id)
						->with('tahun',$tahun);

	}

	public function detailKegiatanSkpd($kode_skpd,$tahun) {
		$skpd_id = Skpd::where('kode_skpd',$kode_skpd)->first()->id;
		$tahun_id = Tahun::where('tahun',$tahun)->first()->id;
		$bulan = date('m');

		$Program = DB::table('program')->select('id','program')
									   ->where('tahun_id', $tahun_id)
									   ->where('skpd_id',$skpd_id)->get();
		
		foreach($Program as $program)
		{
			$Kegiatan[$program->program] = DB::table('kegiatan')
											->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
											->select('kegiatan','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran')
											->where('kegiatan.skpd_id', '=', $skpd_id)
											->where('kegiatan.tahun_id', '=', $tahun_id)
											->where('kegiatan.program_id', '=', $program->id)
											->where('realisasi_kegiatan.bulan',$bulan)
											->get();
		}

		$data['skpd_id'] = $skpd_id;
		$data['tahun_id'] = $tahun_id;
		$data['bulan'] = $bulan;
		$data['Program'] = $Program;
		$data['Kegiatan'] = $Kegiatan;
		$data['tahun'] = $tahun;
		return View::make('public.detailKegiatanSkpd', $data);
	}

	public function kegiatanLokasi() {
		$tahun = date('Y');
		$tahun_id = Tahun::where('tahun',$tahun)->first()->id;
		$listTahun = Tahun::latest()->get();

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
			$tahun = Tahun::where('id',$tahun_id)->first()->tahun;
		}

		$kegiatanLokasi = DB::select(
							"SELECT lokasi.id,
											lokasi.lokasi,
											IFNULL(paket.pagu_paket, 0) AS pagupaket,
											IFNULL(paket.hasil_kegiatan, 0) AS hasilkegiatan,
											IFNULL(paket.konstruksi, 0) AS konstruksi,
											IFNULL(paket.nonkonstruksi, 0) AS nonkonstruksi,
											IFNULL(progres.tandatangan, 0) AS progres,
											IFNULL(lelang.lelang, 0) AS lelang
							FROM lokasi
							LEFT JOIN (
								SELECT lokasi_id,
									SUM(nilai_pagu_paket) AS pagu_paket,
									COUNT(hasil_kegiatan) AS hasil_kegiatan,
									COUNT(case when hasil_kegiatan = 'konstruksi' then 1 else null end) AS konstruksi,
									COUNT(case when hasil_kegiatan = 'non-konstruksi' then 1 else null end) AS nonkonstruksi
								FROM daftar_paket
								WHERE tahun_id = '$tahun_id'
								GROUP BY lokasi_id
							) paket ON (lokasi.id = paket.lokasi_id)
							LEFT JOIN (
								SELECT lokasi_id,
									COUNT(case when status_kontrak = 'sdt' then 1 else null end) AS tandatangan
								FROM progres_lelang
								WHERE tahun_id = '$tahun_id'
								GROUP BY lokasi_id
							) progres ON (lokasi.id = progres.lokasi_id)
							LEFT JOIN (
								SELECT lokasi_id,
									COUNT(case when status = 'belum-siap-lelang' or status = 'lelang-ulang' then 1 else null end) AS lelang
								FROM paket_lelang
								WHERE tahun_id = '$tahun_id'
								GROUP BY lokasi_id
							) lelang ON (lokasi.id = lelang.lokasi_id)
						 	ORDER BY id ASC");

		return View::make('public.kegiatanLokasi')
						->with('tahun',$tahun)
						->with('listTahun',$listTahun)
						->with('tahun_id',$tahun_id)
						->with('Lokasi',$kegiatanLokasi);
	}

	public function getRealisasiSkpd(){
		$tahun_id = Input::get('tahun_id');
		$skpd_id = Input::get('skpd_id');

		$model = new DataGrafik;
		$data_realisasi = $model->getDataGrafikRealisasiSkpd($skpd_id, $tahun_id);

		$skpd = DB::table('skpd')->where('id', '=', $skpd_id)->first();
		$tahun = Tahun::find($tahun_id);

		// data untuk grafik realisasi
		$data['series'] = json_encode($data_realisasi['series']);
		$data['categories'] = json_encode($data_realisasi['categories']);
		$data['chart_title'] = 'Grafik Realisasi Fisik dan Keuangan<br> '.$skpd->skpd.' Tahun '.$tahun->tahun;

		$data_realisasi_bulanan = $this->getRealisasiSkpdBulanan($tahun_id, $skpd_id);
		$data['series_bulanan'] = json_encode($data_realisasi_bulanan['series']);

		return Response::json( $data );
	}

	public function getRealisasiSkpdBulanan($tahun_id, $skpd_id, $bulan = 1){
		$model = new DataGrafik;
		$data_realisasi_bulanan = $model->getRealisasiSkpdBulanan($tahun_id, $skpd_id, $bulan);

		return $data_realisasi_bulanan;
	}

}

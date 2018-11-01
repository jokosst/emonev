<?php

class UmumController extends BaseController {

	/**
	 * Tampilkan grafik realisasi fisik dan keuangan kabupaten sanggau
	 *
	 * @return Response
	 */
	public function showIndex(){
		$tahun = 2014;
		$skpd_id = 1;

		$model = new DataGrafik;
		$tahun_id = $model->getIdTahunTerakhir($tahun);
		// get realisasi fisik & keuangan
		// get rencana realisasi fisik & keuangan
		$data_realisasi = $model->getDataGrafikRealisasiSkpd($skpd_id, $tahun_id);

		// data untuk grafik realisasi
		$data['series'] = json_encode($data_realisasi['series']);
		$data['categories'] = json_encode($data_realisasi['categories']);
		$data['chart_title'] = 'Grafik Realisasi Fisik dan Keuangan<br>Seluruh SKPD Tahun '.$tahun;

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

		return View::make('umum.index', $data);
	}

	/**
	 * Ambil data json realisasi skpd pada tahun tertentu
	 *
	 * @return Response
	 */
	public function getRealisasiSkpd(){
		$tahun_id = Input::get('tahun_id');
		// $tahun_id = 4;
		$skpd_id = Input::get('skpd_id');
		// $skpd_id = 2;
		$bulan = date('m');

		$model = new DataGrafik;
		$data_realisasi = $model->getDataGrafikRealisasi($skpd_id, $tahun_id);

		$skpd = DB::table('skpd')->where('id', '=', $skpd_id)->first();
		$tahun = Tahun::find($tahun_id);

		// data untuk grafik realisasi
		$data['series'] = json_encode($data_realisasi['series']);
		$data['categories'] = json_encode($data_realisasi['categories']);
		$data['chart_title'] = 'Grafik Realisasi Fisik dan Keuangan<br> '.$skpd->skpd.' Tahun '.$tahun->tahun;

		$data_realisasi_bulanan = $model->getRealisasiSkpdBulanan($tahun_id,$skpd_id, $bulan);
		$data['series_bulanan'] = json_encode($data_realisasi_bulanan['series']);

		// table
		$data['table_realisasi'] = $data_realisasi['table'];
		$data['table_realisasi_bulanan'] = $data_realisasi_bulanan['table'];

		// print_r($data_realisasi_bulanan);
		return Response::json( $data );
	}


	public function showTestTable(){
		$skpd = DB::table('skpd')->get();
		$kegiatan_skpd = array();
		foreach($skpd as $key => $item_skpd){
			$kegiatan_skpd[$item_skpd->id] = DB::table('kegiatan')->where('skpd_id', '=', $item_skpd->id)->get();
		}

		$data['skpd'] = $skpd;
		$data['kegiatan_skpd'] = $kegiatan_skpd;

		// print_r($kegiatan_skpd);
		return View::make('umum.test-table', $data);
	}
}

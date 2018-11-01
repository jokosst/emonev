<?php

class DashboardController extends BaseController {

	protected $menu;

	public function __construct() {
		$this->menu = 'index';
		View::share(array('menu'=>$this->menu));
	}

	public function index(){
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$data['jmlProgram'] = Program::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->count();
		$data['jmlKegiatan'] = Kegiatan::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->count();
		return View::make('dashboard.index',$data);
	}

	public function getProgram($idSkpd,$idTahun) {
		$program = Program::where('skpd_id','=',$idSkpd)->where('tahun_id','=',$idTahun)->latest()->get();
		return Response::json($program);
	}

	public function getKpa($idSkpd) {
		$kpa = Pegawai::where('skpd_id','=',$idSkpd)->where('kpa','=',1)->latest()->get();
		return Response::json($kpa);
	}

	public function getKegiatan($idSkpd,$idTahun) {
		$kegiatan = Kegiatan::select('id','kegiatan')->where('skpd_id','=',$idSkpd)->where('tahun_id','=',$idTahun)->get();
		return Response::json($kegiatan);
	}

	public function getPaket($idKegiatan,$idTahun) {
		$paket = DB::table('daftar_paket')->where('kegiatan_id','=',$idKegiatan)->where('tahun_id','=',$idTahun)->get();
		return Response::json($paket);
	}

	public function getLelang($idSkpd,$idTahun) {
		$lelang = Lelang::where('skpd_id',$idSkpd)->where('tahun_id',$idTahun)->get();
		foreach($lelang as $key=>$value) {
			$lelang->nama_paket = $value->paket;
		}
		return Response::json($lelang);
	}

	public function hitungRealisasi() {
		$realisasi = new Realisasi;
		// $realisasi->updateRealisasiKab(2,12);
	}

	public function indexCopyRealisasi() {
		$id_skpd = Auth::user()->pegawai->skpd->id;
		$data['Tahun'] = Tahun::latest()->get();
		$data['Skpd'] = Skpd::getSkpd($id_skpd);
		return View::make('dashboard.indexCopyRealisasi',$data);
	}

	public function copyRealisasi() {
		$bulan = Input::get('bulan');
		$skpd_id = Input::get('skpd_id');
		$tahun_id = Input::get('tahun_id');

		$PaketOld = DB::table('realisasi_paket')->where('bulan',$bulan)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->get();
		foreach($PaketOld as $realisasi) {
			$paketNewCount = DB::table('realisasi_paket')->where('bulan',$bulan + 1)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('kegiatan_id',$realisasi->kegiatan_id)->where('paket_id',$realisasi->paket_id)->count();
			if($paketNewCount == 0) {
				DB::table('realisasi_paket')->insert(array('bulan'=>$bulan + 1, 'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'kegiatan_id'=>$realisasi->kegiatan_id,'paket_id'=>$realisasi->paket_id,'fisik'=>$realisasi->fisik,'uang'=>$realisasi->uang,'pengeluaran'=>$realisasi->pengeluaran));
			}
		}


		$KegiatanOld = DB::table('realisasi_kegiatan')->where('bulan',$bulan)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->get();
		foreach($KegiatanOld as $realisasi) {
			$kegiatanNewCount = DB::table('realisasi_kegiatan')->where('bulan',$bulan + 1)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('kegiatan_id',$realisasi->kegiatan_id)->count();
			if($kegiatanNewCount == 0) {
				DB::table('realisasi_kegiatan')->insert(array('bulan'=>$bulan + 1, 'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'kegiatan_id'=>$realisasi->kegiatan_id,'punya_paket'=>$realisasi->punya_paket,'fisik'=>$realisasi->fisik,'uang'=>$realisasi->uang,'pengeluaran'=>$realisasi->pengeluaran));
			}
		}

		$skpdOld = DB::table('realisasi_skpd')->where('bulan',$bulan)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->first();
		$skpdNewCount = DB::table('realisasi_skpd')->where('bulan',$bulan + 1)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->count();
		if($skpdNewCount == 0) {
			DB::table('realisasi_skpd')->insert(array('bulan'=>$bulan + 1, 'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'fisik'=>$skpdOld->fisik,'uang'=>$skpdOld->uang,'pengeluaran'=>$skpdOld->pengeluaran));
		}


		$kabOld = DB::table('realisasi_kabupaten')->where('bulan',$bulan)->where('tahun_id',$tahun_id)->first();
		$kabNewCount = DB::table('realisasi_kabupaten')->where('bulan',$bulan + 1)->where('tahun_id',$tahun_id)->count();
		if($kabNewCount == 0) {
			DB::table('realisasi_kabupaten')->insert(array('bulan'=>$bulan + 1, 'tahun_id'=>$tahun_id,'fisik'=>$kabOld->fisik,'uang'=>$kabOld->uang,'pengeluaran'=>$kabOld->pengeluaran));
		}

		return Redirect::back();
	}

	public function indexAnggaranPerubahan() {
		$data['Tahun'] = Tahun::latest()->get();
		return View::make('dashboard.indexAnggaranPerubahan',$data);
	}

	public function copyAnggaranPerubahan() {
		$tahun = Input::get('tahun_id');
		$paguAwal = Kegiatan::where('tahun_id',$tahun)->get();
		Tahun::where('id',$tahun)->update(array('anggaran_perubahan'=>1));
		foreach($paguAwal as $value)
		{
			DB::table('kegiatan')->where('tahun_id',$tahun)->update(array('pagu_perubahan'=>$value->pagu_awal));
		}
		return Redirect::to('emonevpanel');
	}

	public function indexTahunBaru() {
		return View::make('dashboard.indexTahunBaru');
	}

	public function insertTahunBaru() {
		$tahun = Tahun::latest()->first();
		$tahunBaru = (int)$tahun->tahun + 1;
		$tahun_id = Tahun::insertGetId(array('tahun'=>$tahunBaru,'anggaran_perubahan'=>0));
		$Skpd = Skpd::where('id','!=',1)->get();
		/* Insert Pagu Total SKPD dan Realisasi SKPD bulan 1 pada tahun baru */
		foreach($Skpd as $skpd) {
			DB::table('pagu_total_skpd')->insert(array('tahun_id'=>$tahun_id,'skpd_id'=>$skpd->id,'pagu_total'=>0));
			
		}
		/* Insert Pagu Total Kabupaten dan Realisasi Kabupaten bulan 1 pada tahun baru */
		DB::table('pagu_total_kabupaten')->insert(array('tahun_id'=>$tahun_id,'pagu_total'=>0));
		
		/* Insert Grup Realisasi pada tahun baru */
		$Grup = DB::table('grup_realisasi')->where('tahun_id',$tahun_id - 1)->get();
		foreach($Grup as $grup) {
			DB::table('grup_realisasi')->insert(array('tahun_id'=>$tahun_id,'bulan'=>$grup->bulan,'grup'=>$grup->grup,'batas_bawah'=>$grup->batas_bawah,'batas_atas'=>$grup->batas_atas));
		}
		/* Insert Rencana Realisasi pada tahun baru */
		$Rencana = DB::table('rencana_realisasi')->where('tahun_id',$tahun_id - 1)->get();
		foreach($Rencana as $rencana) {
			DB::table('rencana_realisasi')->insert(array('tahun_id'=>$tahun_id,'bulan'=>$rencana->bulan,'rencana_fisik'=>$rencana->rencana_fisik,'rencana_uang'=>$rencana->rencana_uang));
		}
        
      $Program = DB::table('program')->where('tahun_id', $tahun_id - 1)->get();
		foreach($Program as $program)
		{
			DB::table('program')->insert(array(
				'skpd_id' => $program->skpd_id,
				'tahun_id' => $tahun_id,
				'program' => $program->program,
				'slug_program' => $program->slug_program
			));
		}

		return Redirect::to('emonevpanel');
	}

	public function indexLokasi() {
		$data['Lokasi'] = Lokasi::all();
		return View::make('dashboard.lokasi.indexLokasi',$data);
	}

	public function insertLokasi() {
		$lokasi = Input::get('lokasi');
		$slug_lokasi = Convert::make_slug($lokasi);
		Lokasi::insert(array('lokasi'=>$lokasi,'slug_lokasi'=>$slug_lokasi));
		return Redirect::to('emonevpanel/lokasi');
	}

	public function updateLokasi() {
		$id = Input::get('id');
		$lokasi = Input::get('lokasi');
		$slug_lokasi = Convert::make_slug($lokasi);
		Lokasi::where('id',$id)->update(array('lokasi'=>$lokasi,'slug_lokasi'=>$slug_lokasi));
		return Redirect::to('emonevpanel/lokasi');
	}

	public function deleteLokasi() {
		$id = Input::get('id');
		Lokasi::where('id',$id)->delete();
		return Redirect::to('emonevpanel/lokasi');
	}

	public function indexSkpd() {
		$data['Skpd'] = Skpd::where('id','!=',1)->get();
		return View::make('dashboard.skpd.indexSkpd',$data);
	}

	public function insertSkpd(){
		$data = Input::all();
		Skpd::insert($data);
		return Redirect::to('emonevpanel/skpd');
	}

	public function updateSkpd() {
		$id = Input::get('id');
		$skpd = Input::get('skpd');
		$kode_skpd = Input::get('kode_skpd');

		Skpd::where('id',$id)->update(array('skpd'=>$skpd,'kode_skpd'=>$kode_skpd));
		return Redirect::to('emonevpanel/skpd');
	}

	public function deleteSkpd() {
		$id = Input::get('id');
		Skpd::where('id',$id)->delete();
		return Redirect::to('emonevpanel/skpd');
	}
}

?>
<?php

class PaketController extends BaseController {

	protected $menu;
	public function __construct() {
		$this->menu = 'paket';
		View::share(array('menu'=>$this->menu));
	}

	public function indexDaftarPaket() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$data['tahun_id'] = $tahun_id;
		$data['skpd_id'] = $skpd_id;
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['nameSkpd'] = Skpd::find($skpd_id);
		$data['nameTahun'] = Tahun::find($tahun_id);
		$data['Paket'] = DB::table('daftar_paket')->where('skpd_id','=',$skpd_id)->where('tahun_id','=',$tahun_id)->get();

		return View::make('dashboard.paket.indexDaftarPaket',$data);
	}
	public function indexPaketLelang() {
		$data['menu'] = 'lelang';

		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		if(Auth::user()->level == 'adminskpd') {
			$data['Lelang'] = Lelang::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->latest()->get();
		} else {
			$data['Lelang'] = Lelang::where('tahun_id',$tahun_id)->latest()->get();
		}
        //return Response::json($data);
		return View::make('dashboard.paket.indexPaketLelang',$data);
	}
	public function indexProgresPaket() {
		$data['menu'] = 'progres-paket';

		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		if(Auth::user()->level == 'adminskpd') {
			$data['Lelang'] = Lelang::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->latest()->get();
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();
		} else {
			$data['Lelang'] = Lelang::where('tahun_id',$tahun_id)->latest()->get();
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->get();
		}	


        //return Response::json($data);
		return View::make('dashboard.paket.indexProgrespaket',$data);
	}



	public function createDaftarPaket() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;


		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Pegawai'] = Pegawai::getKpa($skpd_id);
		$data['Kegiatan'] = Kegiatan::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['Lokasi'] = DB::table('lokasi')->get();

		return View::make('dashboard.paket.createDaftarPaket',$data);
	}

	public function insertDaftarPaket() {
		$data = Input::all();
		$data['nilai_pagu_paket'] = str_replace(['.','Rp'], '', Input::get('pagu_paket'));
		$paket_id = DB::table('daftar_paket')->insertGetId($data);

		DB::table('realisasi_kegiatan')->where('skpd_id',$data['skpd_id'])->where('tahun_id',$data['tahun_id'])->where('kegiatan_id',$data['kegiatan_id'])->update(array('punya_paket'=>1));
		DB::table('realisasi_paket')->insert(array('tahun_id'=>$data['tahun_id'],'skpd_id'=>$data['skpd_id'],'kegiatan_id'=>$data['kegiatan_id'],'paket_id'=>$paket_id,'bulan'=>1));
		return Redirect::to('emonevpanel/daftar-paket');
	}

	public function detailDaftarPaket($id) {
		$data['paket'] = Paket::where('id',$id)->first();
		return View::make('dashboard.paket.detailDaftarPaket',$data);
	}

	public function editDaftarPaket($id) {
		$paket = Paket::where('id',$id)->first();
		$data['Kpa'] = Pegawai::where('skpd_id',$paket->skpd_id)->where('kpa',1)->get();
		$data['Kegiatan'] = Kegiatan::where('tahun_id',$paket->tahun_id)->where('skpd_id',$paket->skpd_id)->get();
		$data['Lokasi'] = Lokasi::all();
		$data['paket'] = $paket;
		return View::make('dashboard.paket.editDaftarPaket',$data);
	}

	public function updateDaftarPaket() {
		$data = Input::all();
		$id = Input::get('id');
		$data['nilai_pagu_paket'] = str_replace(['.','Rp'], '', Input::get('pagu_paket'));
		DB::table('daftar_paket')->where('id',$id)->update($data);
		return Redirect::to('emonevpanel/daftar-paket');
	}

	public function hapusDaftarPaket($id) {
		DB::table('daftar_paket')->where('id',$id)->delete();
		return Redirect::back();
	}

	

	public function createPaketLelang() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Kegiatan'] = Kegiatan::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['menu'] = 'lelang';
		// $data['Kegiatan'] = Kegiatan::all();

		return View::make('dashboard.paket.createPaketLelang',$data);
	}

	public function insertPaketLelang() {
		$data = Input::all();
		$data['nilai_hps'] = str_replace(['Rp','.'], '', Input::get('hps'));
		DB::table('paket_lelang')->insert($data);
		return Redirect::to('emonevpanel/paket-lelang');
	}

	public function detailPaketLelang($id) {
		$data['lelang'] = Lelang::find($id);
		return View::make('dashboard.paket.detailPaketLelang',$data);
	}

	public function editPaketLelang($id) {
		$lelang = Lelang::find($id);
		$data['lelang'] = $lelang;
		$data['Paket'] = Paket::where('skpd_id',$lelang->skpd_id)->where('tahun_id',$lelang->tahun_id)->where('kegiatan_id',$lelang->kegiatan_id)->get();
		return View::make('dashboard.paket.editPaketLelang',$data);
	}

	public function updatePaketLelang() {
		$data = Input::all();
		$data['nilai_hps'] = str_replace(['Rp','.'], '', Input::get('hps'));
		$id = Input::get('id');
		DB::table('paket_lelang')->where('id',$id)->update($data);
		return Redirect::to('emonevpanel/paket-lelang');
	}

	public function hapusPaketLelang($id) {
		DB::table('paket_lelang')->where('id',$id)->delete();
		return Redirect::back();
	}

	public function indexProgresLelang() {
		$data['menu'] = 'progress';

		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$skpd_id = Auth::user()->pegawai->skpd->id;

		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		if(Auth::user()->level == 'adminskpd') {
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();
		} else {
			$data['Progres'] = Progres::where('tahun_id',$tahun_id)->get();
		}

		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;

		return View::make('dashboard.paket.indexProgresLelang',$data);
	}

	public function createProgresLelang() {
		$data['menu'] = 'progress';
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		$data['Lelang'] = Lelang::where('skpd_id', '=', $skpd_id)->where('tahun_id', '=', $tahun_id)->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		return View::make('dashboard.paket.createProgresLelang',$data);
	}

	public function insertProgresLelang() {
		$data = Input::all();
		$data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));

		DB::table('progres_lelang')->insert($data);
		return Redirect::to('emonevpanel/progres-lelang');
	}

	public function detailProgresLelang($id) {
		$data['progres'] = Progres::find($id);
		$data['menu'] = 'progress';
		return View::make('dashboard.paket.detailProgresLelang',$data);
	}

	public function editProgresLelang($id) {
		$data['progres'] = Progres::find($id);
		$data['menu'] = 'progress';
		return View::make('dashboard.paket.editProgresLelang',$data);
	}

	public function updateProgresLelang() {
		$data = Input::all();
		$data['tanggal_mulai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_mulai'));
		$data['tanggal_selesai'] = Convert::tgl_ind_to_eng(Input::get('tanggal_selesai'));
		$data['nilai_kontrak'] = str_replace(['Rp','.'], '', Input::get('nilai_kontrak'));
		$id = Input::get();
		Progress::where('id',$id)->update($data);
		return Redirect::to('emonevpanel/progres-lelang');
	}

	public function hapusProgressLelang($id) {
		Progress::where('id',$id)->where();
		return Redirect::back();
	}
}

?>
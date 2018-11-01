<?php

class KegiatanController extends BaseController {
	protected $menu;

	public function __construct() {
		$this->menu = 'kegiatan';
		View::share(array('menu'=>$this->menu));
	}

	public function indexKegiatan() {
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
		$data['Kegiatan'] = Kegiatan::where('skpd_id','=',$skpd_id)->where('tahun_id',$tahun_id)->get();

		return View::make('dashboard.kegiatan.indexKegiatan',$data);
	}

	public function createKegiatan() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun', date("Y"))->first()->id;
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Pegawai'] = Pegawai::getKpa($skpd_id);
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		$data['Program'] = Program::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();

		return View::make('dashboard.kegiatan.createKegiatan',$data);
	}

	public function insertKegiatan() {
		$data = Input::all();
		$data['pagu_awal'] = Input::get('pagu');
		$data['slug_kegiatan'] = Convert::make_slug(Input::get('kegiatan'));
		$data['blp'] = str_replace(['Rp','.'], '', Input::get('blp'));
		$data['blnp'] = str_replace(['Rp','.'], '', Input::get('blnp'));
		$data['btlp'] = str_replace(['Rp','.'], '', Input::get('btlp'));

		$kegiatan_id = Kegiatan::insertGetId($data);

		$skpd_id = Input::get('skpd_id');
		$tahun_id = Input::get('tahun_id');

		/* Ambil dan Update data pagu total skpd */
		$pagu_total_skpd = Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id);
		DB::table('pagu_total_skpd')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->update(array('pagu_total'=>$pagu_total_skpd));

		/* Ambil dan Update data pagu total kabupaten */
		$pagu_total_kabupaten = Kegiatan::hitungPaguKab($tahun_id);
		DB::table('pagu_total_kabupaten')->where('tahun_id',$tahun_id)->update(array('pagu_total'=>$pagu_total_kabupaten));

		/* Insert realiasi kegiatan setiap tambah kegiatan setiap bulan */
      $bulan_sekarang = Date('m');
        
      for($bulan = 1; $bulan <= $bulan_sekarang; $bulan++)
      {
      		DB::table('realisasi_kegiatan')->insert(array('skpd_id'=>$skpd_id,'kegiatan_id'=>$kegiatan_id,'tahun_id'=>$tahun_id,'punya_paket'=>0,'fisik'=>0,'uang'=>0,'pengeluaran'=>0,'bulan'=>$bulan));
      }
		
		return Redirect::to('emonevpanel/kegiatan');
	}

	public function detailKegiatan($id) {
		$data['kegiatan'] = Kegiatan::where('id',$id)->first();
		return View::make('dashboard.kegiatan.detailKegiatan',$data);
	}

	public function editKegiatan($id) {
		$kegiatan = Kegiatan::find($id);
		$data['kegiatan'] = $kegiatan;
		$data['Program'] = Program::where('skpd_id',$kegiatan->skpd_id)->where('tahun_id',$kegiatan->tahun_id)->get();
		$data['Pegawai'] = Pegawai::where('skpd_id',$data['kegiatan']->skpd_id)->where('kpa',1)->get();
		return View::make('dashboard.kegiatan.editKegiatan',$data);
	}

	public function updateKegiatan() {
		$id = Input::get('id');
		$data = Input::all();
		$data['slug_kegiatan'] = Convert::make_slug(Input::get('kegiatan'));
		$data['blp'] = str_replace(['Rp','.'], '', Input::get('blp'));
		$data['blnp'] = str_replace(['Rp','.'], '', Input::get('blnp'));
		$data['btlp'] = str_replace(['Rp','.'], '', Input::get('btlp'));
		$sumber_dana = Input::get('sumber_dana');
		$skpd_id = Input::get('skpd_id');
		$tahun_id = Input::get('tahun_id');
		if($sumber_dana == 'APBD-P' || $sumber_dana == 'APBN-P') {
			$data['pagu_perubahan'] = Input::get('pagu');
		} elseif($sumber_dana == 'APBD' || $sumber_dana == 'APBN') {
			$data['pagu_awal'] = Input::get('pagu');
		}
		Kegiatan::where('id',$id)->update($data);

		/* Ambil dan Update data pagu total skpd */
		$pagu_total_skpd = Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id);
		DB::table('pagu_total_skpd')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->update(array('pagu_total'=>$pagu_total_skpd));
		/* Ambil dan Update data pagu total kabupaten */
		$pagu_total_kabupaten = Kegiatan::hitungPaguKab($tahun_id);
		DB::table('pagu_total_kabupaten')->where('tahun_id',$tahun_id)->update(array('pagu_total'=>$pagu_total_kabupaten));

		return Redirect::to('emonevpanel/kegiatan');
	}

	public function hapusKegiatan($id) {
		$kegiatan = Kegiatan::where('id',$id)->first();
		$skpd_id = $kegiatan->skpd_id;
		$tahun_id = $kegiatan->tahun_id;

		/* Proses Menghapus Kegiatan */
		DB::table('kegiatan')->where('id',$id)->delete();

		/* Ambil dan Update data pagu total skpd */
		$pagu_total_skpd = Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id);
		DB::table('pagu_total_skpd')->where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->update(array('pagu_total'=>$pagu_total_skpd));
		/* Ambil dan Update data pagu total kabupaten */
		$pagu_total_kabupaten = Kegiatan::hitungPaguKab($tahun_id);
		DB::table('pagu_total_kabupaten')->where('tahun_id',$tahun_id)->update(array('pagu_total'=>$pagu_total_kabupaten));

		DB::table('realisasi_kegiatan')->where('kegiatan_id',$id)->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->delete();
		return Redirect::to('emonevpanel/kegiatan');
	}
}

 ?>
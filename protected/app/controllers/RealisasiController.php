<?php

class RealisasiController extends BaseController {

	protected $menu;

	public function __construct() {
		$this->menu = 'realisasi';
		View::share(array('menu'=>$this->menu));
	}

	public function indexRencanaRealisasi() {
		$data['menu'] = 'rencana';
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}

		$rencana = DB::table('rencana_realisasi')->where('tahun_id',$tahun_id)->get();

		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['tahun_id'] = $tahun_id;
		$data['Rencana'] = $rencana;

		return View::make('dashboard.realisasi.indexRencanaRealisasi',$data);
	}

	public function updateRencanaRealisasi() {
		$data = Input::all();
		$id = Input::get('id');
		DB::table('rencana_realisasi')->where('id',$id)->update($data);
		return Redirect::back();
	}

	 public function indexRealisasi() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$bulan = date('m') - 1;

		if(Input::has('skpd_id') && Input::has('tahun_id') && Input::has('bulan')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
			$bulan = Input::get('bulan');
		}

		$data['Tahun'] = Tahun::latest()->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Realisasi'] = Realisasi::where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->where('bulan',$bulan)->get();
		$data['skpd_id'] = $skpd_id;
		$data['tahun_id'] = $tahun_id;
		$data['bulan'] = $bulan;

		return View::make('dashboard.realisasi.indexRealisasi',$data);
	}

	public function updateRealisasi() {
		$skpd_id = Input::get('skpd_id');
		$kegiatan_id = Input::get('kegiatan_id');
		$tahun_id = Input::get('tahun_id');
		$bulan_input = Input::get('bulan');
		$bulan_sekarang = Date('m');
		$fisik = Input::get('fisik');
		$paket_id = Input::get('paket_id');
		// $punya_paket = Input::get('punya_paket');
		$paguKegiatan = Kegiatan::find($kegiatan_id)->pagu;
		$pengeluaran = str_replace(['Rp','.'], "", Input::get('pengeluaran'));

		$realisasi = new Realisasi();
        
        
        
		// Update Realiasi Kegiatan
		for($bulan = $bulan_input; $bulan <= $bulan_sekarang; $bulan++)
		{
            //echo $paguKegiatan;
            //echo $skpd_id.'-'.$kegiatan_id.'-'.$tahun_id.'-'.$bulan.'-'.$pengeluaran.'-'.$paguKegiatan.'-'.$fisik;
        //die();
			// if($punya_paket == 1) {
			// 	/* Simpan di Realiasi Paket */
			// 	$realisasi->updateRealisasiPaket($skpd_id,$kegiatan_id,$tahun_id,$paket_id,$bulan);
			// }
			$realisasi->updateRealisasiKegiatan($skpd_id,$kegiatan_id,$tahun_id,$bulan, $pengeluaran, $paguKegiatan, $fisik);
		}

		return Redirect::to('emonevpanel/realisasi');
		
	}

	public function detailRealisasi($id) {
		$data['realisasi'] = Realisasi::find($id);
		return View::make('dashboard.realisasi.detailRealisasi',$data);
	}

	public function editRealisasi($id) {
		$realisasi = Realisasi::find($id);
		$data['realisasi'] = $realisasi;
		$data['Paket'] = Paket::where('kegiatan_id',$realisasi->kegiatan_id)->get();
		return View::make('dashboard.realisasi.editRealisasi',$data);
	}

	public function indexGrupDeviasi() {
		$data['menu'] = 'grup-deviasi';
		$id_tahun = Tahun::where('tahun',date("Y"))->first()->id;
		if(Input::has('tahun_id')) {
			$id_tahun = Input::get('tahun_id');
		}
		// $data['Grup'] = DB::table('grup_realisasi')->where('tahun_id',$id_tahun)->orderBy('bulan','ASC')->orderBy('grup','ASC')->get();
		$data['tahun_id'] = $id_tahun;
		$data['Tahun'] = Tahun::latest()->get();

		for($i=1;$i<=12;$i++) {
			$grup[$i] = DB::table('grup_realisasi')->where('tahun_id',$id_tahun)->where('bulan',$i)->get();
		}
		$data['Grup'] = $grup;
		return View::make('dashboard.realisasi.indexGrupDeviasi',$data);
	}

	public function updateGrupDeviasi() {
		$data = Input::all();
		$id = Input::get('id');
		DB::table('grup_realisasi')->where('id',$id)->update($data);
		return Redirect::back();
	}

}

?>
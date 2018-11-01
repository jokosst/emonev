<?php

class SummaryController extends BaseController {

	protected $menu;

	public function __construct() {
		$this->menu = 'summary';
		View::share(array('menu'=>$this->menu));
	}

	public function indexSummary() {
		return View::make('dashboard.summary.indexSummary');
	}

	public function formatA1() {
		// $skpd_id = 22;
		// $tahun_id = 2;
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if($skpd_id == 1) {
			$data['summary'] = 0;
		}

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
			$data['summary'] = 1;
		}


		$data['Tahun'] = Tahun::latest()->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['skpd_id'] = $skpd_id;
		$data['tahun_id'] = $tahun_id;

		$summary = new Summary;
		$data['total_paket'] = $summary->hitung_total_paket($skpd_id,$tahun_id);
		$data['BTL'] = $summary->hitung_jenis_belanja($skpd_id,$tahun_id,'btl');
		$data['BL'] = $summary->hitung_jenis_belanja($skpd_id,$tahun_id,'bl');
		$data['BLP'] = $summary->hitung_jenis_belanja_langsung($skpd_id,$tahun_id,'kegiatan.blp');
		$data['Kpa'] = $summary->hitung_kpa_paket($skpd_id,$tahun_id);
		$data['BLNP'] = $summary->hitung_jenis_belanja_langsung($skpd_id,$tahun_id,'kegiatan.blnp');

		$data['kontraktual'] = $summary->hitung_kontraktual($skpd_id,$tahun_id);

		$data['kontraktual1'] = $summary->hitung_kontraktual1($skpd_id,$tahun_id);
		$data['dataKontraktual1'] = $summary->data_kontraktual1($skpd_id,$tahun_id);
		$data['kontraktual2'] = $summary->hitung_kontraktual2($skpd_id,$tahun_id);
		$data['dataKontraktual2'] = $summary->data_kontraktual2($skpd_id,$tahun_id);
		$data['kontraktual3'] = $summary->hitung_kontraktual3($skpd_id,$tahun_id);
		$data['dataKontraktual3'] = $summary->data_kontraktual3($skpd_id,$tahun_id);
		$data['kontraktual4'] = $summary->hitung_kontraktual4($skpd_id,$tahun_id);
		$data['dataKontraktual4'] = $summary->data_kontraktual4($skpd_id,$tahun_id);
		$data['kontraktual5'] = $summary->hitung_kontraktual5($skpd_id,$tahun_id);
		$data['dataKontraktual5'] = $summary->data_kontraktual5($skpd_id,$tahun_id);

		$data['swakelola'] = $summary->hitung_swakelola($skpd_id,$tahun_id);
		$data['swakelola_rutin'] = $summary->hitung_swakelola_rutin($skpd_id,$tahun_id);
		$data['dataSwakelola_rutin'] = $summary->data_swakelola_rutin($skpd_id,$tahun_id);
		$data['swakelola_program'] = $summary->hitung_swakelola_program($skpd_id,$tahun_id);
		$data['dataSwakelola_program'] = $summary->data_swakelola_program($skpd_id,$tahun_id);

		return View::make('dashboard.summary.formatA1',$data);

	}

	public function formatA2() {
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		if(Input::has('tahun_id')) {
			$tahun_id = Input::get('tahun_id');
		}
		// $tahun_id = Tahun::where('tahun',date('Y'))->first()->id;
		$data['Tahun'] = Tahun::latest()->get();
		$data['tahun_id'] = $tahun_id;
		$data['paguTotal'] = DB::table('kegiatan')->where('tahun_id',$tahun_id)->sum('pagu');
		$data['paguBl'] = DB::table('kegiatan')->where('jenis_belanja','bl')->where('tahun_id',$tahun_id)->sum('pagu');
		$data['paguBtl'] = DB::table('kegiatan')->where('jenis_belanja','btl')->where('tahun_id',$tahun_id)->sum('pagu');
		$data['paguBlp'] = DB::table('kegiatan')->where('jenis_belanja','bl')->where('tahun_id',$tahun_id)->sum('blp');
		$data['paguBlnp'] = DB::table('kegiatan')->where('jenis_belanja','bl')->where('tahun_id',$tahun_id)->sum('blnp');
		$data['barangjasa'] = DB::table('daftar_paket')->where('jenis_belanja_paket','barang-jasa')->where('tahun_id',$tahun_id)->sum('nilai_pagu_paket');
		$data['modal'] = DB::table('daftar_paket')->where('jenis_belanja_paket','modal')->where('tahun_id',$tahun_id)->sum('nilai_pagu_paket');
		return View::make('dashboard.summary.formatA2',$data);
	}

	public function formatA3() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$Skpd = Skpd::getSkpd($skpd_id);
		$Tahun = Tahun::latest()->get();

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$summary = new Summary3;
		$total_paket = $summary->hitung_total_paket_summary3($skpd_id,$tahun_id);
		$BTL = $summary->hitung_belanja_tidak_langsung($skpd_id,$tahun_id);
		$BTLP = $summary->hitung_belanja_tidak_langsung_pegawai($skpd_id,$tahun_id);
		$BL = $summary->hitung_belanja_langsung($skpd_id,$tahun_id);
		$BLP = $summary->hitung_jenis_belanja_langsung($skpd_id,$tahun_id,'kegiatan.blp');
		$BLNP = $summary->hitung_jenis_belanja_langsung($skpd_id,$tahun_id,'kegiatan.blnp');
		$Lokasi = $summary->hitung_total_lokasi($skpd_id,$tahun_id);

		// print_r($data['total_paket'][0]);
		return View::make('dashboard.summary.formatA3')
					->with(['total_paket'=>$total_paket[0],
							'BTL'=>$BTL[0],
							'BTLP'=>$BTLP[0],
							'BL'=>$BL[0],
							'BLP'=>$BLP[0],
							'BLNP'=>$BLNP[0],
							'Lokasi'=>$Lokasi,
							'Skpd'=>$Skpd,
							'Tahun'=>$Tahun,
							'tahun_id'=>$tahun_id,
							'skpd_id'=>$skpd_id]);
	}

	public function formatA4() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$Skpd = Skpd::getSkpd($skpd_id);
		$Tahun = Tahun::latest()->get();

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$summary = new SummaryAgain;
		$konstruksi = $summary->formatA4($skpd_id,$tahun_id,'konstruksi');
		$barang = $summary->formatA4($skpd_id,$tahun_id,'barang');
		$konsultan = $summary->formatA4($skpd_id,$tahun_id,'konsultan-supervisi');
		$lainnya = $summary->formatA4($skpd_id,$tahun_id,'lainnya');
		// die();
		return View::make('dashboard.summary.formatA4')
					->with(['konstruksi'=>$konstruksi,
							'barang'=>$barang,
							'konsultan'=>$konsultan,
							'lainnya'=>$lainnya,
							'Skpd'=>$Skpd,
							'Tahun'=>$Tahun,
							'tahun_id'=>$tahun_id,
							'skpd_id'=>$skpd_id]);
	}

	public function formatB() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$Skpd = Skpd::getSkpd($skpd_id);
		$Tahun = Tahun::latest()->get();

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$summary = new SummaryAgain;
		$konstruksi = $summary->formatB($skpd_id,$tahun_id,'konstruksi');
		$barang = $summary->formatB($skpd_id,$tahun_id,'barang');
		$konsultan = $summary->formatB($skpd_id,$tahun_id,'konsultan-supervisi');
		$lainnya = $summary->formatB($skpd_id,$tahun_id,'lainnya');

		return View::make('dashboard.summary.formatB')
					->with(['konstruksi'=>$konstruksi,
							'barang'=>$barang,
							'konsultan'=>$konsultan,
							'lainnya'=>$lainnya,
							'tahun_id'=>$tahun_id,
							'skpd_id'=>$skpd_id,
							'Tahun'=>$Tahun,
							'Skpd'=>$Skpd]);
	}

	public function formatD() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$Skpd = Skpd::getSkpd($skpd_id);
		$Tahun = Tahun::latest()->get();

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$summary = new SummaryAgain;
		$summary = $summary->formatD($skpd_id,$tahun_id);
		return View::make('dashboard.summary.formatD')
					->with(['tahun_id'=>$tahun_id,
							'skpd_id'=>$skpd_id,
							'Tahun'=>$Tahun,
							'Skpd'=>$Skpd,
							'summary'=>$summary]);
	}

	public function formatDK1() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;
		$Skpd = Skpd::getSkpd($skpd_id);
		$Tahun = Tahun::latest()->get();

		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$summary = new SummaryAgain;
		$summary = $summary->formatDK1($skpd_id,$tahun_id);
		return View::make('dashboard.summary.formatDK1')
					->with(['tahun_id'=>$tahun_id,
							'skpd_id'=>$skpd_id,
							'Tahun'=>$Tahun,
							'Skpd'=>$Skpd,
							'summary'=>$summary]);
	}

	public function formatRFK() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$bulan = date('m');
		$tahun_id = Tahun::where('tahun',date("Y"))->first()->id;

		if(Input::has('skpd_id') && Input::has('tahun_id') && Input::has('bulan_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
			$bulan = Input::get('bulan_id');
		}

		$Skpd = DB::table('skpd')->select('id','skpd')->where('id','!=',1)->get();
		
		$Program = DB::table('program')->select('id','program')
									   ->where('skpd_id', '=', $skpd_id)
									   ->where('tahun_id', '=', $tahun_id)->get();

		if($skpd_id != 1)
		{
			foreach($Program as $program)
			{
				$Kegiatan[$program->program] = DB::table('kegiatan')
												->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
												->select('kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
												->where('kegiatan.skpd_id', '=', $skpd_id)
												->where('kegiatan.tahun_id', '=', $tahun_id)
												->where('kegiatan.program_id', '=', $program->id)
												->where('realisasi_kegiatan.bulan',$bulan)
												->get();
                
                $kegiatanBtl = DB::table('kegiatan')
								->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
								->select('kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
								->where('kegiatan.skpd_id', '=', $skpd_id)
								->where('kegiatan.tahun_id', '=', $tahun_id)
								->where('kegiatan.program_id', '=', 0)
								->where('realisasi_kegiatan.bulan',$bulan)
								->get();
			}
		}
		else
		{
			$Kegiatan = array();
         $kegiatanBtl = array();
		}
		


		$data['Skpd'] = $Skpd;
		$data['skpdSortir'] = Skpd::getSkpd($skpd_id);
		$data['Program'] = $Program;
		$data['Kegiatan'] = $Kegiatan;
      $data['KegiatanBtl'] = $kegiatanBtl;
		$data['Tahun'] = Tahun::latest()->get();
		$data['skpd_id'] = $skpd_id;
		$data['tahun_id'] = $tahun_id;
		$data['bulan_id'] = $bulan;

		return View::make('dashboard.summary.formatRFK', $data);
	}

	public function downloadRFK()
	{
		$export = Input::get('export');
		$pegawai = Input::get('pegawai');
		$nip = Input::get('nip');
		$skpd_id = Input::get('skpd_id');
		$tahun_id = Input::get('tahun_id');
		$bulan = Input::get('bulan');
		$jabatan = Input::get('jabatan');
		$lokasi = Input::get('lokasi');
		$tanggal = Convert::tgl_ind_to_eng(Input::get('tanggal'));
		$tanggal = Convert::TanggalIndo($tanggal);

		if($export == 'pdf')
		{
			$skpd = Skpd::find($skpd_id);
			$tahun= Tahun::find($tahun_id);

			$Kegiatan = DB::table('kegiatan')
						->select('program','kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
						->leftJoin('program','kegiatan.program_id','=','program.id')
						->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
						->where('kegiatan.skpd_id',$skpd_id)
						->where('kegiatan.tahun_id',$tahun_id)
						->where('realisasi_kegiatan.bulan',$bulan)
						->orderBy('kode_anggaran', 'ASC')->get();

			$pdf = PDF::loadView('export.download-pdf-rfk', [
								'Kegiatan'=>$Kegiatan,
								'skpd'=>$skpd,
								'tahun'=>$tahun,
								'skpd_id'=>$skpd_id,
								'tahun_id'=>$tahun_id,
								'pegawai'=>$pegawai,
								'nip'=>$nip,
								'jabatan'=>$jabatan,
								'lokasi'=>$lokasi,
								'tanggal'=>$tanggal,
								'bulan'=>$bulan])
			  ->setPaper('f4')
			  ->setOrientation('landscape');


			return $pdf->stream('format-rfk.pdf');
			  // return View::make('export.download-pdf-rfk')->with(['Kegiatan'=>$Kegiatan,'skpd'=>$skpd,
					// 		'tahun'=>$tahun,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan'=>$bulan,'pegawai'=>$pegawai,'nip'=>$nip,'lokasi'=>$lokasi,'tanggal'=>$tanggal,'jabatan'=>$jabatan]);
		}
		else if ($export = 'excel')
		{
			Excel::create('FormatRFK', function($excel) {
				$excel->sheet('Halaman 1', function($sheet) {

					$skpd_id = Input::get('skpd_id');
					$tahun_id = Input::get('tahun_id');
					$bulan = Input::get('bulan');
					$skpd = Skpd::find($skpd_id);
					$tahun= Tahun::find($tahun_id);
					$pegawai = Input::get('pegawai');
					$nip = Input::get('nip');
					$jabatan = Input::get('jabatan');
					$lokasi = Input::get('lokasi');
					$tanggal = Convert::tgl_ind_to_eng(Input::get('tanggal'));
					$tanggal = Convert::TanggalIndo($tanggal);

					$Program = DB::table('program')->select('id','program')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->get();

					foreach($Program as $program) {
						$Kegiatan[$program->id] = DB::table('kegiatan')
												->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
												->where('kegiatan.skpd_id',$skpd_id)
												->where('kegiatan.tahun_id',$tahun_id)
												->where('kegiatan.program_id',$program->id)
												->where('realisasi_kegiatan.bulan',$bulan)->get();
					}
					$sheet->loadView('export.download-excel-rfk', [
							'Program'=>$Program,
							'Kegiatan'=>$Kegiatan,
							'skpd_id'=>$skpd_id,
							'tahun_id'=>$tahun_id,
							'bulan'=>$bulan,
							'skpd'=>$skpd,
							'pegawai'=>$pegawai,
							'nip'=>$nip,
							'jabatan'=>$jabatan,
							'lokasi'=>$lokasi,
							'tanggal'=>$tanggal,
							'tahun'=>$tahun]);
				});
			})->export('xls');
			 // return View::make('export.download-excel-rfk')
				// 	->with(['Program'=>$Program,'Kegiatan'=>$Kegiatan,'skpd'=>$skpd,
				// 			'tahun'=>$tahun,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan'=>$bulan,'pegawai'=>$pegawai,'nip'=>$nip]);
		}
	}


	/**
	 * Fungsi ini digunakan ketika masih pake routing untuk download per jenis tipe
	 * tapi udah ndak digunakan karena sekarang pakai langsung fungsi download yang di atas
	 */
	public function downloadPdfRfk()
	{
		$pegawai = 'M. Adi Akbar';
		$nip = '12345';
		$skpd_id = Input::get('skpd_id');
		$tahun_id = Input::get('tahun_id');
		$bulan = Input::get('bulan');
		$jabatan = Input::get('jabatan');
		$lokasi = Input::get('lokasi');
		$tanggal = Convert::tgl_ind_to_eng('19-03-2016');
		$tanggal = Convert::TanggalIndo($tanggal);

		$Kegiatan = DB::table('kegiatan')
						->select('program','kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
						->leftJoin('program','kegiatan.program_id','=','program.id')
						->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
						->where('kegiatan.skpd_id',$skpd_id)
						->where('kegiatan.tahun_id',$tahun_id)
						->where('realisasi_kegiatan.bulan',$bulan)->get();

		$pdf = PDF::loadView('export.download-pdf-rfk', [
								'Kegiatan'=>$Kegiatan,
								'skpd'=>$skpd,
								'tahun'=>$tahun,
								'skpd_id'=>$skpd_id,
								'tahun_id'=>$tahun_id,
								'pegawai'=>$pegawai,
								'nip'=>$nip,
								'jabatan'=>$jabatan,
								'lokasi'=>$lokasi,
								'tanggal'=>$tanggal,
								'bulan'=>$bulan])
			  ->setPaper('f4')
			  ->setOrientation('landscape');

			return $pdf->stream('format-rfk.pdf');

		/* return View::make('export.download-pdf-rfk')->with(['Kegiatan'=>$Kegiatan,'skpd'=>$skpd,
							'tahun'=>$tahun,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan'=>$bulan]); */
	}

	public function downloadExcelRfk()
	{
		Excel::create('FormatRFK', function($excel) {
			$excel->sheet('Halaman 1', function($sheet) {

				$skpd_id = Input::get('skpd_id');
				$tahun_id = Input::get('tahun_id');
				$bulan = Input::get('bulan_id');
				$skpd = Skpd::find($skpd_id);
				$tahun= Tahun::find($tahun_id);

				$Program = DB::table('program')->select('id','program')->where('skpd_id',$skpd_id)->where('tahun_id',$tahun_id)->get();
				foreach($Program as $program) {
					$Kegiatan[$program->id] = DB::table('kegiatan')
												->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
												->where('kegiatan.skpd_id',$skpd_id)
												->where('kegiatan.tahun_id',$tahun_id)
												->where('kegiatan.program_id',$program->id)
												->where('realisasi_kegiatan.bulan',$bulan)->get();
				}
				$sheet->loadView('export.download-excel-rfk', [
						'Program'=>$Program,
						'Kegiatan'=>$Kegiatan,
						'skpd_id'=>$skpd_id,
						'tahun_id'=>$tahun_id,
						'bulan'=>$bulan,
						'skpd'=>$skpd,
						'tahun'=>$tahun]);
			});
		})->export('xls');

		/* return View::make('export.download-excel-rfk')
					->with(['Program'=>$Program,'Kegiatan'=>$Kegiatan,'skpd'=>$skpd,
							'tahun'=>$tahun,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan'=>$bulan]); */
	}

	// =============== Ini yang bagian masih export ke excel tanpa rowspan ================
	/* public function downloadExcelRfk()
	{
		Excel::create('FormatRFK', function($excel) {
			$excel->sheet('Halaman 1', function($sheet) {

				$skpd_id = Input::get('skpd_id');
				$tahun_id = Input::get('tahun_id');
				$bulan = Input::get('bulan_id');

				$Kegiatan = DB::table('kegiatan')
						->select('program','kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
						->leftJoin('program','kegiatan.program_id','=','program.id')
						->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
						->where('kegiatan.skpd_id',$skpd_id)
						->where('kegiatan.tahun_id',$tahun_id)
						->where('realisasi_kegiatan.bulan',$bulan)->get();

				$sheet->loadView('export.download-rfk', ['Kegiatan'=>$Kegiatan,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan'=>$bulan]);
			});

		})->export('xls');
	} */
}

?>
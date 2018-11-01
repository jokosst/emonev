<?php

class TestingController extends BaseController
{
	/* Fungsi untuk melakukan testing export dengan excel menggunakan rowspan */
	public function testExportExcel()
	{
		Excel::create('FormatRFK', function($excel) {
			$excel->sheet('Halaman 1', function($sheet) {
				$skpd_id = 3;
				$tahun_id = 2;
				$bulan = 2;

				$Program = DB::table('program')->select('id','program')->where('skpd_id',$skpd_id)->get();
				foreach($Program as $program)
				{
					$Kegiatan[$program->id] = DB::table('kegiatan')->select('kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
												->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
												->where('kegiatan.skpd_id',$skpd_id)
												->where('kegiatan.tahun_id',$tahun_id)
												->where('kegiatan.program_id',$program->id)
												->where('realisasi_kegiatan.bulan',$bulan)->get();
				}
				$sheet->loadView('export.test-export-excel', ['Program'=>$Program,'Kegiatan'=>$Kegiatan,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan_id'=>$bulan]);
			});
		})->export('xls')->setWrapText(true);
		// return View::make('export.test-export-excel',['Program'=>$Program,'Kegiatan'=>$Kegiatan]);
	}

	/* Fungsi untuk melakukan testing export dengan pdf menggunakan rowspan
		tetapi gagal pada halaman 2 dst*/
	public function testExportPdf()
	{
		Excel::create('FormatRFK', function($excel) {
			$excel->sheet('Halaman 1', function($sheet) {
				$skpd_id = 3;
				$tahun_id = 2;
				$bulan = 2;

				$Program = DB::table('program')->select('id','program')->where('skpd_id',$skpd_id)->get();
				foreach($Program as $program)
				{
					$Kegiatan[$program->id] = DB::table('kegiatan')->select('kegiatan','kode_anggaran','jenis_belanja','pagu_awal','pagu_perubahan','fisik','uang','pengeluaran','pagu')
												->leftJoin('realisasi_kegiatan','kegiatan.id','=','realisasi_kegiatan.kegiatan_id')
												->where('kegiatan.skpd_id',$skpd_id)
												->where('kegiatan.tahun_id',$tahun_id)
												->where('kegiatan.program_id',$program->id)
												->where('realisasi_kegiatan.bulan',$bulan)->get();
				}
				$sheet->loadView('export.test-export-excel', ['Program'=>$Program,'Kegiatan'=>$Kegiatan,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan_id'=>$bulan]);
			});
		})->export('pdf');
		// return View::make('export.test-export-pdf', ['Program'=>$Program,'Kegiatan'=>$Kegiatan,'skpd_id'=>$skpd_id,'tahun_id'=>$tahun_id,'bulan_id'=>$bulan]);
	}

}
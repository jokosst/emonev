<?php 

class CekController extends BaseController {

	/**
	 * Tugas Fungsi ini adalah memasukkan nilai 
	 */
	public function insertRealisasiAwal($id_skpd)
	{
		$id_tahun = 4;			// 2016
		$bulan = date('m');		// 04
		for($i = 1; $i <= $bulan; $i++)
		{
			/**
			  * Insert Realisasi Kegiatan
			  * Memang tidak ada realisasi, sampe si operator menambahkan kegiatan.
			  */ 
			$Kegiatan = DB::table('kegiatan')
								->select('id')
								->where('tahun_id', '=', $id_tahun)
								->where('skpd_id', '=', $id_skpd)
								->get();

			foreach($Kegiatan as $kegiatan)
			{
				DB::table('realisasi_kegiatan')
					->insert(array(
						'skpd_id' => $id_skpd,
						'kegiatan_id' => $kegiatan->id,
						'tahun_id' => $id_tahun,
						'bulan' => $i
					));
			}
		}
	}

	public function realisasiSkpd($id_skpd)
	{
		$realisasi = New Realisasi;
		$bulan_sekarang = date('m');
		$id_tahun = 4;

		for($bulan = 1; $bulan <= $bulan_sekarang; $bulan++)
		{
			$data[] = $realisasi->realisasiSkpd($id_skpd,$id_tahun,$bulan); 
		}
		print_r($data);
	}

	public function realisasiKab()
	{
		$realisasi = New Realisasi;
		$bulan_sekarang = date('m');
		$id_tahun = 3;

		for($bulan = 1; $bulan <= $bulan_sekarang; $bulan++)
		{
			$data[] = $realisasi->realisasiKab($id_tahun,$bulan); 
		}
		print_r($data);
	}

	public function insertRencanaRealisasi($tahun_id)
	{
		$rencana = [['tahun_id' => $tahun_id,'bulan' => 1, 'rencana_fisik' => 1, 'rencana_uang' => 0],
					['tahun_id' => $tahun_id,'bulan' => 2, 'rencana_fisik' => 4, 'rencana_uang' => 5],
					['tahun_id' => $tahun_id,'bulan' => 3, 'rencana_fisik' => 13, 'rencana_uang' => 12],
					['tahun_id' => $tahun_id,'bulan' => 4, 'rencana_fisik' => 23, 'rencana_uang' => 19],
					['tahun_id' => $tahun_id,'bulan' => 5, 'rencana_fisik' => 30, 'rencana_uang' => 24],
					['tahun_id' => $tahun_id,'bulan' => 6, 'rencana_fisik' => 41, 'rencana_uang' => 33],
					['tahun_id' => $tahun_id,'bulan' => 7, 'rencana_fisik' => 50, 'rencana_uang' => 45],
					['tahun_id' => $tahun_id,'bulan' => 8, 'rencana_fisik' => 63, 'rencana_uang' => 56],
					['tahun_id' => $tahun_id,'bulan' => 9, 'rencana_fisik' => 71, 'rencana_uang' => 67],
					['tahun_id' => $tahun_id,'bulan' => 10, 'rencana_fisik' => 80, 'rencana_uang' => 78],
					['tahun_id' => $tahun_id,'bulan' => 11, 'rencana_fisik' => 90, 'rencana_uang' => 89],
					['tahun_id' => $tahun_id,'bulan' => 12, 'rencana_fisik' => 100, 'rencana_uang' => 91]];

		DB::table('rencana_realisasi')->insert($rencana);
		echo "sukses";
	}

	public function copyRealisasiSkpd($skpd_id, $bulan)
	{
		$tahun_id = 4;
		$bulan_selanjutnya = $bulan + 1;

		$jumlah_realisasi_bulan = DB::table('realisasi_kegiatan')
								->where('tahun_id', '=', $tahun_id)
								->where('skpd_id', '=', $skpd_id)
								->where('bulan', '=', $bulan)
								->count();

		$realisasi_bulan = DB::table('realisasi_kegiatan')
						->where('tahun_id', '=', $tahun_id)
						->where('skpd_id', '=', $skpd_id)
						->where('bulan', '=', $bulan_selanjutnya)
						->get();

		$jumlah_realisasi_bulan_selanjutnya = DB::table('realisasi_kegiatan')
											->where('tahun_id', '=', $tahun_id)
											->where('skpd_id', '=', $skpd_id)
											->where('bulan', '=', $bulan_selanjutnya)
											->count();


		// print_r($realisasi_bulan);
		// die();
		if($jumlah_realisasi_bulan_selanjutnya > 0)
		{
			if($jumlah_realisasi_bulan != $jumlah_realisasi_bulan_selanjutnya)
			{
				echo "tidak sama <br>";
				echo $jumlah_realisasi_bulan.'<br>';
				echo $jumlah_realisasi_bulan_selanjutnya.'<br>';
				die();
			}

			$realisasi_bulan_selanjutnya = DB::table('realisasi_kegiatan')
											->where('tahun_id', '=', $tahun_id)
											->where('skpd_id', '=', $skpd_id)
											->where('bulan', '=', $bulan_selanjutnya)
											->get();

			for($i=0; $i<$jumlah_realisasi_bulan_selanjutnya; $i++)
			{
				if($realisasi_bulan_selanjutnya[$i]->pengeluaran > $realisasi_bulan[$i]->pengeluaran)
				{
					echo "bulan selanjutnya sudah ada realisasi - ";
				}
				else
				{
					echo "nah yang ini yang di copy - id ".$realisasi_bulan_selanjutnya[$i]->id;

					DB::table('realisasi_kegiatan')->where('id', '=', $realisasi_bulan_selanjutnya[$i]->id)
													->update(array(
														'fisik' => $realisasi_bulan[$i]->fisik,
														'uang' => $realisasi_bulan[$i]->uang,
														'pengeluaran' => $realisasi_bulan[$i]->pengeluaran
													));
				}

				echo ' pengeluaran bulan '.$bulan.' = '.$realisasi_bulan[$i]->pengeluaran.' pengeluaran bulan '.$bulan_selanjutnya.' = '.$realisasi_bulan_selanjutnya[$i]->pengeluaran.'<br>'; 
			}
		}
		else if($jumlah_realisasi_bulan_selanjutnya == 0)
		{
			foreach($realisasi_bulan as $key => $value)
			{
				DB::table('realisasi_kegiatan')
					->insert(array(
						'skpd_id' => $skpd_id,
						'kegiatan_id' => $value->kegiatan_id,
						'tahun_id' => $tahun_id,
						'bulan' => $bulan_selanjutnya,
						'punya_paket' => $value->punya_paket,
						'fisik' => $value->fisik,
						'uang' => $value->uang,
						'pengeluaran' => $value->pengeluaran
					));
			}
			echo "sukses";
		}

		// return ;
		// print_r($realisasi_bulan);
	}

	public function copyRealisasiKeselurahan()
	{
		$tahun_id = 6;
		$bulan = 12;
		$bulan_sebelumnya = $bulan - 1;


		$jumlah_realisasi_bulan = DB::table('realisasi_kegiatan')
										->where('tahun_id', '=', $tahun_id)
										->where('bulan', '=', $bulan)
										->count();

		if($jumlah_realisasi_bulan == 0)
		{
			$realisasi_bulan_sebelumnya = DB::table('realisasi_kegiatan')
										->where('tahun_id', '=', $tahun_id)
										->where('bulan', '=', $bulan_sebelumnya)
										->get();

			
			foreach ($realisasi_bulan_sebelumnya as $key => $value) 
			{
				DB::table('realisasi_kegiatan')
					->insert(array(
						'tahun_id' => $tahun_id,
						'skpd_id' => $value->skpd_id,
						'kegiatan_id' => $value->kegiatan_id,
						'bulan' => $bulan,
						'punya_paket' => $value->punya_paket,
						'fisik' => $value->fisik,
						'uang' => $value->uang,
						'pengeluaran' => $value->pengeluaran
					));
			}
			echo "selesai";
		}
		else
		{
			echo "sudah ada realiasasi";
		}
	}

	public function deleteRealisasi()
	{
		$tahun_id = 6;
		$bulan = 12;

		DB::table('realisasi_kegiatan')
			->where('tahun_id', '=', $tahun_id)
			->where('bulan', '=', $bulan)
			->delete();

		echo "sukses";
	}

	public function paguPengeluaran()
	{
		$skpd_id = 2;
		$tahun_id = 4;
		$bulan = 3;

		echo $pagu = Kegiatan::hitungPaguSkpd($skpd_id,$tahun_id).'<br>';

		echo $pengeluaran = DB::table('realisasi_kegiatan')
						->where('skpd_id', '=', $skpd_id)
						->where('tahun_id', '=', $tahun_id)
						->where('bulan', '=', $bulan)
						->sum('pengeluaran');
	}
}

?>
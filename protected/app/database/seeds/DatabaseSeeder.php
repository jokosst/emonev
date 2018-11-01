<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('MonevAppSeeder');
	}

}

class MonevAppSeeder extends Seeder {

	public function run() {

		DB::table('skpd')->delete();

		// NAMA - NAMA SKPD
		$other = Skpd::create(array(
      'skpd'     	=> 'Lain-lain',
      'kode_skpd' => 'other',
    ));

    // ini login aku sebagai root yang berada di luar skpd
    $pegawaiAdi = Pegawai::create(array(
    	'skpd_id'		=> $other->id,
    	'pegawai'		=> 'M. Adi Akbar',
    	'email'			=> 'me@adyakbar.com',
    	'telepon'		=> '089693291753'
    ));

    $operatorAdi = User::create(array(
    	'pegawai_id'	=> $pegawaiAdi->id,
    	'username'		=> 'adyakbar',
    	'password'		=> Hash::make('gantengkeren'),
    	'level'				=> 'root'
    ));

    // ini login aku sebagai superadmin yang berada di SKPD Sekretariat Daerah
		$skd = Skpd::create(array(
      'skpd'     	=> 'Sekretariat Daerah',
      'kode_skpd' => 'SKD',
    ));

    $pegawaiSKD = Pegawai::create(array(
    	'skpd_id'		=> $skd->id,
    	'pegawai'		=> 'Pegawai SKD',
    ));

    $operatorSKD = User::create(array(
    	'pegawai_id'	=> $pegawaiSKD->id,
    	'username'		=> 'superadmin',
    	'password'		=> Hash::make('gantengkeren'),
    	'level'				=> 'superadmin'
    ));


    // ini login aku sebagai adminskpd yang berada di SKPD Sekretariat DPRD
    $dprd = Skpd::create(array(
      'skpd'     	=> 'Sekretariat DPRD',
      'kode_skpd' => 'DPRD',
    ));

    $pegawaiDPRD = Pegawai::create(array(
    	'skpd_id'		=> $dprd->id,
    	'pegawai'		=> 'Pegawai DPRD',
    ));

    $operatorDPRD = User::create(array(
    	'pegawai_id'	=> $pegawaiDPRD->id,
    	'username'		=> 'admindprd',
    	'password'		=> Hash::make('gantengkeren'),
    	'level'				=> 'adminskpd'
    ));


    // ini login aku sebagai adminskpd yang berada di SKPD Inspektorat Kabupaten
    $insp = Skpd::create(array(
      'skpd'     	=> 'Inspektorat Kabupaten',
      'kode_skpd' => 'INSP',
    ));

    $pegawaiINSP = Pegawai::create(array(
    	'skpd_id'		=> $insp->id,
    	'pegawai'		=> 'Pegawai INSP',
    ));

    $operatorINSP = User::create(array(
    	'pegawai_id'	=> $pegawaiINSP->id,
    	'username'		=> 'admininsp',
    	'password'		=> Hash::make('gantengkeren'),
    	'level'				=> 'adminskpd'
    ));


    // ndak aku buat loginnya nanti kita buat pake form
    $dpki = Skpd::create(array(
      'skpd'     	=> 'Dinas Perhubungan, Komunikasi dan Informatika',
      'kode_skpd' => 'DPKI',
    ));

    $dpu = Skpd::create(array(
      'skpd'     	=> 'Dinas Pekerjaan Umum',
      'kode_skpd' => 'DPU',
    ));

    $dk = Skpd::create(array(
      'skpd'     	=> 'Dinas Kesehatan',
      'kode_skpd' => 'DK',
    ));

    $dppk = Skpd::create(array(
      'skpd'     	=> 'Dinas Perindustrian, Perdagangan, Koperasi dan UKM',
      'kode_skpd' => 'DPPK',
    ));

    $dkps = Skpd::create(array(
      'skpd'     	=> 'Dinas Kependudukan dan Pencatatan Sipil',
      'kode_skpd' => 'DKPS',
    ));

    $dkp = Skpd::create(array(
      'skpd'     	=> 'Dinas Kebudayaan dan Pariwisata',
      'kode_skpd' => 'DKP',
    ));

    $dkp1 = Skpd::create(array(
      'skpd'     	=> 'Dinas Kehutanan dan Perkebunan',
      'kode_skpd' => 'DKP1',
    ));

    $dpad = Skpd::create(array(
      'skpd'     	=> 'Dinas Pendapatan, Pengelolaan Keuangan dan Aset Daerah',
      'kode_skpd' => 'DPAD',
    ));

    $dppp = Skpd::create(array(
      'skpd'     	=> 'Dinas Pertanian, Perikanan dan Peternakan',
      'kode_skpd' => 'DPPP',
    ));

    $desd = Skpd::create(array(
      'skpd'     	=> 'Dinas Energi dan Sumber Daya Mineral',
      'kode_skpd' => 'DESD',
    ));

    $dppo = Skpd::create(array(
      'skpd'     	=> 'Dinas Pendidikan, Pemuda dan Olahraga',
      'kode_skpd' => 'DPPO',
    ));

    $dstk = Skpd::create(array(
      'skpd'     	=> 'Dinas Sosial, Tenaga Kerja dan Transmigrasi',
      'kode_skpd' => 'DSTK',
    ));

    $blh = Skpd::create(array(
      'skpd'     	=> 'Badan Lingkungan Hidup, Kebersihan, dan Pemadam Kebakaran',
      'kode_skpd' => 'BLH',
    ));

    $bppd = Skpd::create(array(
      'skpd'     	=> 'Badan Perencanaan Pembangunan Daerah',
      'kode_skpd' => 'BPPD',
    ));

    $bppp = Skpd::create(array(
      'skpd'     	=> 'Badan Pemberdayaan Perempuan, Keluarga Berencana dan Perlindungan Anak',
      'kode_skpd' => 'BPPP',
    ));

    $bkd = Skpd::create(array(
      'skpd'     	=> 'Badan Kepegawaian Daerah',
      'kode_skpd' => 'BKD',
    ));

    $bpm = Skpd::create(array(
      'skpd'     	=> 'Badan Pemberdayaan Masyarakat dan Pemerintahan Desa',
      'kode_skpd' => 'BPM',
    ));

    $bpbd = Skpd::create(array(
      'skpd'     	=> 'Badan Penanggulangan Bencana Daerah',
      'kode_skpd' => 'BPBD',
    ));

    $bpp = Skpd::create(array(
      'skpd'     	=> 'Badan Pengelola Perbatasan',
      'kode_skpd' => 'BPP',
    ));

    $bpk = Skpd::create(array(
      'skpd'     	=> 'Badan Pengelola Perbatasan',
      'kode_skpd' => 'BPK',
    ));

    $rsud = Skpd::create(array(
      'skpd'     	=> 'Rumah Sakit Umum Daerah',
      'kode_skpd' => 'RSUD',
    ));

    $kpm = Skpd::create(array(
      'skpd'     	=> 'Kantor Penanaman Modal dan Pelayanan Perizinan',
      'kode_skpd' => 'KPM',
    ));

    $kkp = Skpd::create(array(
      'skpd'     	=> 'Kantor Ketahanan Pangan',
      'kode_skpd' => 'KKP',
    ));

    $kkpd = Skpd::create(array(
      'skpd'     	=> 'Kantor Kearsipan dan Perpustakaan Daerah',
      'kode_skpd' => 'KKPD',
    ));

    $kkb = Skpd::create(array(
      'skpd'     	=> 'Kantor Kesatuan Bangsa, Politik dan Perlindungan Masyarakat',
      'kode_skpd' => 'KKB',
    ));

    $sp3 = Skpd::create(array(
      'skpd'     	=> 'Satuan Polisi Pamong Praja',
      'kode_skpd' => 'SP3',
    ));

    $sdp = Skpd::create(array(
      'skpd'     	=> 'Sekretariat Dewan Pengurus KORPRI',
      'kode_skpd' => 'SDP',
    ));

    $adpm = Skpd::create(array(
      'skpd'     	=> 'Administrasi Pembangunan',
      'kode_skpd' => 'ADPM',
    ));
	}

}

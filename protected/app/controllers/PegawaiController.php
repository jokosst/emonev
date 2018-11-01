<?php

class PegawaiController extends BaseController {

	public function __construct() {
		$this->menu = 'pegawai';
		View::share(array('menu'=>$this->menu));
	}

	public function indexPegawai() {
		$id_skpd = Auth::user()->pegawai->skpd->id;

		if(Auth::user()->level == 'root') {
			$data['Kpa'] = Pegawai::where('kpa',1)->get();
			$data['Operator'] = Pegawai::where('kpa',0)->get();
		} else if(Auth::user()->level == 'superadmin'){
			$data['Kpa'] = Pegawai::where('skpd_id','!=','1')->where('kpa',1)->get();
			$data['Operator'] = Pegawai::where('skpd_id','!=','1')->where('kpa',0)->get();
		} else {
			$data['Kpa'] = Pegawai::where('skpd_id',$id_skpd)->where('kpa',1)->get();
			$data['Operator'] = Pegawai::where('skpd_id','=',$id_skpd)->where('kpa',0)->get();
		}
		return View::make('dashboard.indexPegawai',$data);
	}

	public function createPegawai() {
		$id_skpd = Auth::user()->pegawai->skpd->id;
		if(Auth::user()->level == 'root') {
			$data['Skpd'] = Skpd::all();
		} else if(Auth::user()->level == 'superadmin'){
			$data['Skpd'] = Skpd::where('id','!=',1)->get();
		} else {
			$data['Skpd'] = Skpd::where('id',$id_skpd)->first();
		}

		return View::make('dashboard.createPegawai',$data);
	}

	public function insertPegawai() {
		$data = Input::all();
		unset($data['username']);
		unset($data['password']);
		unset($data['level']);
		$pegawai_id = DB::table('pegawai')->insertGetId($data);
		if($data['kpa'] == 0) {
			DB::table('operator')->insert(array('pegawai_id'=>$pegawai_id,'username'=>Input::get('username'),'level'=>Input::get('level'),'password'=>Hash::make(Input::get('password'))));
		}
		return Redirect::back();
	}

	public function editPegawai($id) {
		$id_skpd = Auth::user()->pegawai->skpd->id;
		if(Auth::user()->level == 'root') {
			$data['Skpd'] = Skpd::all();
		} else if(Auth::user()->level == 'superadmin'){
			$data['Skpd'] = Skpd::where('id','!=',1)->get();
		} else {
			$data['Skpd'] = Skpd::where('id',$id_skpd)->get();
		}
		$data['pegawai'] = DB::table('pegawai')->where('id',$id)->first();
		return View::make('dashboard.editPegawai',$data);
	}

	public function updatePegawai() {
		$data = Input::all();
		DB::table('pegawai')->where('id',Input::get('id'))->update($data);
		return Redirect::back();
	}

	public function changePassword() {
		$id = Input::get('id_operator');
		$password = Input::get('password');
		DB::table('operator')->where('id',$id)->update(array('password'=>Hash::make($password)));
		return Redirect::back();
	}

	public function hapusPegawai($id) {
		DB::table('pegawai')->where('id',$id)->delete();
		return Redirect::back();
	}

	public function indexAkun() {
		$data['menu'] = 'akun';
		$data['akun'] = Auth::user();
		return View::make('dashboard.indexAkun',$data);
	}
}

?>
<?php

class ProgramController extends BaseController {

	protected $menu;

	public function __construct() {
		$this->menu = 'program';
		View::share(array('menu'=>$this->menu));
	}

	public function indexProgram() {
		$skpd_id = Auth::user()->pegawai->skpd->id;
		$tahun_id = Tahun::where('tahun',date('Y'))->first()->id;

		// jika masuk sebagai root || superadmin, maka harus pilih skpd dan tahun
		if(Input::has('skpd_id') && Input::has('tahun_id')) {
			$skpd_id = Input::get('skpd_id');
			$tahun_id = Input::get('tahun_id');
		}

		$data['tahun_id'] = $tahun_id;
		$data['skpd_id'] = $skpd_id;
		$data['Tahun'] = Tahun::orderBy('id', 'DESC')->get();
		$data['Skpd'] = Skpd::getSkpd($skpd_id);
		$data['Program'] = Program::where('tahun_id',$tahun_id)->where('skpd_id',$skpd_id)->get();

		return View::make('dashboard.program.indexProgram',$data);
	}

	public function insertProgram() {
		$data = Input::all();
		$data['program'] = ucwords(strtolower(Input::get('program')));
		$data['slug_program'] = Convert::make_slug(Input::get('program'));
		Program::insert($data);
		return Redirect::back();
	}

	public function updateProgram() {
		$program = ucwords(strtolower(Input::get('program')));
		$slug_program = Convert::make_slug(Input::get('program'));
		$id = Input::get('id');
		Program::where('id',$id)->update(array('program'=>$program,'slug_program'=>$slug_program));
		return Redirect::back();
	}

	public function deleteProgram() {
		$id = Input::get('id');
		Program::where('id',$id)->delete();
		return Redirect::back();
	}

}

?>
<?php 

class AuthController extends BaseController {

	public function showLogin(){
		return View::make('login');
	}

	public function doLogin(){
		$rules = array (
			'username' => 'required|min:2|max:30',
			'password' => 'required|alphaNum|min:5'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput();
		} else {
			$userdata = array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);
        	// $user = User::find(1);
        
        	// return $user;
        
			if (Auth::attempt($userdata)) {
           		// return "berhasil";
				return Redirect::to('emonevpanel/'); /* Login Success */
			} else {
            	return "gagal";
				// return Redirect::to('login');

			} /* END OF if Attempt */
		} /* END OF if validator */
	} /* END OF doLogin */

	public function doLogout() {
		Auth::logout();
		return Redirect::to('/');
	} /* END OF doLogout */

}

?>
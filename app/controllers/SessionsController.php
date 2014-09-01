<?php
use Illuminate\Support\MessageBag;

class SessionsController extends \BaseController {

	public function login() {
		$data = Input::only('username', 'password');

		$username = Input::get('username');
		$password = Input::get('password');

		$rules = [
			'username' 	=> 'required|min:3|max:18',
			'password' 	=> 'required|min:6|max:18'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			if(Auth::attempt(['username' => $username, 'password' => $password, 'active' => 1])) {
				User::whereUsername(Input::get('username'))->update(['last_login' => date('Y-m-d H:i:s')]);
				return Redirect::back();
			} else {
				$errors = new MessageBag;
		        $errors->add('login','Kullanıcı adı veya şifre hatalı ya da üyelik aktifleştirilmemiş.');
		        return Redirect::back()
		        ->withErrors($errors);
			} 
		} else {
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function logout() {
		Auth::logout();
		return Redirect::home();
	}
}
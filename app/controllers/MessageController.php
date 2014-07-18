<?php

class MessageController extends \BaseController {

	public function sendMessage() {
		$data = Input::all();

		$rules = [
			'fullname' 	=> 'required|min:3|max:30',
			'email' 	=> 'required|email',
			'subject'	=> 'required',
			'message' 	=> 'required|min:10|max:500'
		];

		$validator = Validator::make($data, $rules);

		if($validator->passes()) {
			$message = new Contact;
			$message->fullname 	= Input::get('fullname');
			$message->email 	= Input::get('email');
			$message->subject 	= Input::get('subject');
			$message->message 	= Input::get('message');
			$message->save();

			Session::flash('message', 'Mesajınız başarıyla gönderilmiştir!');
			return Redirect::route('home');
		} else {

		return Redirect::route('contact-us')
		->withErrors($validator)
		->withInput();
		}
	}
}
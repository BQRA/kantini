<?php
function guest_username() {
	if (isset($_COOKIE['guest'])) {
		$guest_username = $_COOKIE['guest'];
	} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = $a;
	}

	return $guest_username;
}

function imageNumber() {
	$image_number = User::find(Auth::user()->id);
	$number = Auth::user()->username.'-'.$image_number->profile->image_number;

	return $number;
}

function session_user_posts() {
	$user_posts = Post::select('username')->where('username', Auth::user()->username)->get();
	return $user_posts;
}

function session_user_comments() {
	$user_comments = Comment::where('commenter', Auth::user()->username)->get();
	return $user_comments;
}

function session_user_votes() {
	$user_votes = Vote::where('rater', Auth::user()->username)->get();
	return $user_votes;
}
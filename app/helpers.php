<?php
function guest_username() {
	if (isset($_COOKIE['guest'])) {
		$guest_username = 'misafir'.$_COOKIE['guest'];
	} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = 'misafir'.$a;
	}

	return $guest_username;
}

function eventImage() {
		$a = rand(1000, 100000);
		$eventImage = Auth::user()->username.'-'.$a;

	return $eventImage;
}

function session_user_posts() {
	$user_posts = Post::where('username', Auth::user()->username)->get();
	return $user_posts;
}

function session_user_comments() {
	$user_comments = Comment::where('commenter', Auth::user()->username)->get();
	return $user_comments;
}

function session_user_rates() {
	$user_ups = UP::where('rater', Auth::user()->username)->get();
	$user_downs = DOWN::where('rater', Auth::user()->username)->get();
	$user_ups_count = $user_ups->count();
	$user_downs_count = $user_downs->count();

	return $user_ups_count + $user_downs_count;
}
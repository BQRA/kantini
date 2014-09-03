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
		$number		 = rand(1000, 1000000000000);
		$eventImage  = Auth::user()->username.$number;

	return $eventImage;
}

function session_user_posts() {
	$user_posts = Post::select('username')->where('username', Auth::user()->username)->get();
	return $user_posts;
}

function session_user_comments() {
	$user_comments = Comment::where('commenter', Auth::user()->username)->get();
	return $user_comments;
}

function up($post_id) {
	$up = Vote::where('post_id', $post_id)->where('value', 'up')->get();
	return $up;
}

function down($post_id) {
	$down = Vote::where('post_id', $post_id)->where('value', 'down')->get();
	return $down;
}
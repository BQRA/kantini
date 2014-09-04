<?php
function guest_username() {
	if (isset($_COOKIE['guest'])) {
		$guest_username = '0'.$_COOKIE['guest'];
	} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = '0'.$a;
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

function up($post_id) {
	$up = Vote::where('post_id', $post_id)->where('value', 'up')->get();
	return $up;
}

function down($post_id) {
	$down = Vote::where('post_id', $post_id)->where('value', 'down')->get();
	return $down;
}
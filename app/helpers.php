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

function session_user_posts() {
	$user_posts = Post::where('username', '=', Sentry::getUser()->username)->get();
	return $user_posts;
}

function session_user_comments() {
	$user_comments = Comment::where('commenter', '=', Sentry::getUser()->username)->get();
	return $user_comments;
}

function session_user_likes() {
	$user_likes = Like::where('liker', '=', Sentry::getUser()->username)->get();
	return $user_likes;
}

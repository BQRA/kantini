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
	$user_comments = Comment::select('commenter')->where('commenter', Auth::user()->username)->get();
	return $user_comments;
}

function session_user_votes() {
	$user_votes = Vote::select('rater')->where('rater', Auth::user()->username)->get();
	return $user_votes;
}

function get_client_ip() {
$ip_address = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ip_address = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ip_address = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ip_address = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ip_address = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ip_address = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ip_address = getenv('REMOTE_ADDR');
    else
        $ip_address = 'UNKNOWN';
    return $ip_address;
}

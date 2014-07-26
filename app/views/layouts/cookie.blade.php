<?php
	if (isset($_COOKIE['guest'])) {
	$guest_username = 'misafir'.$_COOKIE['guest'];
	} else {
	$a = rand(1000, 100000);
	setcookie('guest', $a, time()+3600, '/');
	$guest_username = 'misafir'.$a;
	}
?>
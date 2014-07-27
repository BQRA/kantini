@extends('layouts.master')

@section('content')
	<?php
		if (isset($_COOKIE['guest'])) {
		$guest_username = 'misafir'.$_COOKIE['guest'];
		} else {
		$a = rand(1000, 100000);
		setcookie('guest', $a, time()+3600, '/');
		$guest_username = 'misafir'.$a;
		}
	?>

<div class="special-list-title">
	<span><a href="{{ URL::action('show.profile', $user->username) }}" data-lightbox="lightbox/profile.html" data-lightboxtitle="Profil Kartı">{{ $user->username }}</a> kullanıcısının</span>
	<div class="select-box">
		<span class="text">yorum yaptığı</span>
		<ul>
			<li>yazdığı</li>
			<li>yorum yaptığı</li>
			<li>beğendiği</li>
		</ul>
	</div>
	<span>gönderiler listeleniyor</span>
</div>



	@foreach($comments_all as $comments)
		<li>{{ $comments->comment }} => <a href="{{ URL::action('show.post', $comments->post->id) }}">Oku</a></li>
	@endforeach
@stop
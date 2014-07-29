@extends('layouts.master')

@section('content')
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

<div class="dedikods">
	@foreach($comments_all as $comments)
		<li>{{ $comments->post->post }} => <a href="{{ URL::action('show.post', $comments->post->id) }}">Oku</a></li>
	@endforeach
</div>


	
@stop
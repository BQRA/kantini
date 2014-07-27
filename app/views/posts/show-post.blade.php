@extends('layouts.master')

@section('content')
<?php
	if (isset($_COOKIE['guest'])) {
	$guest_username = 'misafir'.$_COOKIE['guest'];
	} else {
	$a = rand();
	setcookie('guest', $a, time()+3600, '/');
	$guest_username = 'misafir'.$a;
	}
?>
	<div class="dedikods">
		<div class="dedikod {{ $post->gender }}">
			<div class="avatar">
				<img src="images/users/avatar.jpg" alt="">
			</div>
			<div class="content">
			@if($post->type == '0')
			
			<a href="{{ URL::action('show.post', $post->id) }}">{{ $post->post }}</a>

			@endif
			@if($post->type == '1')
				<div class="content-ticket">
					<div class="add-event-container">
						<div class="ticket-effect"></div>
						<div class="add-event">
							<div class="details">

								<div class="row">
									<div class="col-sm-10 detail title">
										<strong>Etkinlik Adı</strong>
										<span>{{$post->org_name}}</span>
									</div>
									<div class="col-sm-2 detail pic">
										<div class="pic-upload">
											<img src="http://dummyimage.com/50x50" alt="">
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-sm-3 detail">
										<strong>Etkinlik Tarihi</strong>
										<span>21 Mayis 2013</span>
									</div>
									<div class="col-sm-3 detail">
										<strong>Yetkili Kisi</strong>
										<span>Bora Dan</span>
									</div>
									<div class="col-sm-3 detail">
										<strong>İletisim</strong>
										<span>0535 555 34 23</span>
									</div>
									<div class="col-sm-3 detail">
										<strong>Harita</strong>
										<span><a target="_blank" href="https://www.google.com/maps/place/Mihrişah+Valide+Sultan+Caddesi+(A.+Hisarı+E-80+Bağlantı+Yolu),+Anadolu+Hisarı+Mh.,+34398+İstanbul,+Türkiye/@41.0818107,29.0721677,17z/data=!3m1!4b1!4m2!3m1!1s0x14caca20f7e62653:0xb3d15fcbd31e51ae">Haritada Gör</a></span>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="row">
									<div class="col-sm-8 detail address">
										<strong>Adres</strong>
										<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo mollitia ab deleniti totam</span>
									</div>
									<div class="col-sm-4 detail price">
										75 TL
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			@endif
			</div>
			<div class="toolbar">
				<div class="left">
					@if($post->member == 1)
						<a class="username" data-lightbox="lightbox/profile.html" href="{{ URL::action('show.profile', $post->username) }}">
							{{ $post->username }}
						</a>
					@else 
						<span class="username">
							{{ $post->username }}
						</span>
					@endif
					<span class="date">{{ $post->created_at}}</span>
				</div>
				<div class="right">
					<span class="comment">{{ $comments->count(); }}</span>
					<span class="like">
						{{ $likes->count() }}
						@if(Sentry::check())
							@if(!Like::where('post_id', $post->id)->where('liker', Sentry::getUser()->username)->count()>0)
								{{ Form::open(array('action' => 'LikesController@Like')) }}
								
								{{ Form::hidden('liker', Sentry::getUser()->username) }}
								{{ Form::hidden('post_id', $post->id) }}

								{{ Form::submit(' ') }}

								{{ Form::close() }}
							@endif
						@else
							@if(!Like::where('post_id', $post->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
								{{ Form::open(array('action' => 'LikesController@GuestLike')) }}
								
								{{ Form::hidden('liker', $guest_username) }}
								{{ Form::hidden('post_id', $post->id) }}
								
								{{ Form::submit(' ') }}

								{{ Form::close() }}
							@endif
						@endif
					</span>
					<span class="button sm r green">Yorum Yaz</span>						
				</div>
			</div>

			<div class="clear"></div>

			<div class="comments opened">
				<div class="write-comment">
					<div class="avatar">
						<img src="images/users/avatar.jpg" alt="">
					</div>
					<div class="write-area">
						{{ Form::open(array('action' => 'PostsController@SendComment')) }}
						{{ Form::hidden('post_id', $post->id) }}
						@if(!Sentry::check())
							{{ Form::hidden('member', 0) }}
							{{ Form::hidden('commenter', $guest_username) }}
							{{ Form::text('comment', null, ['placeholder' => $guest_username.' olarak yorum yaz!']) }}
						@else
							{{ Form::hidden('commenter', Sentry::getUser()->username) }}
							{{ Form::hidden('gender', Sentry::getUser()->gender) }}
							{{ Form::hidden('member', 1) }}
							{{ Form::text('comment', null, ['placeholder' => Sentry::getUser()->username.' olarak yorum yaz!']) }}
						@endif
						{{ Form::submit('', ['style'=> 'display:none']) }}
						{{ Form::close() }}
					</div>
				</div>
				@foreach($comments as $comment )
					<div class="comment">
						<div class="avatar">
							<img src="images/users/avatar.jpg" alt="">
						</div>
						<div class="write-area">
							<span class="username {{ $comment->gender }}">
								@if($comment->member == 1)
									<a href="{{ URL::action('show.profile', $comment->commenter) }}">{{ $comment->commenter }}</a>
								@else 
									<b>{{ $comment->commenter }}</b>
								@endif
							</span>
							{{ $comment->comment }}
							<div class="date">{{ $comment->created_at }}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>	
	</div>
@stop
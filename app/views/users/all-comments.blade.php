@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yorum yaptığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($comments as $comment)
		<div class="dedikod {{$comment->post->gender}}">
			<div class="avatar">
				@if($comment->post->member == '0')
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if($comment->post->member == '1')
					<?php $user = User::with('profile')->whereUsername($comment->post->username)->firstOrFail(); ?>
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
					<?php $user = User::with('profile')->whereUsername($comment->post->username)->firstOrFail(); ?>
						{{ HTML::image('/Avatars/'.$comment->post->username.'.jpg') }}
					@endif
				@endif
			</div>

			<div class="content">
				<?php 
					$likes 	  = Like::where('post_id', '=', $comment->post->id )->get();
					$comments = Comment::where('post_id', '=', $comment->post->id )->get();
				?>
			@if($comment->post->type == 'dedikod')
				{{ $comment->post->post }}
			@endif

			@if($comment->post->type == 'event')
				<div class="content-ticket">
					<div class="add-event-container">
						<div class="ticket-effect"></div>
						<div class="add-event">
							<div class="details">

								<div class="row">
									<div class="col-sm-10 detail title">
										<strong>Etkinlik Adı</strong>
										<span>{{$comment->post->org_name}}</span>
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

			@if($comment->post->type == 'photo')
				{{$comment->post->post}}
			@endif

			@if($comment->post->type == 'video')
				{{$comment->post->post}}
			@endif

			</div>

			<div class="toolbar">
				<div class="left">
					@if($comment->post->member == '1')
						<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $comment->post->username }}
						</a>
					@else 
						<span class="username">
							{{ $comment->post->username }}
						</span>
					@endif
					<span class="date">{{ date('d.m.Y',strtotime($comment->post->created_at))}}</span>
				</div>
				<div class="right">
					<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $comment->post->id }} #giveComments">{{ $comments->count() }}</span>
					@if(Sentry::check())
						@if(!Like::where('post_id', $comment->post->id)->where('liker', Sentry::getUser()->username)->count()>0)
							<span class="like">{{ $likes->count() }}</span>
							{{ Form::open(['action' => 'LikesController@Like']) }}
							{{ Form::hidden('post_id', $comment->post->id) }}
							{{ Form::close() }}
						@else
							<span class="like selected">{{ $likes->count() }}</span>
						@endif
					@else
						@if(!Like::where('post_id', $comment->post->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
							<span class="like">{{ $likes->count() }}</span>
							{{ Form::open(['action' => 'LikesController@GuestLike']) }}
							{{ Form::hidden('post_id', $comment->post->id) }}
							{{ Form::close() }}
						@else 
							<span class="like selected">{{ $likes->count() }}</span>
						@endif
					@endif
					<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $comment->post->id }} #giveComments">Yorum Yaz</span>
				</div>
			</div>

			<div class="clear"></div>

			<div class="load-comments"></div>
		</div>
	@endforeach
</div>
@stop

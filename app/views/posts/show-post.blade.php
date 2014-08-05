@extends('layouts.master')

@section('content')
	<div class="dedikods">
		<div class="dedikod {{ $post->gender }}">
			<div class="avatar">
				@if($post->member == '0')
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if($post->member == '1')
					<?php $user = User::with('profile')->whereUsername($post->username)->firstOrFail(); ?>
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
					<?php $user = User::with('profile')->whereUsername($post->username)->firstOrFail(); ?>
						{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
					@endif
				@endif
			</div>

			<div class="content">
				@if($post->type == 'dedikod')
					{{ $post->post }}
				@endif
			
				@if($post->type == 'event')
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

				@if($post->type == 'photo')
					{{$post->post}}
				@endif

				@if($post->type == 'video')
					{{$post->post}}
				@endif
			</div>

			<div class="toolbar">
				<div class="left">
					@if($post->member == '1')
						<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $post->username }}
						</a>
					@else 
						<span class="username">
							{{ $post->username }}
						</span>
					@endif
					<span class="date">{{ date('d.m.Y',strtotime($post->created_at))}}</span>
				</div>

				<div class="right">
					<span class="comment">{{ $comments->count(); }}</span>
					@if(Sentry::check())
						@if(!Like::where('post_id', $post->id)->where('liker', Sentry::getUser()->username)->count()>0)
							<span class="like">{{ $likes->count() }}</span>
							{{ Form::open(['action' => 'LikesController@Like']) }}
							{{ Form::hidden('post_id', $post->id) }}
							{{ Form::hidden('post_type', $post->type) }}
							{{ Form::close() }}
						@else
							<span class="like selected">{{ $likes->count() }}</span>
						@endif
					@else
						@if(!Like::where('post_id', $post->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
							<span class="like">{{ $likes->count() }}</span>
							{{ Form::open(['action' => 'LikesController@GuestLike']) }}
							{{ Form::hidden('post_id', $post->id) }}
							{{ Form::hidden('post_type', $post->type) }}
							{{ Form::close() }}
						@else 
							<span class="like selected">{{ $likes->count() }}</span>
						@endif
					@endif			
				</div>
			</div>

			<div class="clear"></div>

			<div class="comments opened" id="giveComments">
				<div class="write-comment">
					<div class="avatar">
						@if(!Sentry::check())
							{{ HTML::image('/Avatars/guest-avatar.png') }}
						@else
							<?php $user = User::with('profile')->whereUsername(Sentry::getUser()->username)->firstOrFail(); ?>
							@if($user->profile->avatar == 'guest')
								{{ HTML::image('/Avatars/guest-avatar.png') }}
							@else
								<?php $user = User::with('profile')->whereUsername(Sentry::getUser()->username)->firstOrFail(); ?>
								{{ HTML::image('/Avatars/'.Sentry::getUser()->username.'.jpg') }}
							@endif
						@endif
					</div>

					<div class="write-area">
						{{ Form::open(array('action' => 'PostsController@SendComment')) }}
						{{ Form::hidden('post_id', $post->id) }}
						{{ Form::hidden('post_type', $post->type) }}
						
						@if(!Sentry::check())
							{{ Form::text('comment', null, ['placeholder' => guest_username().' olarak yorum yaz!']) }}
						@else
							{{ Form::text('comment', null, ['placeholder' => Sentry::getUser()->username.' olarak yorum yaz!']) }}
						@endif
						{{ Form::submit('', ['style'=> 'display:none']) }}
						{{ Form::close() }}
					</div>
				</div>
				
				@if($comments->count() > 0)
					@foreach($comments as $comment )
						<div class="comment">
							<div class="avatar">
								@if($comment->member == '0')
									{{ HTML::image('/Avatars/guest-avatar.png') }}
								@endif

								@if($comment->member == '1')
									<?php $user = User::with('profile')->whereUsername($comment->commenter)->firstOrFail(); ?>
									@if($user->profile->avatar == 'guest')
										{{ HTML::image('/Avatars/guest-avatar.png') }}
									@else
									<?php $user = User::with('profile')->whereUsername($comment->commenter)->firstOrFail(); ?>
										{{ HTML::image('/Avatars/'.$comment->commenter.'.jpg') }}
									@endif
								@endif
							</div>

							<div class="write-area">
								<span class="username {{$comment->gender}}">
									@if($comment->member == '1')
										<a data-lightbox="{{ URL::action('home') }}/user/profile/{{ $comment->commenter }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">{{ $comment->commenter }}</a>
									@else 
										<b>{{ $comment->commenter }}</b>
									@endif
								</span>
								{{ $comment->comment }}
								<div class="date">{{ date('d.m.Y',strtotime($comment->created_at)) }}</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="no-comment">
						{{'Henüz yorum yapılmamıs, ilk yorumu siz yapın'}}
					</div>
				@endif
			</div>
		</div>	
	</div>
@stop
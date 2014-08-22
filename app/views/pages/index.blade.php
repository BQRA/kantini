@extends('layouts.master')

@section('content')
<div class="filter-bar">
	<div class="left">
		<div class="select-box">
			<span class="text">Türe göre filtrele</span>
			<ul>
				<li><a href="#">Dedikodlar</a></li>
				<li><a href="#">Etkinlikler</a></li>
			</ul>
		</div>
	</div>

	<div class="right">
		<div class="select-box">
			<span class="text">İçeriğe göre filtrele</span>
			<ul>
				<li><a href="#">En yeniler</a></li>
				<li><a href="#">En eskiler</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="dedikods">
	@foreach($posts as $post)
	<?php
		$post_id 	= $post->id;
		$user 		= User::whereUsername($post->username)->first(); 
		$comments 	= Comment::where('post_id', '=', $post_id)->get();
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	?>
		<div class="dedikod {{$post->gender}}">
		{{-- Main Page Avatar --}}
			<div class="avatar">
				@if(empty($user))
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if(!empty($user))
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
					@endif
				@endif
			</div>
		{{-- Main Page Avatar --}}
				
			<div class="content">
				@if($post->type == 'dedikod')
					{{ $post->dedikod }}
				@endif
			
				@if($post->type == 'event')
					<div class="content-ticket">
						<div class="add-event-container">
							<div class="ticket-effect"></div>
							
							<div class="add-event">
								
								<div class="event-bg-image">
									{{ HTML::image('/Organizations/'.$post->event_photo) }}
								</div>

								<div class="details">
									<div class="row">
									
										<div class="col-sm-10 detail title">
											<strong>Etkinlik Adı</strong>
											<span>{{ $post->event_name }}</span>
										</div>
								
										<div class="col-sm-2 detail pic">
											<div class="pic-upload">
												{{ HTML::image('/Organizations/'.$post->event_photo) }}
											</div>
										</div>
									</div>
							
									<div class="clearfix"></div>
							
									<div class="row">
										<div class="col-sm-3 detail">
											<strong>Etkinlik Tarihi</strong>
											<span>{{ $post->event_date }}</span>
										</div>
								
										<div class="col-sm-3 detail">
											<strong>Yetkili Kisi</strong>
											<span>{{ $post->event_auth }}</span>
										</div>
								
										<div class="col-sm-3 detail">
											<strong>İletisim</strong>
											<span>{{ $post->event_auth_contact }}</span>
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
											<span>{{ $post->event_address }}</span>
										</div>
										
										<div class="col-sm-4 detail price">
											{{ $post->event_price }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="clear mt10"></div>
					{{ $post->dedikod }}
				@endif

				@if($post->type == 'image')
					<div class="content-img-container"><img src="{{$post->links}}" alt="" /></div>
					<div class="clear mt10"></div>
					{{ $post->dedikod }}
				@endif

				@if($post->type == 'video')
					<iframe width="580" height="360" src="{{$post->links}}?rel=0&autoplay=0&fullscreen=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					<div class="clear mt10"></div>
					{{ $post->dedikod }}
				@endif
			</div>
				
			<div class="toolbar">
				<div class="left">
					@if(!empty($user))
						<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $post->username }}
						</a>
					@else 
						<span class="username">{{ $post->username }}</span>
						@endif
						<span class="date"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y',strtotime($post->created_at))}}</a></span>
				</div>
						
				<div class="right">
					<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">{{$comments->count()}}</span>
					<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span>
					<span class="like">{{$up->count() - $down->count()}}</span>
				</div>
			</div>
				@include('partial.rating')
				
			<div class="clear"></div>
			<div class="load-comments"></div>
		</div>
	@endforeach
</div>
@stop

@extends('layouts.master')

@section('content')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($posts as $post)
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
						{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
					@endif
				@endif
			</div>
			
		<div class="content">
			<?php 
				$likes 	  = Like::where('post_id', '=', $post->id )->get();
				$comments = Comment::where('post_id', '=', $post->id )->get();
			?>
		@if($post->type == '0')
			<a href="{{ URL::action('show.post', $post->id) }}">{{ $post->post }}</a>
		@endif
		
		@if($post->type == '1')
			<div class="content-ticket">
				<div class="add-event-container">
					<div class="ticket-effect"></div>
					<div class="add-event">

						<div class="event-bg-image">
							{{ HTML::image('/Organizations/'.$post->org_photo) }}
						</div>
						<div class="details">

							<div class="row">
								<div class="col-sm-10 detail title">
									<strong>Etkinlik Adı</strong>
									<span>{{$post->org_name}}</span>
								</div>
								<div class="col-sm-2 detail pic">
									<div class="pic-upload">
										{{ HTML::image('/Organizations/'.$post->org_photo) }}
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-3 detail">
									<strong>Etkinlik Tarihi</strong>
									<span>{{date('d m Y',strtotime($post->org_date))}}</span>
								</div>
								<div class="col-sm-3 detail">
									<strong>Yetkili Kisi</strong>
									<span>{{$post->org_auth}}</span>
								</div>
								<div class="col-sm-3 detail">
									<strong>İletisim</strong>
									<span>{{$post->org_auth_contact}}</span>
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
									<span>{{$post->org_address}}</span>
								</div>
								<div class="col-sm-4 detail price">
									{{$post->org_price}}
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		@endif

		@if($post->type == '2')
			{{$post->post}}
		@endif

		@if($post->type == '3')
			{{$post->post}}
		@endif

		</div>
		
		@include('partial.toolbar')

		<div class="clear"></div>

		<div class="load-comments"></div>

	</div>	
	@endforeach
	
</div>
@stop
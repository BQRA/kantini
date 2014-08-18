<div class="dedikod {{$dummy->gender}}">
	<div class="avatar">
		@if($dummy->member == '0')
			{{ HTML::image('/Avatars/guest-avatar.png') }}
		@endif

		@if($dummy->member == '1')
			<?php $user = User::with('profile')->whereUsername($dummy->username)->firstOrFail(); ?>
			@if($user->profile->avatar == 'guest')
				{{ HTML::image('/Avatars/guest-avatar.png') }}
			@else
			<?php $user = User::with('profile')->whereUsername($dummy->username)->firstOrFail(); ?>
				{{ HTML::image('/Avatars/'.$dummy->username.'.jpg') }}
			@endif
		@endif
	</div>

	<div class="content">
		<?php 
			$likes 	  = Like::where('post_id', '=', $dummy->id )->get();
			$comments = Comment::where('post_id', '=', $dummy->id )->get();
		?>
			
		@if($dummy->type == 'dedikod')
			{{ $dummy->post }}
		@endif

		@if($dummy->type == 'event')
			<div class="content-ticket">
				<div class="add-event-container">
					<div class="ticket-effect"></div>
					<div class="add-event">
						<div class="details">
							<div class="row">
							<div class="col-sm-10 detail title">
								<strong>Etkinlik Adı</strong>
								<span>{{ $dummy->org_name }}</span>
							</div>
							<div class="col-sm-2 detail pic">
								<div class="pic-upload">
									{{ HTML::image('/Organizations/'.$dummy->org_photo) }}
								</div>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-3 detail">
									<strong>Etkinlik Tarihi</strong>
									<span>{{ date('d.m.Y',strtotime($dummy->org_date)) }}</span>
								</div>
								<div class="col-sm-3 detail">
									<strong>Yetkili Kisi</strong>
									<span>{{ $dummy->org_auth }}</span>
								</div>
								<div class="col-sm-3 detail">
									<strong>İletisim</strong>
									<span>{{ $dummy->org_auth_contact }}</span>
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
									<span>{{ $dummy->org_address }}</span>
								</div>
								<div class="col-sm-4 detail price">
									{{ $dummy->org_price }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif

		@if($dummy->type == 'image')
			{{$dummy->post}}
		@endif

		@if($dummy->type == 'video')
			{{$dummy->post}}
		@endif

	</div>

	<div class="toolbar">
		<div class="left">
			@if($dummy->member == '1')
				<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
					{{ $dummy->username }}
				</a>
			@else 
				<span class="username">
					{{ $dummy->username }}
				</span>
			@endif
				<span class="date">{{ date('d.m.Y',strtotime($dummy->created_at))}}</span>
		</div>
		<div class="right">
			<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $dummy->id }} #giveComments">{{ $comments->count() }}</span>
			@if(Sentry::check())
				@if(!Like::where('post_id', $dummy->id)->where('liker', Sentry::getUser()->username)->count()>0)
					<span class="like">{{ $likes->count() }}</span>
					{{ Form::open(['action' => 'LikesController@Like']) }}
					{{ Form::hidden('post_id', $dummy->id) }}
					{{ Form::hidden('post_type', $dummy->type) }}
					{{ Form::close() }}
				@else
					<span class="like selected">{{ $likes->count() }}</span>
				@endif
			@else
				@if(!Like::where('post_id', $dummy->id)->where('ip_address', $_SERVER['REMOTE_ADDR'])->count()>0)
					<span class="like">{{ $likes->count() }}</span>
					{{ Form::open(['action' => 'LikesController@GuestLike']) }}
					{{ Form::hidden('post_id', $dummy->id) }}
					{{ Form::hidden('post_type', $dummy->type) }}
					{{ Form::close() }}
				@else 
					<span class="like selected">{{ $likes->count() }}</span>
				@endif
			@endif
				<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $dummy->id }} #giveComments">Yorum Yaz</span>
		</div>
	</div>

	<div class="clear"></div>
	<div class="load-comments"></div>
</div>
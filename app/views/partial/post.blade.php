@if($post->type == 'event')
	<div class="content-ticket">
		<div class="add-event-container">
			
			<div class="ticket-effect"></div>
							
			<div class="add-event">
				<div class="event-bg-image">
					{{ HTML::image('/Events/sm-events/sm-'.$post->event_photo.'.jpg') }}
				</div>

				<div class="details">
					<div class="row">
						<div class="col-xs-10 detail title">
							<strong>Etkinlik Adı</strong>
							<span>{{ $post->event_name }}</span>
						</div>
								
						<div class="col-xs-2 detail pic">
							<div class="pic-upload">
								{{ HTML::image('/Events/sm-events/sm-'.$post->event_photo.'.jpg') }}
								{{ Form::hidden("normal-size", HTML::image("/Events/".$post->event_photo.".jpg")) }}
							</div>
						</div>
					</div>
							
					<div class="clearfix"></div>
							
					<div class="row">
						<div class="col-xs-3 detail">
							<strong>Etkinlik Tarihi</strong>
							<span>{{ date('d.m.Y',strtotime($post->event_date)) }}</span>
						</div>

						<div class="col-xs-3 detail">
							<strong>Etkinlik Saati</strong>
							@if($post->event_time == null)
								<span>&#8212</span>
							@else
								<span>{{ $post->event_time }}</span>
							@endif
						</div>
								
						<div class="col-xs-3 detail">
							<strong>Yetkili Kisi</strong>
							<span>{{ $post->event_auth }}</span>
						</div>
								
						<div class="col-xs-3 detail">
							<strong>İletisim</strong>
							@if($post->event_auth_contact == null)
								<span>&#8212</span>
							@else
								<span>{{ $post->event_auth_contact }}</span>
							@endif
						</div>
					</div>
							
					<div class="clearfix"></div>
							
					<div class="row">
						<div class="col-xs-5 detail last-line">
							<strong>Adres</strong>
							@if($post->event_address == null)
								<span>&#8212</span>
							@else
								<span>{{ $post->event_address }}</span>
							@endif
						</div>

						<div class="col-xs-3 detail last-line">
							<strong>Harita</strong>
							@if($post->event_auth_contact == null)
								<span>&#8212</span>
							@else
								<span>{{ $post->event_auth_contact }}</span>
							@endif
						</div>
										
						<div class="col-xs-4 detail price last-line">
							{{ $post->event_price }}
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear mt10"></div>

@elseif($post->type == 'image')
	<div class="content-img-container"><img src="{{$post->links}}" alt="" /></div>
	<div class="clear mt10"></div>

@elseif($post->type == 'mediaFromPc')
	<div class="content-img-container">
	{{ HTML::image('/images/'.$post->links.'.jpg') }}</div>
	<div class="clear mt10"></div>

@elseif($post->type == 'video')
	<iframe width="580" height="360" src="{{$post->links}}?rel=0&autoplay=0&fullscreen=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	<div class="clear mt10"></div>
@endif

@if($post->dedikod !== null)
	<span class="dedikod-content">
		{{ $post->dedikod }}
	</span>
@endif

@if(Auth::check())
	@if(Auth::user()->username == $post->username)
		<div class="new-edit-area">
			{{ Form::open(['action' => ['PostsController@editPost', $post->id]]) }}
			{{ Form::textarea('edit-dedikod', $post->dedikod, ['class' => 'edit']) }}
				<div class="text-right">
					<span class="cancel-edit">Vazgeç</span><input class="button sm green" type="submit" value="Düzenlemeyi Gönder" />
				</div>
			{{ Form::close() }}
		</div>
	@endif
@endif

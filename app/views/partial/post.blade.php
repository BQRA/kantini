@if($post->type == 'event')
	<div class="content-ticket">
		<div class="add-event-container">
			
			<div class="ticket-effect"></div>
							
			<div class="add-event">
				<div class="event-bg-image">
					{{ HTML::image('/Events/'.$post->event_photo) }}
				</div>

				<div class="details">
					<div class="row">
						<div class="col-sm-10 detail title">
							<strong>Etkinlik Adı</strong>
							<span>{{ $post->event_name }}</span>
						</div>
								
						<div class="col-sm-2 detail pic">
							<div class="pic-upload">
								{{ HTML::image('/Events/'.$post->event_photo) }}
							</div>
						</div>
					</div>
							
					<div class="clearfix"></div>
							
					<div class="row">
						<div class="col-sm-3 detail">
							<strong>Etkinlik Tarihi</strong>
							<span>{{ date('d.m.Y',strtotime($post->event_date)) }}</span>
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
							<span>{{ $post->event_auth_contact }}</span>
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

@elseif($post->type == 'image')
	<div class="content-img-container"><img src="{{$post->links}}" alt="" /></div>
	<div class="clear mt10"></div>

@elseif($post->type == 'video')
	<iframe width="580" height="360" src="{{$post->links}}?rel=0&autoplay=0&fullscreen=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	<div class="clear mt10"></div>
@endif

<span class="dedikod-content">
	{{ $post->dedikod }}
</span>

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

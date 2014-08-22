@if($dummy->type == 'dedikod')
	{{ $dummy->dedikod }}
@endif

@if($dummy->type == 'event')
	<div class="content-ticket">
		<div class="add-event-container">
			
			<div class="ticket-effect"></div>
							
			<div class="add-event">
				<div class="event-bg-image">
					{{ HTML::image('/Organizations/'.$dummy->event_photo) }}
				</div>

				<div class="details">
					<div class="row">
						<div class="col-sm-10 detail title">
							<strong>Etkinlik Adı</strong>
							<span>{{ $dummy->event_name }}</span>
						</div>
								
						<div class="col-sm-2 detail pic">
							<div class="pic-upload">
								{{ HTML::image('/Organizations/'.$dummy->event_photo) }}
							</div>
						</div>
					</div>
							
					<div class="clearfix"></div>
							
					<div class="row">
						<div class="col-sm-3 detail">
							<strong>Etkinlik Tarihi</strong>
							<span>{{ $dummy->event_date }}</span>
						</div>
								
						<div class="col-sm-3 detail">
							<strong>Yetkili Kisi</strong>
							<span>{{ $dummy->event_auth }}</span>
						</div>
								
						<div class="col-sm-3 detail">
							<strong>İletisim</strong>
							<span>{{ $dummy->event_auth_contact }}</span>
						</div>
								
						<div class="col-sm-3 detail">
							<strong>Harita</strong>
							<span>{{ $dummy->event_auth_contact }}</span>
						</div>
					</div>
							
					<div class="clearfix"></div>
							
					<div class="row">
						<div class="col-sm-8 detail address">
							<strong>Adres</strong>
							<span>{{ $dummy->event_address }}</span>
						</div>
										
						<div class="col-sm-4 detail price">
							{{ $dummy->event_price }}
						</div>
									
				</div>
			</div>
		</div>
	</div>

	<div class="clear mt10"></div>
	{{ $dummy->dedikod }}
	</div>
@endif

@if($dummy->type == 'image')
	<div class="content-img-container"><img src="{{$dummy->links}}" alt="" /></div>
	<div class="clear mt10"></div>
	{{ $dummy->dedikod }}
@endif

@if($dummy->type == 'video')
	<iframe width="580" height="360" src="{{$dummy->links}}?rel=0&autoplay=0&fullscreen=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	<div class="clear mt10"></div>
	{{ $dummy->dedikod }}
@endif
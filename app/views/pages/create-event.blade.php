@extends('layouts.master')

@section('content')

<div id="addEvent">
	{{ Form::hidden('post_type', 'event') }}
	<div class="add-event-container">
		<div class="ticket-effect"></div>
		<div class="add-event">
			<div class="details">
				<div class="row">
					<div class="col-xs-10 detail title">
						<strong>Etkinlik Adı</strong>
						{{ Form::Input('text', 'event_name', null, ['placeholder' => 'Etkinlik adını giriniz...']) }}
					</div>
					<div class="col-xs-2 detail pic">
						<div class="pic-upload">
							<img id="htmlImageApi" src="Assets/images/select-image.png" />
							<input type="file" onchange="previewImage(this)" accept="image/*" />
							<input type="hidden" id="event-image" name="event-image" />
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-3 detail">
						<strong>Etkinlik Tarihi</strong>
						{{ Form::Input('text', 'event_date', null, ['placeholder' => 'GG/AA/YYYY']) }}
					</div>
					<div class="col-xs-3 detail">
						<strong>Etkinlik Saati</strong>
						{{ Form::Input('text', 'event_time', null, ['placeholder' => 'SS:DD']) }}
					</div>
					<div class="col-xs-3 detail">
						<strong>Yetkili Kisi</strong>
						{{ Form::Input('text', 'event_auth', null, ['placeholder' => 'İsim Soyisim']) }}
					</div>
					<div class="col-xs-3 detail">
						<strong>İletisim</strong>
						{{ Form::Input('text', 'event_auth_contact', null, ['placeholder' => '05550000000']) }}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-5 detail last-line">
						<strong>Adres</strong>
						{{ Form::Input('text', 'event_address', null, ['placeholder' => 'Varsa etkinlik alanının adresini giriniz...']) }}
					</div>
					<div class="col-xs-3 detail last-line">
						<strong>Harita</strong>
						{{ Form::Input('text', 'event_map', null, ['placeholder' => 'Harita Linki']) }}
					</div>
					<div class="col-xs-4 detail price last-line">
						{{ Form::Input('text', 'event_price', null, ['placeholder' => 'Ücretsiz']) }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clear mt30"></div>

	<div class="text-center">
		<div class="button green" data-type="event" id="addAttachment">Dedikod'a Ekle</div>
	</div>
</div>

@stop
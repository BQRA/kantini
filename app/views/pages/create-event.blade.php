@extends('layouts.master')

@section('content')

<div id="addEvent" class="req">
	{{ Form::hidden('post_type', 'event') }}
	<div class="add-event-container">
		<div class="ticket-effect"></div>
		<div class="add-event">

			<div class="event-bg-image"></div>

			<div class="details">
				<div class="row">
					<div class="col-xs-10 detail title">
						<strong>Etkinlik Adı</strong>
						{{ Form::Input('text', 'event_name', null, ['placeholder' => 'Etkinlik adını giriniz...', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
					</div>
					<div class="col-xs-2 detail pic">
						<div class="pic-upload">
							<input type="file" data-imagetype="event" onchange="previewImage(this)" accept="image/*" />
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-xs-3 detail">
						<strong>Etkinlik Tarihi</strong>
						{{ Form::Input('text', 'event_date', null, ['placeholder' => 'GG.AA.YYYY', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
					</div>
					<div class="col-xs-3 detail">
						<strong>Etkinlik Saati</strong>
						{{ Form::Input('text', 'event_time', null, ['placeholder' => 'SS:DD']) }}
					</div>
					<div class="col-xs-3 detail">
						<strong>Yetkili Kisi</strong>
						{{ Form::Input('text', 'event_auth', null, ['placeholder' => 'İsim Soyisim', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
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
						{{ Form::Input('text', 'event_price', null, ['placeholder' => 'Ücretsiz', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur']) }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clear mt30"></div>

	<div class="text-center">
		<div class="button green" data-validator data-type="event" id="addAttachment">Dedikod'a Ekle</div>
	</div>
</div>

@stop
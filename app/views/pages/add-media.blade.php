@extends('layouts.master')

@section('content')

<div id="addMedia">
	{{ Form::hidden('post_type')}}
	<div class="blank-page box">
		<h2>Baska bir URL'den Link Ekle</h2>
		<p>
			Dedikod'unuza resim veya vidyo eklemek icin eklemek istediğiniz medyanın URL'sini giriniz. <br>
			Örn: <b>http://images.boomsbeat.com/data/images/full/209/jobs-jpg.jpg</b> veya <b>http://www.youtube.com/watch?v=bd6dQmN-mPw</b>
		</p>
		<input id="mediaUrl" type="text" placeholder="http://">

		<div class="clear mt30"></div>

		<div class="text-center">
			<div class="button green" data-type="media" id="addAttachment">Dedikod'a Ekle</div>
		</div>
	</div>
</div>

@stop
@extends('layouts.master')

@section('content')

<div id="addMedia">
	{{ Form::hidden('post_type', 'media')}}
	<div class="blank-page box">

		<div class="tab" data-tab-number="1">
			<div class="item selected">URL ile Link Ekle</div>
			<div class="item">Bilgisayarından Görsel Ekle</div>
		</div>

		<div class="tab-content" data-tab-number="1">
			<div class="tab-content-item selected">
				<h2>Baska bir URL'den Link Ekle</h2>
				<p>
					Dedikod'unuza resim veya video eklemek icin eklemek istediğiniz medyanın URL'sini giriniz. <br>
					Örn: <b>http://images.boomsbeat.com/data/images/full/209/jobs-jpg.jpg</b> veya <b>http://www.youtube.com/watch?v=bd6dQmN-mPw</b>
				</p>
				
				<div class="upload-from-url">
					{{ Form::Input('text', 'media' ,null, ['placeholder' => 'http://', 'id' => 'mediaUrl'] ) }}
				</div>

			</div>
			<div class="tab-content-item">
				<h2>Bilgisayarından Görsel Ekle</h2>
				<p>
					Dedikod'unuza bilgisayarınızdan görsel eklemek için, eklemek istediğiniz görseli bilgisayarınızdan seçin. <br> 
					Azami büyüklük: <b>2MB</b>, <br>Desteklenen Uzantılar: <b>jpg, png, gif</b> 
				</p>

				<div class="upload-from-computer">
					<div class="pic-upload">
						<img id="htmlImageApi" src="Assets/images/select-image.png" />
						<input type="file" onchange="previewImage(this)" accept="image/*" />
						<input type="hidden" id="event-image" name="computer-image" />
					</div>
				</div>

			</div>
		</div>

		<div class="clear mt30"></div>

		<div class="text-center">
			<div class="button green" data-type="media" id="addAttachment">Dedikod'a Ekle</div>
		</div>

	</div>
</div>

@stop
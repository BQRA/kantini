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
			<div class="tab-content-item req selected">
				<h2>Baska bir URL'den Link Ekle</h2>
				<p>
					<span class="tooltip" data-content="Lorem ipsum">Dedikod'unuza resim</span> veya video eklemek icin eklemek istediğiniz medyanın URL'sini giriniz. <br>
					Örn: <b>http://images.boomsbeat.com/data/images/full/209/jobs-jpg.jpg</b> veya <b>http://www.youtube.com/watch?v=bd6dQmN-mPw</b>
				</p>
				
				<div class="upload-from-url">
					<label>
					{{ Form::Input('text', 'media' ,null, ['placeholder' => 'http://', 'id' => 'mediaUrl', 'data-valid' => 'required', 'data-message' => 'Bu Alan Zorunludur'] ) }}
					</label>
				</div>

				<div class="clear mt30"></div>

				<div class="text-center">
					<div class="button green" data-validator data-type="media" id="addAttachment">Dedikod'a Ekle</div>
				</div>

			</div>
			<div class="tab-content-item req">
				<h2>Bilgisayarından Görsel Ekle</h2>
				<p>
					Dedikod'unuza bilgisayarınızdan görsel eklemek için, eklemek istediğiniz görseli bilgisayarınızdan seçin. <br> 
					Azami büyüklük: <b>2MB</b>, <br>Desteklenen Uzantılar: <b>jpg, png, gif</b> 
				</p>

				<div class="upload-from-computer">
					<div class="pic-upload">
						<input type="file" data-imagetype="image" onchange="previewImage(this)" accept="image/*" data-valid="required" data-message="Bu Alan Zorunludur" />
					</div>
				</div>

				<div class="clear mt30"></div>

				<div class="text-center">
					<div class="button green" data-validator data-type="media" id="addAttachment">Dedikod'a Ekle</div>
				</div>

			</div>
		</div>

	</div>
</div>

@stop
<div class="header">
	<div class="logo">
		<h1>
			&nbsp;
			<span><a href="{{ URL::route('home') }}">KANTİNİ</a></span>
		</h1>
	</div>

	{{ Form::open(['action' => 'PostsController@SendPost']) }}
	<div class="dedikod-area">

		<!-- dedikod attachment infos -->
		<div class="dedikod-attachment-infos"></div>
		<!-- dedikod attachment infos #end -->

		@if(!Sentry::check())
			{{ Form::textarea('post', null, ['placeholder' => guest_username().' olarak dedikodla!']) }}
		@else 
			{{ Form::textarea('post', null, ['placeholder' => Sentry::getUser()->username.' olarak dedikodla!'])}}
		@endif
		<div class="bottom-bar">
			<div class="left">
				<span class="bar-button selected">Dedikodla!</span>
				<span class="bar-button" data-lightbox="{{ URL::action('home') }}/create-organization #addEvent" data-lightboxtitle="Etkinlik Ekle">Etkinlik Ekle</span>
				<span class="bar-button" data-lightbox="{{ URL::action('home') }}/add-media #addMedia" data-lightboxtitle="Resim veya Vidyo Ekle">Resim veya Vidyo Ekle</span>
			</div>
			<div class="right">
				@if(!Sentry::check())
					{{ Form::hidden('gender', '') }}
					<span name="male" class="gender male bar-button"></span>
					<span name="female" class="gender female bar-button"></span>
				@endif
				
				<span class="send">
					Shift + Enter &nbsp;
					{{ Form::submit('GÖNDER', ['class' => 'button green sm'])}}
				</span>
			</div>
		</div>
	</div>
	{{ Form::close() }}

</div>
<div class="header">
	<div class="logo">
		<h1>
			&nbsp;
			<span><a href="{{ URL::route('home') }}">KANTİNİ</a></span>
		</h1>
	</div>

	{{ Form::open(['action' => 'PostsController@sendPost', 'files' => true]) }}
	@if(!empty($school))
	{{ Form::hidden('school', $school) }}
	@endif
	<div class="dedikod-area">

		<!-- dedikod attachment infos -->
		<div class="dedikod-attachment-infos"></div>
		<!-- dedikod attachment infos #end -->
		
		<div class="textarea-container">

			<div class="attachment">
				<div class="del-attach">
					<span class="icon">&#61956</span>
				</div>
				<img src="" alt="">
			</div>

			@if(!Auth::check())
				{{ Form::textarea('dedikod', null, ['placeholder' => guest_username().' olarak dedikodla!']) }}
			@else 
				{{ Form::textarea('dedikod', null, ['placeholder' => Auth::user()->username.' olarak dedikodla!'])}}
			@endif
		</div>
		<div class="bottom-bar">
			<div class="left">
				<div class="no-attachment">
					<span class="bar-button event" data-lightbox="{{ URL::action('home') }}/create-event #addEvent" data-lightboxtitle="Etkinlik Ekle">Etkinlik Ekle</span>
					<span class="bar-button media" data-lightbox="{{ URL::action('home') }}/add-media #addMedia" data-lightboxtitle="Resim veya Video Ekle">Resim veya Video Ekle</span>
				</div>
				<div class="event-attached attached">
					<span class="bar-button event" data-edit data-lightboxtitle="Etkinliği Düzenle">Etkinliği Düzenle</span>
				</div>
				<div class="media-attached attached">
					<span class="bar-button media" data-edit data-lightboxtitle="Resim veya Videoyu Düzenle">Resim veya Videoyu Düzenle</span>
				</div>
			</div>
			<div class="right">
				@if(!Auth::check())
					{{ Form::hidden('gender', '') }}
					<span name="male" class="gender male bar-button"></span>
					<span name="female" class="gender female bar-button"></span>
				@endif

				<span class="send">
					Shift + Enter &nbsp;
					{{ Form::submit('DEDiKODLA', ['class' => 'button green sm'])}}
				</span>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
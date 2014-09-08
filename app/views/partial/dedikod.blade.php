@if(Auth::check())
	@if(Flag::where('post_id', $post->id)->where('user_id', Auth::user()->id)->count()>0)
		<div class="dedikod {{ $post->gender }} reported {{ $post->school }}">
			<span class="reporting">Raporlandı</span>
	@else
		<div class="dedikod {{ $post->gender }} {{ $post->school }}">
	@endif
@else
	<div class="dedikod {{ $post->gender }} {{ $post->school }}">
@endif
	
@if(!empty($school))
@elseif(!empty($uni['school_fullname']))
	<div class="uni tooltip" data-content="{{ $uni['school_fullname'] }}"></div>
@else
	<div class="uni tooltip" data-content="kantini"></div>
@endif

	@include('partial.avatar')
	
	<div class="content">
		@include('partial.post')
	</div>
	
	@include('partial.toolbar')
	
	<div class="clear"></div>
	
	@if(Route::currentRouteName() !== 'show.post' )
		<div class="load-comments">
			<div class="comments loading"><i></i></div>
		</div>
	@else
		<div class="comments" id="giveComments">
			<div class="write-comment">
				<!-- Commenter Avatar -->
				<div class="avatar">
					@if(!Auth::check())
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						@if(Auth::user()->profile->avatar == 'guest')
							{{ HTML::image('/Avatars/guest-avatar.png') }}
						@else
							{{ HTML::image('/Avatars/'.Auth::user()->username.'.jpg') }}
						@endif
					@endif
				</div>
				<!-- Commenter Avatar -->

				<div class="write-area req">
					{{ Form::open(['action' => ['PostsController@sendComment', $post->id]]) }}
						
					@if(!Auth::check())
						<div>
							{{ Form::text('comment', null, ['placeholder' => guest_username().' olarak yorum yaz!', 'autocomplete' => 'off', 'data-valid' => 'required', 'data-message' => 'Mesajınızı bos geçmeyiniz']) }}
						</div>
							
						<div class="d-none ajax-comment-values">
							<div class="write-area">
								<span class="username">{{ guest_username() }}</span>&nbsp;<span class="comment-content"></span><div class="date"></div>
							</div>
						</div>
					@else
						<div>
							{{ Form::text('comment', null, ['placeholder' => Auth::user()->username.' olarak yorum yaz!', 'autocomplete' => 'off', 'data-valid' => 'required', 'data-message' => 'Mesajınızı bos geçmeyiniz']) }}
						</div>
							
						<div class="d-none ajax-comment-values">
							<div class="write-area">
								<span class="username {{ Auth::user()->profile->gender }}">
									<a href="javascript:;" data-lightbox="{{ URL::action('home') }}/user/profile/{{ Auth::user()->username }} #profileBox" data-lightboxtitle="Profil Kartı">{{ Auth::user()->username }}</a>
								</span><span class="comment-content"></span><div class="date"></div>
							</div>
						</div>
					@endif
						{{ Form::submit('', ['style'=> 'display:none', 'data-validator']) }}
						{{ Form::close() }}
				</div>
			</div>

				@if($comments->count() > 0)
					@foreach($comments as $comment)
					<?php $commenter = User::whereUsername($comment->commenter)->first(); ?>
						<div class="comment">
							<!-- Commenter Comment Avatar -->
							<div class="avatar">
								@if(empty($commenter))
									{{ HTML::image('/Avatars/guest-avatar.png') }}
								@endif

								@if(!empty($commenter))
									@if($commenter['profile']['avatar'] == 'guest')
										{{ HTML::image('/Avatars/guest-avatar.png') }}
									@else
										{{ HTML::image('/Avatars/'.$commenter->username.'.jpg') }}
									@endif
								@endif
							</div>
							<!-- Commenter Comment Avatar -->

							<div class="write-area">
								<span class="username {{$commenter['profile']['gender']}}">
									@if(!empty($commenter))
										<a data-lightbox="{{ URL::action('home') }}/user/profile/{{ $comment->commenter }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">{{ $comment->commenter }}</a>
									@else 
										{{ $comment->commenter }}
									@endif
								</span>
								<span class="comment-content">{{ $comment->comment }}</span>
									<div class="date">{{ date('d.m.Y',strtotime($comment->created_at)) }}</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="no-comment">
						{{'Henüz yorum yapılmamış, ilk yorumu siz yapın'}}
					</div>
				@endif
		</div>
	@endif
</div>
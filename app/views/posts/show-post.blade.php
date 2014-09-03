@extends('layouts.master')

@section('content')
	<div class="dedikods">
	<?php $dummy = $post; ?>
		<div class="dedikod {{ $dummy->gender }}">
			@include('partial.avatar')

			<div class="content">
				@include('partial.dummy')
			</div>

			@include('partial.toolbar')
			
			<div class="clear"></div>

			<div class="comments" id="giveComments">
				<div class="write-comment" data-username="{{ Auth::user()->username }}" data-lb="{{ URL::action('home') }}/user/profile/{{ Auth::user()->username }}" data-gender="{{ Auth::user()->profile->gender }}">
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

					<div class="write-area">
						{{ Form::open(['action' => ['PostsController@sendComment', $post_id]]) }}
						
						@if(!Auth::check())
							{{ Form::text('comment', null, ['placeholder' => guest_username().' olarak yorum yaz!', 'autocomplete' => 'off']) }}
						@else
							{{ Form::text('comment', null, ['placeholder' => Auth::user()->username.' olarak yorum yaz!', 'autocomplete' => 'off']) }}
						@endif
						{{ Form::submit('', ['style'=> 'display:none']) }}
						{{ Form::close() }}
					</div>
				</div>

				@if($comments->count() > 0)
					@foreach($comments as $comment)
					<?php $commenter = User::whereUsername($comment->commenter)->first(); ?>
						<div class="comment">
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

							<div class="write-area">
								<span class="username {{$commenter['profile']['gender']}}">
									@if(!empty($commenter))
										<a data-lightbox="{{ URL::action('home') }}/user/profile/{{ $comment->commenter }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">{{ $comment->commenter }}</a>
									@else 
										<b>{{ $comment->commenter }}</b>
									@endif
								</span>
								{{ $comment->comment }}
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
		</div>	
	</div>
@stop

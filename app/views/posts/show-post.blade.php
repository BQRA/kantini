@extends('layouts.master')

@section('content')
	<div class="dedikods">
	<?php 
		$dummy 		= $post;
		$post_id 	= $dummy->id;
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	?>
		<div class="dedikod {{ $dummy->gender }}">
			{{-- Main Page Avatar --}}
			<div class="avatar">
				@if(empty($user))
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if(!empty($user))
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						{{ HTML::image('/Avatars/'.$dummy->username.'.jpg') }}
					@endif
				@endif
			</div>
			{{-- Main Page Avatar --}}

			<div class="content">
				@include('partial.dummy')
			</div>

			<div class="toolbar">
				@include('partial.toolbar')
			</div>

			@include('partial.rating')
			
			<div class="clear"></div>

			<div class="comments opened" id="giveComments">
				<div class="write-comment">
					<div class="avatar">
						@if(!Auth::check())
							{{ HTML::image('/Avatars/guest-avatar.png') }}
						@else
							@if($login_user->profile->avatar == 'guest')
								{{ HTML::image('/Avatars/guest-avatar.png') }}
							@else
								{{ HTML::image('/Avatars/'.Auth::user()->username.'.jpg') }}
							@endif
						@endif
					</div>

					<div class="write-area">
						{{ Form::open(['action' => 'PostsController@sendComment']) }}
						{{ Form::hidden('post_id', $post_id) }}
						{{ Form::hidden('post_type', $dummy->type) }}
						
						@if(!Auth::check())
							{{ Form::text('comment', null, ['placeholder' => guest_username().' olarak yorum yaz!']) }}
						@else
							{{ Form::text('comment', null, ['placeholder' => Auth::user()->username.' olarak yorum yaz!']) }}
						@endif
						{{ Form::submit('', ['style'=> 'display:none']) }}
						{{ Form::close() }}
					</div>
				</div>

				@if($comments->count() > 0)
					@foreach($comments as $comment)
					<?php 
						$commenter = User::whereUsername($comment->commenter)->first(); 
					?>
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
	{{ $post->links }}
@stop

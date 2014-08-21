@extends('layouts.master')

@section('content')
	<div class="dedikods">
		<div class="dedikod {{ $post->gender }}">
			{{-- Main Page Avatar --}}
			<div class="avatar">
				@if(empty($user))
					{{ HTML::image('/Avatars/guest-avatar.png') }}
				@endif

				@if(!empty($user))
					@if($user->profile->avatar == 'guest')
						{{ HTML::image('/Avatars/guest-avatar.png') }}
					@else
						{{ HTML::image('/Avatars/'.$post->username.'.jpg') }}
					@endif
				@endif
			</div>
			{{-- Main Page Avatar --}}

			<div class="content">
				@if($post->type == 'dedikod')
					{{ $post->dedikod }}
				@endif
			</div>

			<div class="toolbar">
				<div class="left">
					@if(!empty($user))
						<a class="username" data-lightbox="{{ URL::action('show.profile', $user->username) }} #profileBox" data-lightboxtitle="Profil Kartı" href="javascript:;">
							{{ $post->username }}
						</a>
					@else 
						<span class="username">{{ $post->username }}</span>
					@endif
						<span class="date"><a href="{{ URL::action('show.post', $post_id) }}">{{date('d.m.Y',strtotime($post->created_at))}}</a></span>
				</div>

				<div class="right">
					<span class="comment get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">0</span>
					<span class="like">{{$up->count() - $down->count()}}</span>
					<span class="button sm r green get-comments" data-comments="{{ URL::action('home') }}/post/{{ $post_id }} #giveComments">Yorum Yaz</span>
				</div>	
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
						{{ Form::hidden('post_type', $post->type) }}
						
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

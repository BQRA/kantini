@extends('layouts.master')

@section('content')

	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif
	
	@include('layouts.send-post')

	@foreach($posts as $post)
		
		@if($post->type == '0')
			<p>
				{{ $post->post }} | <a href="{{ URL::action('show.post', $post->id) }}">Yorum yaz</a> <br>
				{{ $post->gender }} | 
				
				@if($post->member == 1)
					<a href="{{ URL::action('show.profile', $post->username) }}">{{ $post->username }}</a>
				@else 
					{{ $post->username }}
				@endif
				
				@if(Sentry::check())
					@if(Likes::where('post_id', $post->id)->where('user_id', Sentry::getUser()->id)->count()>0)
						{{ 'ok' }}
					@else
						{{ Form::open(array('action' => 'LikesController@Like')) }}
						
						{{ Form::hidden('user_id', Sentry::getUser()->id) }}
						{{ Form::hidden('post_id', $post->id) }}

						{{ Form::submit('like') }}

						{{ Form::close() }}
					@endif
				@else
					@if(Likes::where('post_id', $post->id)->where('user_id', $_SERVER['REMOTE_ADDR'])->count()>0)
						{{ 'ok' }}
					@else
						{{ Form::open(array('action' => 'LikesController@GuestLike')) }}

						{{ Form::hidden('post_id', $post->id) }}
						
						{{ Form::submit('like') }}

						{{ Form::close() }}
					@endif
				@endif
			</p>
			<hr>
		@endif

		@if($post->type == '1')
			{{ 'Etkinlik' }} | <a href="{{ URL::action('show.organization', $post->id) }}">Yorum yaz</a>
		@endif
	@endforeach
@stop
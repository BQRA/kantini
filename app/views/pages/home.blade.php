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
					<a href="{{ URL::action('show.profile', $post->username) }}">{{ $post->username }}</a> |
				@else 
					{{ $post->username }} |
				@endif
				{{ $post->created_at }}
			</p>
		@endif

		@if($post->type == '1')
			{{ 'Etkinlik' }} | <a href="{{ URL::action('show.organization', $post->id) }}">Yorum yaz</a>
		@endif
	@endforeach
@stop
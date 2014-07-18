@extends('layouts.master')

@section('content')
	<div class='row'>
		<div class='col-md-6'>

		@if (Session::has('comment-message'))
			<div class="alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('comment-message') }}
			</div>
		@endif
			
		<div class="all_posts" style="height:80px;">
			<p>{{ $post->post }}</p>
				@if($post->gender === 'male')
				<span class="glyphicon glyphicon-star"></span>
				@else
				<span class="glyphicon glyphicon-star-empty"></span>
				@endif

				@if($post->member === 1)
				<b><a href="{{ URL::action('show-profile', $post->username) }}">{{ $post->username }}</a></b> 
				@else 
				{{ $post->username }}
				@endif
		</div>
		
		<hr>
						
		@foreach($comments as $comment)
			<li>{{ $comment->comment_username }} || {{$comment->user->gender }} || {{ $comment->user->profile->last_name }}</li>
			<p>{{ $comment->comment }} </p>
		@endforeach
			
				@if(Sentry::check())

					{{ Form::open(['action' => 'PostController@sendComment', 'class' => 'form-horizontal']) }}
					
					{{ Form::hidden('post_id', $post->id) }}
					
					<div class="form-group">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					{{ Form::textarea('comment', null, ['size' => '30x5', 'class' => 'form-control']) }}
						<p class="text-danger">
							@if($errors->has('comment'))
					    	{{ $errors->first('comment') }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
					{{ Form::submit('Gönder!', ['class' => 'btn btn-primary']) }}
					</div>
				<div class="form-group">

					{{ Form::close() }}
				@else
					<p>Yorum yapabilmek için <a href='{{ URL::route("user-register") }}'>KAYIT</a> olmanız ya da <a href='{{ URL::route("user-login") }}'>ÜYE GİRİŞ</a>i yapmış olanız gerekmektedir.</p>
				@endif
		</div>
	</div>
@stop
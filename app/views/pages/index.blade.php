@extends('layouts.master')

@section('content')
<div class="row">
	@include('layouts.index-errors')
	<div class="col-md-8">
		<a href="{{ URL::action('male-posts') }}">Erkekler</a>
		<a href="{{ URL::action('female-posts') }}">Kızlar</a>

		<fieldset>
			<legend>Dedikodla!</legend>
				{{ Form::open(['action' => 'PostController@sendPost', 'class' => 'form-horizontal']) }}
				@if(! Sentry::check())
					<div class="form-group">
					{{ Form::label('username', 'Rumuz', ['class' => 'col-md-1 control-label']) }}
						<div class="col-md-5">
						{{ Form::input('text', 'username', null, ['class' => 'form-control', 'placeholder' => 'Rumuz']) }}
							<p class="text-danger">
								@if($errors->has('username'))
						    	{{ $errors->first("username") }}
								@endif
							</p>
						</div>
					</div>
					
					<div class="form-group">
					{{ Form::label('gender', 'Cinsiyet', ['class' => 'col-md-1 control-label'])}}
						<div class="col-md-5">
						{{ Form::select('gender', [null => 'Seç', 'male' => 'Erkek', 'female' => 'Kız'], null, ['class' => 'form-control']) }}
							<p class="text-danger">
									@if($errors->has('gender'))
							    	{{ $errors->first("gender") }}
									@endif
								</p>
							</div>
					</div>
					{{ Form::hidden('member', 0) }}
				@endif
		
				@if(Sentry::check())
				{{ Form::hidden('username', Sentry::getUser()->username) }}
				{{ Form::hidden('gender', Sentry::getUser()->gender) }}
				{{ Form::hidden('member', 1) }}
				@endif
				
				<div class="form-group">
				{{ Form::label('post', 'Gönderi', ['class' => 'col-md-1 control-label'])}}
					<div class="col-md-5">
					{{ Form::textarea('post', null, ['size' => '30x5', 'class' => 'form-control']) }}
						<p class="text-danger">
							@if($errors->has('post'))
					    	{{ $errors->first("post") }}
							@endif
						</p>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 col-md-offset-1">
					{{ Form::submit('Gönder!', ['class' => 'btn btn-primary']) }}
					</div>
				<div class="form-group">
				{{ Form::close() }}
			<br>
		</fieldset>

			<div class="row">
				<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
					@foreach($posts as $post)
						<div class="all_posts" style="height:100px;">
							<p>{{ $post->post }}</p>
								@if($post->gender === 'male')
									<span class="glyphicon glyphicon-star"></span>
								@else
									<span class="glyphicon glyphicon-star-empty"></span>
								@endif

								@if($post->member == 1)
								<b><a href="{{ URL::action('show-profile', $post->username) }}">{{ $post->username }}</a> - </b> 
								@else 
								{{ $post->username }} - 
								@endif
							<a href="{{ URL::action('post/{id}', $post->id) }}">Yorum yaz</a> | 
							(<?php 

							$post_id = $post->id;
							$comments = Comment::where('post_id', '=', $post_id )->get();
							$comment_post_count = $comments->count();
							echo $comment_post_count;

							?>) | Like | {{ $post->created_at }}
						</div>
					@endforeach
				</div>
			</div>
	</div><!--col-md-4 end -->

	<!--Anasayfa profil kısmı -->
	@if(Sentry::check())
		<div class="col-md-4">
			Merhaba <b>{{ Sentry::getUser()->username }} - <a href="{{ URL::to('user/'.Sentry::getUser()->username).'/edit' }}">Düzenle</a> - <a href="{{ URL::route('user-logout') }}">Çıkış</a></b><br>
				<?php $user = Sentry::findUserByID(Sentry::getUser()->id); ?>
			@if($user->hasAccess('admin'))
			<a href="{{ URL::route('admin-all-posts') }}">Admin</a>
			@endif<br><br>
			
			<b>Yorum:</b>
			@if($comments_all->count() == 0)
			<b>Yorum yok</b> <br>
			@else
			<a href="{{ URL::action('users-all-comments', Sentry::getUser()->username) }}">{{ $comments_all->count() }}</a><br>
			@endif
			
			<b>Gönderi:</b>
			@if($posts_all->count() == 0)
			<b>Gönderi yok</b> <br>
			@else
			<a href="{{ URL::action('users-all-posts', Sentry::getUser()->username) }}">{{ $posts_all->count() }}</a><br>
			@endif

			<b>Etkinlik:</b>
			@if($organizations_all->count() == 0)
			<b>Etkinlik yok</b> <br>
			@else
			<a href="{{ URL::action('users-all-organizations', Sentry::getUser()->username) }}">{{ $organizations_all->count() }}
			</a><br>
			@endif
		</div>
	@else
		<div class="col-md-4">
			<p>Merhaba ziyaretçi</p>
		</div>
	@endif
	<!--Anasayfa profil kısmı -->
</div><!--row end -->
@stop
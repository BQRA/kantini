@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yazdığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($users_all_posts as $post)
	<?php
		$dummy 		= $post;
		$post_id 	= $dummy->id;
	 	$comments 	= Comment::where('post_id', '=', $post_id)->get();
	 	$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
	 ?>
		<div class="dedikod {{$dummy->gender}}">
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
			
			@include('partial.toolbar')

			<div class="clear"></div>
			<div class="load-comments"></div>
		</div>
	@endforeach
</div>
	@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $users_all_posts->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $users_all_posts->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $users_all_posts->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $users_all_posts->links() }}
	@endif
@stop

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
	 	$comments 	= Comment::where('post_id', $post_id)->get();
	 	$up 		= up($post_id);
		$down 		= down($post_id);
	 ?>
		<div class="dedikod {{$dummy->gender}}">
			@include('partial.avatar')

			<div class="content">
				@include('partial.dummy')
			</div>

			@include('partial.toolbar')

			<div class="clear"></div>
			<div class="load-comments">
				<div class="comments loading"><i></i></div>
			</div>
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

@extends('layouts.master')

@section('content')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($posts as $post)
	<?php
		$dummy 		= $post;
		$post_id 	= $dummy->id;
		$user 		= User::whereUsername($dummy->username)->first(); 
		$comments 	= Comment::where('post_id', $post_id)->get();
		$up 		= Up::where('post_id', $post_id)->get();
		$down 		= Down::where('post_id', $post_id)->get();
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
	{{ $posts->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $posts->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $posts->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $posts->links() }}
	@endif
@stop

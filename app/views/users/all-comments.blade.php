@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yorum yaptığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($users_all_comments as $post)
	<?php
		$dummy 		= $post->post;
		$post_id 	= $dummy->id;
		//$user artık gönderi yapan kişinin bilgilerini çekiyor.
		$user 		= User::whereUsername($dummy->username)->first(); 
		$comments 	= Comment::where('post_id', '=', $post_id)->get();
		$up 		= Up::where('post_id', '=', $post_id)->get();
		$down 		= Down::where('post_id', '=', $post_id)->get();
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
	{{ $users_all_comments->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $users_all_comments->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $users_all_comments->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $users_all_comments->links() }}
	@endif
@stop

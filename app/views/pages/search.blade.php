@extends('layouts.master')

@section('content')
	@if($posts->count())
		<div class="special-list-title">
			aranan <strong><?php echo $_GET['q'] ?></strong> kelimesi ile ilgili bulunan <strong>{{$count->count()}}</strong> sonuç gösteriliyor.
		</div>
		
		@include('partial.filter-bar')
		
		<div class="dedikods">
		@foreach($posts as $post)
		<?php
			$dummy 		= $post;
			$post_id 	= $dummy->id;
			$user 		= User::whereUsername($dummy->username)->first();
		?>
		
		<div class="dedikod {{ $dummy->gender }}">
			@include('partial.avatar')

			<div class="content">
				@include('partial.dummy')
			</div>

			@include('partial.toolbar')
			
			<div class="clear"></div>

			<div class="load-comments"></div>
		</div>
		@endforeach
		</div>
	@else
		<div class="blank-page">
			<h2>Sonuç bununamadı...</h2>
			<p class="text-center">Arama kelimenizi kısaltıp sonuç yelpazenizi genisletebilirsiniz.</p>
		</div>
	@endif

	@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $posts->appends(['q' => $_GET['q'], 'type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $posts->appends(['q' => $_GET['q'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $posts->appends(['q' => $_GET['q'], 'type' => $_GET['type']])->links() }}

	@else
	{{ $posts->appends(['q' => $_GET['q']])->links() }}
	@endif
@stop

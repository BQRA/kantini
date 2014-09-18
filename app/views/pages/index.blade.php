@extends('layouts.master')

@section('content')

@if($posts->count() > 0)

	@include('partial.filter-bar')

	<div class="dedikods">
		@foreach($posts as $post)
		<?php 
			$user = User::whereUsername($post->username)->first();
			$uni  = School::select('school_name', 'school_fullname')->where('school_name', $post->school)->first();
		?>			
			@include('partial.dedikod')
		@endforeach
	</div>
@else 
	<div class="blank-page">
		<h2>Üzgünüz...</h2>
		<p class="text-center">Bu okul kantini’nde hiç Dedikod yoktur.</p>
		<h2 class="text-center">Neden ilk Dedikod'u sen gönder miyorsun?</h2> 
	</div>
@endif

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

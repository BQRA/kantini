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
				$user = User::whereUsername($post->username)->first();
				$uni  = School::select('school_name', 'school_fullname')->where('school_name', $post->school)->first();
			?>
			@include('partial.dedikod')
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

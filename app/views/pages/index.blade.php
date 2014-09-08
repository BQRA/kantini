@extends('layouts.master')

@section('content')
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

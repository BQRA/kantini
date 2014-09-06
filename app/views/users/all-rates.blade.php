@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') oyladığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($users_all_votes as $post)
	<?php
		$dummy 		= $post;
		$post_id 	= $dummy->id;
		$user 		= User::whereUsername($dummy->username)->first(); 
	?>
	@include('partial.dedikod')
	@endforeach
</div>
	@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $users_all_votes->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $users_all_votes->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $users_all_votes->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $users_all_votes->links() }}
	@endif
@stop

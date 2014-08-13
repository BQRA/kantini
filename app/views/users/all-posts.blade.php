@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yazdığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($posts_all as $post)
	<?php $dummy = $post; ?>
	@include('partial.users-dedikods')
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
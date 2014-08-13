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
{{ $posts_all->links() }}
@stop
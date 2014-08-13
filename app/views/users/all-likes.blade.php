@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') beğendiği @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($likes as $like)
	<?php $dummy = $like->post; ?>
	@include('partial.users-dedikods')
	@endforeach
</div>
@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $likes->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $likes->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $likes->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $likes->links() }}
	@endif
@stop

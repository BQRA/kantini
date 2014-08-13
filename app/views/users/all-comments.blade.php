@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yorum yaptığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($comments as $comment)
	<?php $dummy = $comment->post; ?>
	@include('partial.users-dedikods')
	@endforeach
</div>
@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $comments->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $comments->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $comments->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $comments->links() }}
	@endif
@stop

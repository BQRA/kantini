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
{{ $comments->links() }}
@stop

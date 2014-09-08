@extends('layouts.master')

@section('content')
{{-- select box'in icine gelecek metin --}}
@section('select-box-selected') yorum yaptığı @stop
{{-- select box'in icine gelecek metin #end --}}
@include('partial.special-list-title')
@include('partial.filter-bar')

<div class="dedikods">
	@foreach($users_all_comments as $post)
		<?php $uni  = School::select('school_name', 'school_fullname')->where('school_name', $post->school)->first(); ?>
		@include('partial.dedikod')
	@endforeach
</div>

	@if(isset($_GET['type']) && isset($_GET['orderBy']))
	{{ $users_all_comments->appends(['type' => $_GET['type'], 'orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['orderBy']))
	{{ $users_all_comments->appends(['orderBy' => $_GET['orderBy']])->links() }}

	@elseif(isset($_GET['type']))
	{{ $users_all_comments->appends(['type' => $_GET['type']])->links() }}

	@else
	{{ $users_all_comments->links() }}
	@endif
@stop

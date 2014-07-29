@extends('layouts.master')

@section('content')
@include('partial.special-list-title')

<div class="dedikods">
	@foreach($comments_all as $comments)
		<li>{{ $comments->post->post }} => <a href="{{ URL::action('show.post', $comments->post->id) }}">Oku</a></li>
	@endforeach
</div>


	
@stop
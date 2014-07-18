@extends('layouts.master')

@section('content')
@include('pages.admin.admin-nav')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Yorum Yapan</th>
				<th>Post</th>
				<th>Yorum</th>
				<th>Tarih</th>
				<th>Aksiyon</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_all_comments as $a)
				<tr>
					<td>{{$a->id}}</td>
					<td><a href="{{ URL::action('show-profile', $a->comment_username) }}">{{$a->comment_username}}</a></td>
					<td><a href="{{ URL::action('post/{id}', $a->post_id) }}">{{$a->post_id}}</a></td>
					<td>{{$a->comment}}</td>
					<td>{{$a->created_at}}</td>
					<td>{{ HTML::linkAction('AdminController@AdminDeleteComment', 'Sil', [$a->id]) }} - düzenle</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
@extends('layouts.master')

@section('content')
@include('pages.admin.admin-nav')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Gönderen</th>
				<th>Post</th>
				<th>Tarih</th>
				<th>Aksiyon</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_all_posts as $a)
				<tr>
					<td>{{$a->id}}</td>
					<td><a href="{{ URL::action('show-profile', $a->username) }}">{{$a->username}}</a></td>
					<td><a href="{{ URL::action('post/{id}', $a->id) }}">{{$a->post}}</a></td>
					<td>{{$a->created_at}}</td>
					<td>{{ HTML::linkAction('AdminController@AdminDeletePost', 'Sil', [$a->id]) }} - düzenle</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
@extends('layouts.master')

@section('content')
@include('pages.admin.admin-nav')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Ad - Soyad</th>
				<th>Eposta</th>
				<th>Konu</th>
				<th>Mesaj</th>
				<th>Tarih</th>
				<th>Aksiyon</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_all_messages as $a)
				<tr>
					<td>{{$a->id}}</td>
					<td>{{$a->fullname}}</td>
					<td>{{$a->email}}</td>
					<td>{{$a->subject}}</td>
					<td>{{$a->message}}</td>
					<td>{{$a->created_at}}</td>
					<td>{{ HTML::linkAction('AdminController@AdminDeleteMessage', 'Sil', [$a->id]) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
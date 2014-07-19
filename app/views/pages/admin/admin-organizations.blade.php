@extends('layouts.master')

@section('content')
@include('pages.admin.admin-nav')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Organizatör</th>
				<th>Org Ad</th>
				<th>Tarih</th>
				<th>Mekan</th>
				<th>Yetkili</th>
				<th>Yetkili Tel</th>
				<th>Fiyat</th>
				<th>Açıklama</th>
				<th>Aksiyon</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_all_organizations as $a)
				<tr>
					<td>{{$a->id}}</td>
					<td><a href="{{ URL::action('show-profile', $a->creator_username) }}">{{$a->creator_username}}</td>
					<td><a href="{{ URL::action('show-organization', $a->id) }}">{{$a->name}}</a></td>
					<td>{{$a->organization_date}}</td>
					<td>{{$a->place}}</td>
					<td>{{$a->auth}}</td>
					<td>{{$a->auth_contact}}</td>
					<td>{{$a->price}}</td>
					<td>{{$a->message}}</td>
					<td>{{ HTML::linkAction('AdminController@AdminDeleteOrganization', 'Sil', [$a->id]) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
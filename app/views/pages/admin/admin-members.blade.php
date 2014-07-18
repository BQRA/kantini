@extends('layouts.master')

@section('content')
@include('pages.admin.admin-nav')
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kullanıcı Adı</th>
				<th>Eposta</th>
				<th>Okul</th>
				<th>Cinsiyet</th>
				<th>Ad - Soyad</th>
				<th>Twitter</th>
				<th>Instagram</th>
				<th>Bio</th>
				<th>Aksiyon</th>
			</tr>
		</thead>
		<tbody>
			@foreach($admin_all_members as $a)
				<tr>
					<td>{{$a->id}}</td>
					<td><a href="{{ URL::action('show-profile', $a->username) }}">{{$a->username}}</a></td>
					<td>{{$a->email}}</td>
					<td>{{$a->school}}</td>
					<td>{{$a->gender}}</td>
					<td>{{$a->profile->first_name}} {{$a->profile->last_name}}</td>
					<td>{{$a->profile->twitter_username}}</td>
					<td>{{$a->profile->instagram_username}}</td>
					<td>{{$a->profile->bio}}</td>
					<td>
					{{ HTML::linkAction('AdminController@AdminDeleteMember', 'Sil', [$a->id]) }} - Düzenle -
					{{ HTML::linkAction('AdminController@AdminBanMember', 'Ban', [$a->id]) }}
					{{ HTML::linkAction('AdminController@AdminUnBanMember', 'unBan', [$a->id]) }}

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
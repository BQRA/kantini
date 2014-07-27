@extends('layouts.master')

@section('content')
	<p>Profil Düzenle</p>

	{{ Form::model($user->profile, array('action' => array('UsersController@UpdateProfile', $user->username),'files' => true)) }}
	
	{{ Form::label('full_name', 'Ad') }}
	{{ Form::Input('text', 'full_name') }} <br>

	{{ Form::label('twitter_username', 'Twitter') }}
	{{ Form::Input('text', 'twitter_username') }} <br>

	{{ Form::label('instagram_username', 'Instagram') }}
	{{ Form::Input('text', 'instagram_username') }} <br>

	{{ Form::label('facebook_username', 'Facebook') }}
	{{ Form::Input('text', 'facebook_username') }} <br>

	{{ Form::file('image') }} <br>
	
	{{ Form::submit() }}

	{{ Form::close() }}
@stop
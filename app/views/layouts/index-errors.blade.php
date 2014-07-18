@if (Session::has('message'))
	<div class='alert alert-success fade in'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		{{ Session::get('message') }}
	</div>
@endif

@if (Session::has('message-auth'))
	<div class='alert alert-warning fade in'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		{{ Session::get('message-auth') }}
	</div>
@endif

@if (Session::has('message-edit-profile'))
	<div class='alert alert-danger fade in'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		{{ Session::get('message-edit-profile') }}
	</div>
@endif

@if (Session::has('message-3'))
	<div class='alert alert-danger fade in'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		{{ Session::get('message-3') }}
	</div>
@endif

@if (Session::has('message-4'))
	<div class='alert alert-danger fade in'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		{{ Session::get('message-4') }}
	</div>
@endif
@extends('admin.base')

@section('adminContent')
	<div id="no-padding-container">
		<div class="admin-info">
			<h2>Gebruikers</h2>
			<a href="{{ route('users.create') }}" class="button-blue">Maak</a>
		</div>
		<div class="admin-users">
			@foreach ($users as $user)
				<div>
					<a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a>
				</div>
			@endforeach
		</div>
	</div>
@endsection
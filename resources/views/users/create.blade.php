@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Registreer gebruiker</h2>
		<form action="{{ route('users.admin') }}" class="form-regular" method="POST">
			@csrf
			<label for="name">Naam</label>
			<input
				id="name"
				type="text"
				class="@error('name') input-danger @enderror"
				name="name"
				value="{{ old('name') }}"
				autofocus
			>
			@error('name')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="email">Email</label>
			<input
				id="email"
				type="email"
				class="@error('email') input-danger @enderror"
				name="email"
				value="{{ old('email') }}"
			>
			@error('email')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="password">Wachtwoord</label>
			<input
				id="password"
				type="password"
				class="@error('password') input-danger @enderror"
				name="password"
			>
			@error('password')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Registreer" class="button-blue">
		</form>
	</div>
@endsection
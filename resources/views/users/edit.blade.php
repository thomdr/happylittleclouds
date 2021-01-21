@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Bewerk gebruiker</h2>
		<form action="{{ route('users.delete', $user) }}" method="POST" class="form-delete">
			@csrf
			@method('DELETE')
			<input type="submit" value="Verwijder" class="button-red">
		</form>
		<form action="{{ route('users.update', $user) }}" class="form-regular" method="POST">
			@csrf
			@method('PUT')
			<label for="name">Naam</label>
			<input
				id="name"
				type="text"
				class="@error('name') input-danger @enderror"
				name="name"
				value="{{ old('name') ?? $user->name }}"
				autofocus
			>
			@error('name')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Bewerk" class="button-blue">
		</form>
	</div>
@endsection
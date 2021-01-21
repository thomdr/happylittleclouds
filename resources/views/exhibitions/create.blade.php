@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Maak tentoonstelling</h2>
		<form action="{{ route('exhibitions.admin') }}" class="form-regular" method="POST">
			@csrf
			<label for="name">Naam</label>
			<input
				class="@error('name') input-danger @enderror"
				type="text"
				name="name"
				id="name"
				value="{{ old('name') }}"
			>
			@error('name')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="ckeditor-textarea">Beschrijving</label>
			<textarea
				class="@error('description') input-danger @enderror"
				name="description"
				id="ckeditor-textarea"
			>{{ old('description') }}</textarea>
			@error('description')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="date">Datum</label>
			<input
				class="@error('date') input-danger @enderror"
				type="month"
				name="date"
				id="date"
				value="{{ old('date') }}"
			>
			@error('date')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Maak" class="button-blue">
		</form>
	</div>
	@include('admin.ckeditor')
@endsection
@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Bewerk tentoonstelling</h2>
		<form action="{{ route('exhibitions.delete', $exhibition) }}" method="POST" class="form-delete">
			@csrf
			@method('DELETE')
			<input type="submit" value="Verwijder" class="button-red">
		</form>
		<form action="{{ route('exhibitions.update', $exhibition) }}" class="form-regular" method="POST">
			@csrf
			@method('PUT')
			<label for="name">Naam</label>
			<input
				class="@error('name') input-danger @enderror"
				type="text"
				name="name"
				id="name"
				value="{{ old('name') ?? $exhibition->name }}"
			>
			@error('name')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="ckeditor-textarea">Beschrijving</label>
			<textarea
				class="@error('description') input-danger @enderror"
				name="description"
				id="ckeditor-textarea"
			>{{ old('description') ?? $exhibition->description }}</textarea>
			@error('description')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="date">Datum</label>
			<input
				class="@error('date') input-danger @enderror"
				type="month"
				name="date"
				id="date"
				value="{{ old('date') ?? $exhibition->date }}"
			>
			@error('date')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Bewerk" class="button-blue">
		</form>
	</div>
	@include('admin.ckeditor')
@endsection
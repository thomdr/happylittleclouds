@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Bewerk meesterwerk</h2>
		<form action="{{ route('masterworks.delete', $masterwork) }}" method="POST" class="form-delete">
			@csrf
			@method('DELETE')
			<input type="submit" value="Verwijder" class="button-red">
		</form>
		<form action="{{ route('masterworks.update', $masterwork) }}" class="form-regular" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<label for="name">Naam</label>
			<input
				class="@error('name') input-danger @enderror"
				type="text"
				name="name"
				id="name"
				value="{{ old('name') ?? $masterwork->name }}"
			>
			@error('name')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="image">Afbeelding</label>
			<label for="image" class="button-blue">Upload</label>
			<input
				class="preview-input"
				type="file"
				name="image"
				id="image"
			>
			<img src="{{ asset($masterwork->image) }}" class="preview-img">
			@error('image')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Bewerk" class="button-blue">
		</form>
	</div>
@endsection
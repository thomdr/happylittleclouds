@extends('admin.base')

@section('adminContent')
	<div id="container">
		<h2>Maak meesterwerk</h2>
		<form action="{{ route('masterworks.admin') }}" class="form-regular" method="POST" enctype="multipart/form-data">
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
			<label for="image">Afbeelding</label>
			<label for="image" class="button-blue">Upload</label>
			<input
				class="preview-input"
				type="file"
				name="image"
				id="image"
			>
			<img src="" class="hidden preview-img">
			@error('image')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Maak" class="button-blue">
		</form>
	</div>
@endsection
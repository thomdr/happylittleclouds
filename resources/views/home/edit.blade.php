@extends('admin.base')

@section('adminContent')
	<div id="container" class="admin-home">
		<form action="{{ route('home.update') }}" class="form-regular" method="POST">
			@csrf
			@method('PUT')
			<label for="ckeditor-textarea">Inhoud</label>
			<textarea
				class="@error('content') input-danger @enderror"
				name="content"
				id="ckeditor-textarea"
			>{{ old('content') ?? $home->content }}</textarea>
			@error('content')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Bewerk" class="button-blue">
		</form>
	</div>
	@include('admin.ckeditor')
@endsection
@extends('admin.base')

@section('adminContent')
	<div id="container" class="admin-contact">
		<form action="{{ route('contact.update') }}" class="form-regular" method="POST">
			@csrf
			@method('PUT')
			<label for="ckeditor-textarea">Inhoud</label>
			<textarea
				class="@error('content') input-danger @enderror"
				name="content"
				id="ckeditor-textarea"
			>{{ old('content') ?? $contact->content }}</textarea>
			@error('content')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="email">Email</label>
			<input
				class="@error('email') input-danger @enderror"
				type="text"
				name="email"
				id="email"
				value="{{ old('email') ?? $email->content }}"
			>
			@error('email')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" value="Bewerk" class="button-blue">
		</form>
	</div>
	@include('admin.ckeditor')
@endsection
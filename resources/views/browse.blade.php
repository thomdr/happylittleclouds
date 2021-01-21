<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway&display=swap" rel="stylesheet">
	<title>Browse | Happy Little Clouds</title>
</head>
<body>
	<div class="browse">
		@if (empty($images))
			<h3>Er zijn geen afbeeldingen beschikbaar.</h3>
		@endif
		@foreach ($images as $image)
			<div>
				<img src="{{ asset($image) }}">
				<form action="{{ route('ckeditor.delete') }}" method="POST" class="form-delete">
					@csrf
					@method('DELETE')
					<input type="hidden" name="image" value="{{ $image }}">
					<input type="hidden" name="CKEditor" value="{{ request()->CKEditor }}">
					<input type="hidden" name="CKEditorFuncNum" value="{{ request()->CKEditorFuncNum }}">
					<input type="hidden" name="langCode" value="{{ request()->langCode }}">
					<input type="submit" value="Verwijder" class="button-red">
				</form>
			</div>
		@endforeach
	</div>
</body>
<script>
	const images = document.getElementsByTagName('img');
	for(let img of images) {
		img.addEventListener('click', () => returnFileUrl(img.src));
	}
	// Yoinked from CKEditor docs
	function getUrlParam(paramName) {
		const reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
		const match = window.location.search.match( reParam );
		return ( match && match.length > 1 ) ? match[1] : null
	}
	function returnFileUrl(src) {
		const funcNum = getUrlParam('CKEditorFuncNum');
		if(funcNum === null) return;
		window.opener.CKEDITOR.tools.callFunction(funcNum, src, function() {
			const dialog = this.getDialog();
		});
		window.close();
	}
</script>
</html>
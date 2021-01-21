@extends ('base')

@section('title') Contact @endsection

@section('head')
	<link rel="stylesheet" href="/leaflet/leaflet.css">
	<script src="/leaflet/leaflet.js"></script>
@endsection

@section('content')
	<div id="no-width-container" class="contact">
		<div class="custom-text">
			{!! $contact->content !!}
		</div>
		<form method="POST" action="{{ route('contact.mail') }}" class="form-center">
			@csrf
			@if (session('send'))
				<p class="success send">{{ session('send') }}</p>
			@endif
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
			<label for="email">E-mail</label>
			<input
				class="@error('email') input-danger @enderror"
				type="text"
				name="email"
				id="email"
				value="{{ old('email') }}"
			>
			@error('email')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="message">Bericht</label>
			<textarea
				class="@error('message') input-danger @enderror"
				name="message"
				id="message"
			>{{ old('message') }}</textarea>
			@error('message')
				<p class="danger">{{ $message }}</p>
			@enderror
			<input type="submit" name="submitMessage" value="Verstuur" class="button-blue">
		</form>
		<div id="map"></div>
		<script>
			var mymap = L.map('map').setView([51.476519, 5.4864203], 13);
			L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1,
				accessToken: 'pk.eyJ1IjoibGVnYXNreXRlIiwiYSI6ImNrNTZrN3hsMzA0ODQzbG1pMXkwc2tldnkifQ.i5snW4xIzY7coEoy2ataqg'
			}).addTo(mymap);
			var marker = L.marker([51.476519, 5.4864203]).addTo(mymap);
		</script>
	</div>
@endsection
@extends('admin.base')

@section('adminContent')
	<div id="no-padding-container">
		<div class="admin-info">
			<h2>Meesterwerken</h2>
			<a href="{{ route('masterworks.create') }}" class="button-blue">Maak</a>
		</div>
		<div class="admin-masterworks">
			@foreach ($masterworks as $work)
				<div>
					<a href="{{ route('masterworks.edit', $work) }}">
						<img src="{{ asset($work->image) }}" alt="{{ $work->name }}">
					</a>
					<p>{{ $work->name }}</p>
				</div>
			@endforeach
		</div>
	</div>
@endsection
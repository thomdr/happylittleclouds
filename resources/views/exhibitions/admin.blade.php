@extends('admin.base')

@section('adminContent')
	<div id="no-padding-container">
		<div class="admin-info">
			<h2>{{ __('generic.admin.exhibition.title') }}</h2>
			<p>{{ __('generic.admin.exhibition.description') }}</p>
			<a href="{{ route('exhibitions.create') }}" class="button-blue">{{ __('generic.buttons.create') }}</a>
		</div>
		<div class="admin-exhibitions">
			<div class="calender">
				@foreach ($exhibitions as $key => $exhb)
					<a href="{{ route('exhibitions.edit', $exhb) }}">
						<span>{{ __('month.'.$exhb->month()) }}, {{ $exhb->year() }}</span>
						<span>{{ $exhb->name }}</span>
					</a>
				@endforeach
			</div>
		</div>
	</div>
@endsection
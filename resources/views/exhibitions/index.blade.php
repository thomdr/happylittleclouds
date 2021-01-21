@extends('base')

@section('title') Tentoonstellingen @endsection

@section('content')
	<div class="description">
		<h2>Opkomende Tentoonstellingen</h2>
		<p>Sem viverra aliquet eget sit amet tellus cras adipiscing. Volutpat lacus laoreet non curabitur gravida arcu ac. Diam maecenas sed enim ut sem viverra aliquet eget. Blandit cursus risus at ultrices mi tempus imperdiet. Pharetra vel turpis nunc eget lorem. Quam adipiscing vitae proin sagittis nisl rhoncus mattis. Non consectetur a erat nam at lectus urna duis convallis. Senectus et netus et malesuada. Erat imperdiet sed euismod nisi porta lorem mollis aliquam ut. Quisque sagittis purus sit amet volutpat consequat mauris. Iaculis nunc sed augue lacus viverra. Auctor urna nunc id cursus metus aliquam. Dolor sit amet consectetur adipiscing elit duis tristique sollicitudin. Nec nam aliquam sem et. Ut tellus elementum sagittis vitae et leo duis ut diam. Scelerisque viverra mauris in aliquam sem fringilla. Scelerisque eu ultrices vitae auctor eu augue ut lectus arcu. In est ante in nibh. Dui vivamus arcu felis bibendum ut tristique et.</p>
	</div>
	<div id="no-padding-container">
		<div class="exhibitions">
			<div class="calender">
				@foreach ($exhibitions as $key => $exhb)
					{{-- Skip exhibitions from the past --}}
					@if (intval($exhb->year()) < date('Y') || (intval($exhb->month()) < date('m') && $exhb->year() == date('Y')))
						@php
							unset($exhibitions[$key])
						@endphp
						@continue
					@endif
					<a href="{{ route('exhibitions.show', $exhb) }}">
						<span>{{ __('month.'.$exhb->month()) }}, {{ $exhb->year() }}</span>
						<span>{{ $exhb->name }}</span>
					</a>
				@endforeach
			</div>
			<div class="information">
				@php
					$exhibition ??= $exhibitions->first();
				@endphp
				<h2>{{ $exhibition->name }}</h2>
				<div class="custom-text">
					{!! $exhibition->description !!}
				</div>
			</div>
		</div>
	</div>
@endsection
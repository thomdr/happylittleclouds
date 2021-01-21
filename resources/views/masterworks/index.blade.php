@extends('base')

@section('title') Meesterwerken @endsection

@section('head')
	<script src="/glightbox/js/glightbox.js"></script>
	<link rel="stylesheet" href="/glightbox/css/glightbox.css">
@endsection

@section('content')
	<div class="description">
		<h2>Meesterwerken van Bob Ross</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Volutpat odio facilisis mauris sit. At tempor commodo ullamcorper a. Ut diam quam nulla porttitor massa id neque. Vitae congue eu consequat ac. Auctor neque vitae tempus quam pellentesque. Augue neque gravida in fermentum et. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi. Nulla at volutpat diam ut venenatis tellus in metus vulputate. Et leo duis ut diam.</p>
	</div>
	<div id="no-padding-container">
		<div class="masterworks">
			@foreach ($masterworks as $work)
				<div>
					<a href="{{ asset($work->image) }}" class="glightbox" data-title="{{ $work->name }}">
						<img src="{{ asset($work->image) }}" alt="{{ $work->name }}">
					</a>
					<p>{{$work->name}}</p>
				</div>
			@endforeach
		</div>
	</div>
	<script>
		const lightbox = GLightbox({
			touchNavigation: true
		});
	</script>
@endsection
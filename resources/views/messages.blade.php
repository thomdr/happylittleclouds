@foreach ($messages as $message)
	@php
		$class = ($message->sender === 'visitor' && $perspective === 'visitor') || ($message->sender === 'employee' && $perspective === 'employee') ? 'right' : 'left'
	@endphp
	<div class="{{ $class }}">
		<p>{{ $message->created_at }}</p>
		<p>{{ $message->message }}</p>
	</div>
@endforeach
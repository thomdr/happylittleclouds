@extends('admin.base')

@section('adminContent')
	<div id="no-padding-container">
		<div class="admin-info">
			<h2>Chat</h2>
			<p>Chatlogs met een rode cirkel bevatten ongelezen berichten.</p>
		</div>
		<div class="admin-chat">
			@foreach ($conversations as $conversation)
				<a href="{{ route('chat.employee.chat', $conversation) }}">
					{{ $conversation->visitor_ip }}
					@if ($conversation->has_new_messages)
						<span>&nbsp;</span>
					@endif
				</a>
			@endforeach
		</div>
	</div>
@endsection
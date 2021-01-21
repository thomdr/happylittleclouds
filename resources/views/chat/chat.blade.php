@extends('admin.base')

@section('adminContent')
	<div id="container">
		<div class="chat-admin">
			<div id="chat">
				<p>Chat</p>
			</div>
			<div id="messages"></div>
			<p id="error" class="danger"></p>
			<div class="send">
				<form method="POST" class="form-regular" id="messageForm">
					<input type="text" name="message" placeholder="Message" id="messageInput">
					<input type="submit" class="button-blue" value="Send">
				</form>
			</div>
		</div>
		<script>
			let hasScrolledToBottom = false;
			let messagesHistory = ''
			// Sending
			$('#messageForm').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					url: "{{ route('chat.employee.send') }}",
					method: 'POST',
					dataType: 'html',
					data: {
						employee_id: "{{ Auth::user()->id }}",
						id: "{{ $conversation->id }}",
						message: $('#messageInput').val(),
						_token: "{{ csrf_token() }}"
					}
				}).done(function(results) {
					if(results) {
						let r = JSON.parse(results)
						if(r.message) {
							$('#error').html(r.message[0]);
							setTimeout(() => {
								$('#error').html('');
							}, 2000)
						}
					}
				});
				$('#messageInput').val('')
				hasScrolledToBottom = false;
				retrieveMessages();
			})
			// Retrieving
			const retrieveMessages = () => {
				$.ajax({
					url: "{{ route('chat.employee.retrieve') }}",
					method: 'POST',
					dataType: 'html',
					data: {
						id: "{{ $conversation->id }}",
						_token: "{{ csrf_token() }}"
					}
				}).done(function (results) {
					$('#messages').html(results);
					let messages = document.getElementById("messages");
					if(messagesHistory != results) {
						messagesHistory = results;
						messages.scrollTop = messages.scrollHeight;
					}
					if(!hasScrolledToBottom) {
						messages.scrollTop = messages.scrollHeight;
						hasScrolledToBottom = true;
					}
				});
			}
			setInterval(retrieveMessages, 2000);
			retrieveMessages();
		</script>
	</div>
@endsection
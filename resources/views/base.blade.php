<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="/js/script.js" defer></script>
	<link rel="stylesheet" href="/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway&display=swap" rel="stylesheet">
	@yield('head')
	<title>@yield('title') | Happy Little Clouds</title>
</head>
<body>
	<div id="background"></div>
	<nav class="top-nav" id="nav">
		<div>
			<h1>Happy Little Clouds</h1>
			<ul class="menu">
				<li class="{{Request::is('/') ? 'active': ''}}">
					<a href="{{ route('home') }}">Home</a>
				</li>
				<li class="{{Request::is('meesterwerken') ? 'active': ''}}">
					<a href="{{ route('masterworks.index') }}">Meesterwerken</a>
				</li>
				<li class="{{Request::is('tentoonstellingen') ? 'active': ''}}">
					<a href="{{ route('exhibitions.index') }}">Tentoonstellingen</a>
				</li>
				<li class="{{Request::is('contact') ? 'active': ''}}">
					<a href="{{ route('contact.index') }}">Contact</a>
				</li>
				@auth
					<li class="{{Request::is('admin') ? 'active': ''}}">
						<a href="{{ route('admin') }}">Admin</a>
					</li>
					<li>
						<a
							href="{{ route('logout') }}"
							onclick="event.preventDefault();document.getElementById('logout-form').submit();"
						>
							Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</li>
				@endauth
			</ul>
			<div id="menu-toggle">
				<span class="toggle-line line-1"></span>
				<span class="toggle-line line-2"></span>
				<span class="toggle-line line-3"></span>
			</div>
		</div>
	</nav>
	<main>
		@yield('content')
	</main>
	@guest
		<div class="chat">
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
			// Opening
			let chatOpen = false;
			$('#chat').on('click', function() {
				this.parentNode.classList[chatOpen ? 'remove' : 'add']('open');
				chatOpen = !chatOpen;
			})
			// Sending
			$('#messageForm').on('submit', function(e) {
				e.preventDefault();
				$.ajax({
					url: "{{ route('chat.visitor.send') }}",
					method: 'POST',
					dataType: 'html',
					data: {
						visitor_ip: "{{ Request::ip() }}",
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
					url: "{{ route('chat.visitor.retrieve') }}",
					method: 'POST',
					dataType: 'html',
					data: {
						visitor_ip: "{{ Request::ip() }}",
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
	@endguest
</body>
</html>

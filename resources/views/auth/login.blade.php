@extends ('base')

@section('title') Login @endsection

@section('content')
	<div id="no-width-container" class="login">
		<h2>Login</h2>
		<form method="POST" class="form-center" action="{{ route('login') }}">
			@csrf
			<label for="email">E-mail</label>
			<input
				type="text"
				name="email"
				id="email"
				class="@error('email') input-danger @enderror"
				value="{{ old('email') }}"
				autocomplete="email"
				autofocus
			>
			@error('email')
				<p class="danger">{{ $message }}</p>
			@enderror
			<label for="password">Wachtwoord</label>
			<input
				type="password"
				name="password"
				id="password"
				class="@error('password') input-danger @enderror"
				autocomplete="current-password"
			>
			@error('password')
				<p class="danger">{{ $message }}</p>
			@enderror
			<div class="checkbox">
				<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
				<label for="remember">Onthoud</label>
			</div>
			<input type="submit" name="submitMessage" value="Login" class="button-blue">
		</form>
	</div>
@endsection

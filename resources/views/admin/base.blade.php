@extends('base')
	
@section('title') Admin @endsection

@section('content')
	<nav class="admin-nav">
		<ul class="menu">
			<li class="{{Request::is('admin') ? 'active': ''}}">
				<a href="{{ route('admin') }}">Admin</a>
			</li>
			<li class="{{Request::is('admin/home') ? 'active': ''}}">
				<a href="{{ route('home.edit') }}">Home</a>
			</li>
			<li class="{{Request::is('admin/meesterwerken') ? 'active': ''}}">
				<a href="{{ route('masterworks.admin') }}">Meesterwerken</a>
			</li>
			<li class="{{Request::is('admin/tentoonstellingen') ? 'active': ''}}">
				<a href="{{ route('exhibitions.admin') }}">Tentoonstellingen</a>
			</li>
			<li class="{{Request::is('admin/contact') ? 'active': ''}}">
				<a href="{{ route('contact.edit') }}">Contact</a>
			</li>
			<li class="{{Request::is('admin/users') ? 'active': ''}}">
				<a href="{{ route('users.admin') }}">Gebruikers</a>
			</li>
			<li class="{{Request::is('admin/chat') ? 'active': ''}}">
				<a href="{{ route('chat.admin') }}">Chats</a>
			</li>
		</ul>
	</nav>
	@yield('adminContent')
@endsection
@extends('base')

@section('title') Home @endsection

@section('content')
	<div id="container" class="custom-text">
		{!! $home->content !!}
	</div>
@endsection
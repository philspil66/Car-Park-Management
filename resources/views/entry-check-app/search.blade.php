
	@extends('layouts.entry-check-app')

	@section('content')

		{{-- search type --}}
		<div class="search--type clearfix">
			<a class="active" href=""><i class="icon-check"></i> Basic</a>
			<a href=""><i class="icon-check"></i> Advanced</a>
		</div>

		{{-- search --}}
		<div class="search">
			<input type="text" name="user_search" id="user_search" placeholder="search..." />
			<a class="status-icon"></a>
			<a class="search-icon"><i class="icon-search"></i></a>
			<a class="clear-icon"><i class="icon-cross"></i></a>
		</div>

		{{-- results --}}
		<div class="results"></div>

		{{-- msg --}}
		<div class="msg"></div>

		{{-- event data --}}
		<div class="event--data">

			<div class="event--data__details"></div>

			<a class="sync-data" href=""><i class="icon-repeat"></i> Sync Data</a>
			<a class="delete-data" href="" style="display: none;">Delete Data</a>
		</div>

		{{-- include Mustache JS templates --}}
		@include('entry-check-app.templates.event-data')
		@include('entry-check-app.templates.result-basic')	
		@include('entry-check-app.templates.result-advanced')	

	@endsection
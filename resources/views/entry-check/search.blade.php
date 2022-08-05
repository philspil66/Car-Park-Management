
	@extends('layouts.entry-check')

	@section('content')

		{{-- action buttons --}}
		<div class="actions clearfix">
			<a id="load_data" href="">Sync Data</a>
			<a id="delete_data" href="" style="display: none;">Delete Data</a>
		</div>

		{{-- event details --}}
		<div class="event--details"></div>

		{{-- search form --}}
		<div class="search-form">
			<form>
				<label>
					Enter <strong>Plate</strong>, 
					<strong>Postcode</strong>, 
                                        <strong>Name</strong> or
					<strong>Order Reference.</strong>
				</label>
				<div class="search-wrapper">
					<input type="text" id="user_search" placeholder="Search..." autocomplete="off" />
					<a class="clear-search" href=""></a>
				</div>
			</form>
		</div>

		{{-- info --}}
		<div class="info"></div>

		{{-- results --}}
		<div class="results"></div>

		{{-- include Mustache JS templates --}}
		@include('entry-check.templates.event-details')
		@include('entry-check.templates.result')

	@endsection





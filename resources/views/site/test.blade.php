
	@extends('layouts.site')

	@section('content')

		@include('site.hero.home',
			array(
				"title" => "Ricoh Arena Parking",
				"subtitle" => "Welcome to the official site for Ricoh Arena Parking, provided by Event Support Team.",
				"link_text" => "Find an Event",
				"link_url" => "/events"
			)
		)

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					<h1>Homepage</h1>

					@foreach($categories as $category)

						<p> {{ $category->lang->description }} </p>

						@foreach($category->events as $event)

							--- {{ $event->lang->title }} {{ $event->date }} <a href="/events/details/{{ $event->id }}">Book Now</a> <br> 

						@endforeach

					@endforeach

				</div>					
			</div>

		</div>

	@endsection
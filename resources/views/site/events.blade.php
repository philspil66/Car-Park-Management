	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Events",
				"description" => "Official event parking at the Ricoh Arena Stadium",
				"keywords" => "Event Parking Ricoh Arena, Ricoh Arena Event Parking, Official Event Parking Ricoh Arena"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

	<div class="content">

		<div class="simplegrid">
			<div class="column column__100">

				<h1>Events</h1>
				
				<p>Please choose an event that you would like to book parking for from the list below.</p>

				@foreach($events as $event)

					@if( $event->teamone['logo'] && $event->teamtwo['logo'])

						<?php
							$team1_logo = explode(".png", $event->teamone['logo']);
							$team2_logo = explode(".png", $event->teamtwo['logo']);
						?>

						{{-- event (team) --}}
						<div class="card card--event">
							<div class="card--event__type">
								<div class="card--event__type__icon {{ $event->category->slug }}"></div>
							</div>
							<div class="card--event__date">
								<i class="icon-calendar"></i> {{ App\Classes\Tools::dateformat($event->date) }}&nbsp;&nbsp;
								<i class="icon-clock2"></i> {{ App\Classes\Tools::timeformat($event->time) }}
							</div>
							<div class="card--event__teams">
								<div class="card--event__team">
									<div class="card--event__team--image">
										<img src="/images/teams/150x150/{{ $team1_logo[0] }}_150x150.png" alt="" />
									</div>
									<div class="card--event__team--text">
										<p>{{ $event->teamone['lang']['name'] }}</p>
									</div>
								</div>
								<div class="card--event__team">
									<div class="card--event__team--image">
										<img src="/images/teams/150x150/{{ $team2_logo[0] }}_150x150.png" alt="" />
									</div>
									<div class="card--event__team--text">
										<p>{{ $event->teamtwo['lang']['name'] }}</p>
									</div>
								</div>						
							</div>
							<div class="card--event__vs">VS</div>
							<div class="card--event__button">
								<a class="button button--small" href="/events/details/{{ $event->id }}">Book Parking</a>
							</div>
						</div>
						{{--end event (team) --}}

					@else

						{{-- event (single) --}}
						<div class="card card--event">
							<div class="card--event__type">
								<div class="card--event__type__icon {{ $event->category->slug }}"></div>
							</div>
							<div class="card--event__date">
								<i class="icon-calendar"></i> {{ App\Classes\Tools::dateformat($event->date) }}&nbsp;&nbsp;
								<i class="icon-clock2"></i> {{ App\Classes\Tools::timeformat($event->time) }}
							</div>
							<div class="card--event__single">
								<p>{{ $event->lang->title }}</p>				
							</div>
							<div class="card--event__button">
								<a class="button button--small" href="/events/details/{{ $event->id }}">Book Parking</a>
							</div>
						</div>
						{{-- end event (single) --}}

					@endif

				@endforeach

			</div>
		</div>

	</div>
			
	@endsection


	<div class="card card--category--events">

		<h3 class="card--category--events__title">{{ $category_name }}</h3>	

		@foreach($category_events as $event)

			<div class="card--category--events__detail">
				<div class="card--category--events__detail--left">
					<p>{{ $event['event_name'] }}</p>
					<p><i class="icon-calendar"></i> {{ $event['event_date'] }}</p>
				</div>
				<div class="card--category--events__detail--right">
					<a class="button button--small" href="{{ $event['event_url'] }}">Book Now</a>
				</div>
			</div>

		@endforeach

		<div class="card--category--events__viewall">
			<a href="/events">View all {{ $category_name }} Events</a>
		</div>

	</div>
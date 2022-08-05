	@extends('layouts.site')

	@section('content')

		@include('site.hero.home',
			array(
				"title" => "Ricoh Arena Official Parking",
				"subtitle" => "Welcome to the official site for Ricoh Arena Parking, provided by Event Support Team.",
				"link_text" => "Find an Event",
				"link_url" => "/events"
			)
		)

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">
					<h1>Find an event</h1>
				</div>
			</div>

			<div class="simplegrid category-row js-category-row">
				
				@foreach($categories as $key => $category)

					<div class="column column__50">
						
						<div class="card--category--events js-category-column">

							<div class="event__type">
								<div class="event__type__icon {{ $category->slug }}"></div>
							</div>

							<div class="event__info">

								@if( $category->lang->description != 'Generic')
									{{--*/ $category_description = $category->lang->description /*--}}
								@else
									{{--*/ $category_description = '' /*--}}
								@endif

								<h2>Upcoming {{ $category_description }} Events</h2>
							
								@foreach($category->eventsOnlyActive as $event)
									<div class="event__info__row">
										<div class="event__info__left">
											<a class="event__name" href="/events/details/{{ $event->id }}">
												{{ $event->lang->title }}
											</a>
											<p class="event__date">
												<i class="icon-calendar"></i> {{ App\Classes\Tools::dateformat($event->date) }}&nbsp;&nbsp;
												<i class="icon-clock2"></i> {{ App\Classes\Tools::timeformat($event->time) }}
											</p>
										</div>
										<div class="event__info__right">
											<a class="button  button--small" href="/events/details/{{ $event->id }}">
												Book Parking
											</a>
										</div>
									</div>
								@endforeach

								<div class="event__view__all">
									<a class="button button--small button--outline" href="/events">
										View all {{ $category_description }} Events
									</a>
								</div>

							</div>
						</div>

					</div>

					{{-- every even number, except if its the last category output a new row element --}}
					@if($key % 2 && $key != (count($categories) - 1) )
						</div><div class="simplegrid category-row js-category-row">
					@endif
					
				@endforeach

				{{-- add extra module if number of categories is odd --}}
				@if( count($categories) % 2 == 1 )
					<div class="column column__50">
					
						<div class="card--alt js-category-column">
							<div class="card--alt__inner">
								<h2>FAQ</h2>
								<p>
								If you have any questions about parking at the Ricoh Arena, 
								please take at look at our FAQ page.
								</p>
								<div class="buttons">
									<a class="button button--small" href="/faq">Read our FAQ</a>
								</div>
							</div>
						</div>

					</div>
				@endif

			</div>

		</div>

	@endsection

	@section('snippet-bottom')
		<script type="text/javascript"> window.context = 'homepage'; </script>
	@endsection



	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Season Tickets",
				"description" => "Seasons Tickets for parking at Ricoh Arena.",
				"keywords" => "season tickets ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Season Tickets</h1>

					@if( count($multi_tickets_group) ) 

						@foreach($multi_tickets_group as $multi)

							{{-- season ticket (multi ticket) --}}
							<div class="card card--seasonticket">
							
								<h2>{{ @$multi->lang->name }}</h2>
								<p>{{ @$multi->lang->description }}</p>

								<div class="card--seasonticket__button">
									<a class="button button--small" href="{{ url('season-tickets/details', $multi) }}">
										Buy Now
									</a>
									
								</div>

							</div>
							{{-- end season ticket (multi ticket) --}}

						@endforeach

					@else

						<div class="card">
							<p>
							There are no season tickets currently available for purchase at this time, 
							please check back soon.
							</p>
						</div>

					@endif

				</div>
			</div>

		</div>

	@endsection

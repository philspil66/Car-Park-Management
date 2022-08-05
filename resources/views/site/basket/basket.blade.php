
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Basket",
				"description" => "Basket page for Ricoh Arena Official Parking",
				"keywords" => "basket ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
		<div class="simplegrid">
		<div class="column column__100">

			{{-- basket title and item summary --}}
			<h1 class="basket--header">
				Basket 

				@if($items > 0)
					<span>
						You have <strong>{{ $items or 0 }} </strong>
						item<?php if($items > 1): echo 's'; endif;?>
						in your basket
					</span>
				@endif

			</h1>
			{{-- end basket title --}}

			@if ($single or $multi)
			
				<div id="basket" class="card--basket">
				<!-- <form id="basket-form" action="{{ url('checkout/address-form') }}" method="get">
				<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

				@if ($single)
					{{-- each item in the basket --}}
					@foreach($single as $item)
						<div class="card card--basket__item">

							{{-- event --}}
							<div class="card--basket__item--event">

								@if( $item['eventDate'] and $item['eventTime'] )
									<div class="card--basket__eventdatetime">
										<div class="card--basket__date">
											<i class="icon-calendar"></i> 
											{{ $item['eventDate'] }}
										</div>
										<div class="card--basket__time">
											<i class="icon-clock2"></i> 
											{{ $item['eventTime'] }}
										</div>
									</div>
								@endif

								<div class="card--basket__eventdetails">

									{{-- single event (vs) --}}
									@if ($item['teamOneLogo'] OR $item['teamTwoLogo'])

										{{-- generate team logo urls --}}
										<?php
											$logo_path    = '/images/teams/150x150/';
											$teamone_logo = explode('.png', $item['teamOneLogo']);
											$teamtwo_logo = explode('.png', $item['teamTwoLogo']);

											$teamone_logo = $logo_path . $teamone_logo[0] . '_150x150.png';
											$teamtwo_logo = $logo_path . $teamtwo_logo[0] . '_150x150.png';
										?>

										<div class="card--basket__team">
											<div class="card--basket__team--img">
												<img src="{{ $teamone_logo }}" alt="" />
											</div>
											<div class="card--basket__team--text">
												{{ $item['teamOneName'] }}
											</div>
										</div>
										<div class="card--basket__vs">VS</div>
										<div class="card--basket__team">
											<div class="card--basket__team--img">
												<img src="{{ $teamtwo_logo }}" alt="" />
											</div>
											<div class="card--basket__team--text">
												{{ $item['teamTwoName'] }}
											</div>
										</div>

									@else 	{{-- single --}}

										<div class="card--basket__single">
											<p>{{ $item['eventTitle'] }}</p>
										</div>

									@endif

								</div>

							</div>

							{{-- output products for event --}}
							@foreach($item['tickets'] as $ticket)

								<div class="card--basket__product">
									<div class="card--basket__product--name">{{ $ticket['carparkName'] }}</div>
									<div class="card--basket__product--price">&pound;{{ $ticket['price'] }}</div>
									<div class="card--basket__product--delete">
										<a href="{{ url('basket/remove-single', [$ticket['ticketId']]) }}">
											<i class="icon-bin"></i>
										</a>
									</div>

								</div>

							@endforeach

						</div>
					@endforeach
					{{-- end each item in the basket --}}

				@endif

				@if ($multi)

					@foreach($multi as $item)

						<div class="card card--basket__item">

						{{-- details about multi ticket --}}
						<div class="card--basket__item--event">
							<div class="card--basket__eventdetails">
								<div class="card--basket__single">
									<p>{{ $item['multiTicketGroupName'] }}</p>
								</div>
							</div>
						</div>			
						@foreach($item['tickets'] as $ticket)


                                                    <div class="card--basket__product">
                                                            &nbsp;{{ $counter++ }}.

                                                            <div class="card--basket__product--name">{{ $ticket['carparkName'] }}</div>
                                                            <div class="card--basket__product--price">&pound;{{ $ticket['price'] }}</div>
                                                            <div class="card--basket__product--delete">
                                                                    <a href="{{ url('basket/remove-multi', [$ticket['multiTicketId']]) }}">
                                                                            <i class="icon-bin"></i>
                                                                    </a>
                                                            </div>
                                                    </div>
                                                
                				@endforeach

						</div>

					@endforeach

				@endif



					@include('site.includes.basket.basket-summary', array(
						"basket_items" => $items,
						"basket_total" => $total
					))

				<!-- </form> -->
				</div>

			 @else

			 	<div class="card">

					<p>
					Your basket is currently empty, use the 'Find Events' button below to find a car 
					park for an event.
					</p>
					<a class="button button--small" href="/events">Find Events</a>

				</div>

			 @endif

		</div>
		</div>
		</div>

	@endsection
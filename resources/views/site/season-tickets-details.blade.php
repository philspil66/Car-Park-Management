
	@extends('layouts.site')

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">

					<h1>{{ $multi_tickets['groupName'] }}</h1>

					@if( count($multi_tickets['details']) )

						@foreach($multi_tickets['details'] as $multi)

							{{-- set $capacity_class based on $capacity_status --}}
							@if( $multi['capacity_status'] == _CARPARK_SOLD_TEXT_)
								<?php $capacity_class = ' card--product-disabled'; ?>
							@elseif( $multi['capacity_status'] == _CARPARK_LIMITED_TEXT_)
								<?php $capacity_class = ' card--product-limited'; ?>
							@else
								<?php $capacity_class = ''; ?>
							@endif

							<div class="card card--product {{ $capacity_class }}">

								<div class="card--product__details">
									<div class="card--product__left">

										<h2>{{ $multi['carparkName'] }}</h2>
										<p>{{ $multi['carparkDescription'] }}</p>

										@if( $multi['capacity_status'] == _CARPARK_SOLD_TEXT_)
											<div class="card--product__soldout">Sold out</div>
										@elseif( $multi['capacity_status'] == _CARPARK_LIMITED_TEXT_)
											<div class="card--product__limited">Limted spaces</div>
										@endif

									</div>
									<div class="card--product__right">

										<div class="card--product__box">
											<div class="card--product__box-left">
												<div class="card--product__box-price">Price</div>
											</div>
											<div class="card--product__box-right">
												<div class="card--product__box-price">&pound;{{ $multi['price'] }}</div>
											</div>
										</div>

									</div>
								</div>

								<div class="card--product__button">

									<?php
										$map_url = "http://www.google.com/maps/place/" . 
												   $multi['carparkLat'] ."," . $multi['carparkLong'] . 
								                   "/@" . $multi['carparkLat'] . "," . $multi['carparkLong'] .
								            	   ",17z";
									?>

									<a class="button button--outline button--small" href="{{ $map_url }}" target="_blank">
										<i class="icon-location"></i> View Map
									</a> 

									@if( $multi['capacity_status'] == _CARPARK_SOLD_TEXT_)
									<a class="button button--small disabled">
										<i class="icon-cart"></i> Add to basket
									</a>
									@else
									<a class="button button--small " href="{{ url('basket/season/add', [$multi['multiTicketId']]) }}">
										<i class="icon-cart"></i> Add to basket
									</a>
									@endif

								</div>

							</div>

						@endforeach

					@endif

				</div>
			</div>

		</div>

	@endsection
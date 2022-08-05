
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> $event['eventTitle'],
				"description" => $event['eventTitle'] . " - Official Ricoh Arena Parking",
				"keywords" => $event['eventTitle']
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

	<div class="content">

		<div class="simplegrid">
			<div class="column column__100">
				
				<h1>{{ $event['eventTitle'] }}</h1>

				<p>
					<i class="icon-calendar"></i> {{ $event['eventDate'] }}&nbsp;&nbsp;
					<i class="icon-clock2"></i> {{ $event['eventTime'] }}
				</p>
				
				@if( count($event['products']) > 0 ) {{-- products available --}}

					@foreach($event['products'] as $product)

						{{-- set $capacity_class based on $capacity_status --}}
						@if( $product['capacity_status'] == _CARPARK_SOLD_TEXT_)
							<?php $capacity_class = ' card--product-disabled'; ?>
						@elseif( $product['capacity_status'] == _CARPARK_LIMITED_TEXT_)
							<?php $capacity_class = ' card--product-limited'; ?>
						@else
							<?php $capacity_class = ''; ?>
						@endif					

						<div class="card card--product {{ $capacity_class }}">

							<div class="card--product__details ">
								<div class="card--product__left">

									<h2>{{ $product['carparkName'] }}</h2>
									<p>{{ $product['carparkDescription'] }}</p>

									@if( $product['capacity_status'] == _CARPARK_SOLD_TEXT_)
										<div class="card--product__soldout">Sold out</div>
									@elseif( $product['capacity_status'] == _CARPARK_LIMITED_TEXT_)
										<div class="card--product__limited">Limted spaces</div>
									@endif

								</div>
								<div class="card--product__right">
									
									<div class="card--product__box">
										<div class="card--product__box-left">Opening Time</div>
										<div class="card--product__box-right">
											<i class="icon-clock2"></i>
											{{ $product['openingTime'] }}
										</div>
									</div>
									<div class="card--product__box">
										<div class="card--product__box-left">Closing Time</div>
										<div class="card--product__box-right">
											<i class="icon-clock2"></i> 
											{{ $product['closingTime'] }}
										</div>
									</div>
									<div class="card--product__box">
										<div class="card--product__box-left">
											<div class="card--product__box-price">Price</div>
										</div>
										<div class="card--product__box-right">
											<div class="card--product__box-price">&pound;{{ $product['price'] }}</div>
										</div>
									</div>

								</div>
							</div>

							<div class="card--product__button">

								<?php
									$map_url = "http://www.google.com/maps/place/" . 
											   $product['carparkLat'] ."," . $product['carparkLong'] . 
							                   "/@" . $product['carparkLat'] . "," . $product['carparkLong'] .
							            	   ",17z";
								?>

								<a class="button button--outline button--small" href="<?php echo $map_url; ?>" target="_blank">
									<i class="icon-location"></i> View Map
								</a>

								@if( $product['capacity_status'] == _CARPARK_SOLD_TEXT_)
								<a class="button button--small disabled"><i class="icon-cart"></i> Add to basket</a>
								@else
								<a class="button button--small" href="{{ url('basket/add', [$product['productId']]) }}">
									<i class="icon-cart"></i> Add to basket
								</a>
								@endif
							</div>

						</div>

					@endforeach

				@else {{-- no products available --}}

					<div class="card">
						<p>Sorry, but there are no car parks currently available for this event.</p> 
						<p>Please use the button below to find another event.</p>
						<a class="button" href="/events">Find events</a>
					</div>

				@endif
				

			</div>
		</div>

	</div>
			
	@endsection
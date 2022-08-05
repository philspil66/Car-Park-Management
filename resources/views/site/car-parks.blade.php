
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Car Parks",
				"description" => "Car park details at the Ricoh Arena",
				"keywords" => "car parks ricoh arena"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

	<div class="content">

		<div class="simplegrid">
			<div class="column column__100">
				
				<h1>Car Parks</h1>

				@foreach ($car_parks as $car_park)

					<div class="card">
						
						<h2>{{ $car_park->lang->name }}</h2>
						<p>{{ $car_park->lang->directions }}</p>
						<p>{{ $car_park->lang->description }}</p>

						<?php
							$map_url = "http://www.google.com/maps/place/" . 
										$car_park->lat ."," . $car_park->long . 
							            "/@" . $car_park->lat . "," . $car_park->long .
							            ",17z";
						?>

						<a class="button button--outline button--small" href="<?php echo $map_url; ?>" target="_blank">
							<i class="icon-location"></i> View Map
						</a>

					</div>

				@endforeach

			</div>
		</div>
	
	</div>
			
	@endsection
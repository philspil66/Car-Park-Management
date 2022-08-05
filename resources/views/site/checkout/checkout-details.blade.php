
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Checkout",
				"description" => "Checkout page Ricoh Arena Official Parking",
				"keywords" => "checkout ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Your Details</h1>

					@include('site.includes.checkout.checkout-progress', array("active_step" => 1))

					<div class="card">

						@include('site.includes.forms.checkout-details')

					</div>

				</div>
			</div>

		</div>

	@endsection
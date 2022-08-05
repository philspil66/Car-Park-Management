
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "FAQ",
				"description" => "FAQ for parking at the Ricoh Arena",
				"keywords" => "faq ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')
		
		<div class="content">
			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Frequently Asked Questions</h1>

					<div class="card">
						<h3>Q: Are we affiliated with the Ricoh Arena?</h3>
						<p><strong>A:</strong> Yes, EST Ltd is the official provider for Ricoh Arena Official Parking</p>
					</div>

					<div class="card">
						<h3>Q: How can I be sure my payment is safe?</h3>
						<p><strong>A:</strong> We use Stripe for our payment method.</p>
					</div>

					<div class="card">
						<h3>Q: Will I get confirmation?</h3>
						<p>
							<strong>A:</strong> Yes, once we can confirm you’ve paid, we will send you an 
							e-mail saying the payment has been received.
						</p>
					</div>

					<div class="card">
						<h3>Q: What time does the car park open for Coventry City FC or Wasps Rugby home games?</h3>
						<p><strong>A:</strong> Three hours before kick-off or</p>

						<p>
							2.00pm kick off: Opening 11.00am, closing at 5.00pm<br />
							3.00pm kick off: Opening 12.00 midday, closing at 6.00pm<br />
							7.45pm kick off: Opening 5.30pm, closing at 10.30pm.
						</p>
					</div>

					<div class="card">
						<h3>Q: Is the car park easy to find and recognise?</h3>
						<p>
						<strong>A:</strong> Yes, just follow the official parking signs about a mile out from the Ricoh. The signs are an luminous yellow colour, with a big 'P' with "official" in writing on top, and an arrow 
						pointing you to the nearest off-site car park.	
						</p>
					</div>

					<div class="card">
						<h3>Q: Can I park on the streets around the Ricoh Arena?</h3>
						<p><strong>A:</strong> No. You cannot park on any street within 2 kilometres of the Ricoh Arena.</p>
					</div>

					<div class="card">
						<h3>Q: Can I change the registration plate for my order?</h3>
						<p>
						<strong>A:</strong> Yes. If you register with us, you will be able to store your plates and update 
						the registration plate against your orders.	
						</p>

						<div class="textalign--right">
							<img src="/images/bpa-logo@200x71.png" alt="" />
						</div>

					</div>

				</div>
			</div>
		</div>
		
	@endsection


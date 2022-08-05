
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Checkout Completed",
				"description" => "Checkout completed page Ricoh Arena Official Parking",
				"keywords" => "checkout completed ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Completed</h1>

					@include('site.includes.checkout.checkout-progress', array("active_step" => 3))

					<div class="card">

						<h2>Your order has been completed</h2>
						<p>
                                                @if ( $Order->type == 'phone')
                                                    This is a phone booking so customer will not receive a confirmation email. Please review the order details below and confirm with the customer.
                                                @else
                                                    Thank you for your order, please review the details below. 
                                                    You will also receive an email confirmation shortly, sent to {{ $User->email }}. 
                                                @endif    
						</p>

						<div class="order--important">
							<p>
							<strong>Important:</strong> Please ensure you enter your Vehicle Registration Plate(s)
							using the 'Enter Plates' button below.
							</p>
							<p>
							If you don't currently know the vehicle's plate, you will need to login to your account
							to add your plate and download your eTicket(s).
							</p>

							<a class="button button--small" href="/account">Enter Plates</a>
						</div>

						<div class="order--completed">
							<div class="order--completed__left">

								<div class="order--reference">
									<p class="order--reference__title"><strong>ORDER REFERENCE #</strong></p>
									<p class="order--reference__number">{{ $Order->order_ref }}</p>
									<p class="order--reference__date"><strong>Order Date: </strong> {{ $basketContents['orderCreated'] }}</p>
								</div>

								<div class="order--details">
									<table>
                                                                            @foreach($basketContents['orderDetails'] as $basketContent)
										<tr>
											<td><p>{{ $basketContent['product'] }}</p></td>
											<td><p>&pound;{{ $basketContent['price'] }}</p></td>
										</tr>
                                                                            @endforeach
										<tr>
											<td><p><strong>Total</strong></p></td>
											<td><p><strong>&pound;{{ $basketContents['orderTotal'] }}</strong></p></td>
										</tr>
									</table>
								</div>

							</div>
							<div class="order--completed__right">

								<div class="address">
									<h3>Your Details</h3>
									<p>{{ $User->getFullname() }}</p>
									<p>{{ $User->Address->address1 }}</p>
                                                                        @if ($User->Address->address2)
                                                                            <p>{{ $User->Address->address2 }}</p>
                                                                        @endif
                                                                        @if ($User->Address->town)
                                                                            <p>{{ $User->Address->town }}</p>
                                                                        @endif
                                                                        @if ($User->Address->county)
                                                                            <p>{{ $User->Address->county }}</p>
                                                                        @endif
                                                                        @if ($User->Address->country)
                                                                            <p>{{ $User->Address->country }}</p>
                                                                        @endif
                                                                        @if ($User->Address->postcode)
                                                                            <p>{{ $User->Address->postcode }}</p>
                                                                        @endif
        					        		<p>{{ $User->telephone}}</p>
								</div>

							</div>
							
						</div>

					</div>

				</div>
			</div>

		</div>

	@endsection
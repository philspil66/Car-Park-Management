
	<form class="form form--checkout" id="checkout-payment-form" action="/checkout/payment-process" method="post" novalidate>

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

        @if ($errors->all())
        	<div class="form-message">
        		<ul>                
		            @foreach($errors->all() as $error)
		               <li><i class="icon-info"></i> {{ $error }}</li>
		            @endforeach
		        </ul>
            </div>
        @endif
        @if ( Session::has('error') )
                <div class="form-message">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('error') }}</li>
                        </ul>
                </div>    
        @endif

        <p>
        Please review your details and enter your payment information. A confirmation email will be sent to 
        you as a reference to the order.	
        </p>

        <div class="form__grid">
        	<div class="form__left">
        		
        		<div class="form__row">
					<label for="order_card_holder">Card Holders Name</label>
					<input type="text" name="order_card_holder" value="{{ old('order_card_holder') }}" id="order_card_holder" placeholder="Enter card holders name" />
				</div>

				<div class="form__row">
					<label for="order_card_number">Card Number</label>
					<input type="text" name="order_card_number" value="" id="order_card_number" placeholder="Enter card number" autocomplete="off" />
				</div>

				<div class="form__row form__card--expiry">
					
					<label for="order_card_expiry_month">Expiry Date</label>

					<?php
						$current_month 	= Date("m");
						$current_year  	= intval(Date("Y"));
						$months        	= array("01","02","03","04","05","06","07","08","09","10","11","12");
					?>

					<select id="order_card_expiry_month" name="order_card_expiry_month">

						@foreach($months as $month)

							@if($current_month === $month)
								<option value="{{ $month }}" selected="selected">{{ $month }}</option>
							@else
								<option value="{{ $month }}">{{ $month }}</option>
							@endif

						@endforeach

					</select>

					<select id="order_card_expiry_year" name="order_card_expiry_year">

						@for($i = $current_year ; $i <= ($current_year + 10) ; $i++)
							
							@if( $current_year == $i)
								<option value="{{ $i }}" selected>{{ $i }}</option>
							@else
								<option value="{{ $i }}">{{ $i }}</option>
							@endif
							
						@endfor

					</select>

				</div>

				<div class="form__row form__card--expiry">
					<label for="order_card_security">Card Security Code</label>
					<input type="text" name="order_card_security" value="" id="order_card_security" placeholder="Enter security code" autocomplete="off" />
				</div>

        	</div>
        	<div class="form__right">
        		
        		<div class="address">
        			<h3>Your Details</h3> 
        			<p><strong>{{ $User->getFullname() }}</strong></p>	
	        		<p>{{ $User->Address->address1 }}</p>
	        		<p>{{ $User->Address->address2 }}</p>
	        		<p>{{ $User->Address->town }}</p>
	        		<p>{{ $User->Address->county }}</p>
	        		<p>{{ $User->Address->country }}</p>
	        		<p>{{ $User->Address->postcode }}</p>
	        		<p>{{ $User->telephone }}</p>
	        		<a class="button button--small" href="/checkout/details">Edit details</a>
	        	</div>
                    <input type="hidden" id="address1" value="{{ $User->Address->address1 }}" />
                    <input type="hidden" id="address2" value="{{ $User->Address->address2 }}" />
                    <input type="hidden" id="town" value="{{ $User->Address->town }}" />
                    <input type="hidden" id="county" value="{{ $User->Address->county }}" />
                    <input type="hidden" id="country" value="{{ $User->Address->country }}" />
                    <input type="hidden" id="postcode" value="{{ $User->Address->postcode }}" />
                    <input type="hidden" id="telephone" value="{{ $User->telephone }}" />
        	</div>
        </div>

        @if($orderCompleted==0)
       	<input id="submitButton" type="submit" value="Complete Order" />
        @endif
	</form>

	<form class="form" id="checkout-details-form" action="{{ url('checkout/details-proccess') }}" method="post" novalidate>
          	
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

        <p>Please add your address and mobile number to continue the checkout process.</p>

		{{-- postcode field for getaddress.io functionality --}}
		<div class="form__row">
			<label>Enter your postcode</label>			
			<div id="postcode-lookup"></div>
			<p class="js-show-address-fields">Can't find your address? <a href="">Enter your address manually</a></p>
		</div>

		{{-- address details (populated by getaddress.io--}}
		<div class="form__grid checkout-address-details">
			<div class="form__left">
				
				<div class="form__row">
					<label for="address1">Address 1</label>
					<input type="text" name="address1" value="{{ @$address->address1 }}" id="address1" placeholder="Enter address line 1" />
				</div>
				<div class="form__row">
					<label for="address2">Address 2</label>
					<input type="text" name="address2" value="{{ @$address->address2 }}" id="address2" placeholder="Enter address line 2" />
				</div>
				<div class="form__row">
					<label for="town">Town</label>
					<input type="text" name="town" value="{{ @$address->town }}" id="town" placeholder="Enter town" />
				</div>

			</div>
			<div class="form__right">
				
				<div class="form__row">
					<label for="county">County</label>
					<input type="text" name="county" value="{{ @$address->county }}" id="county" placeholder="Enter county" />
				</div>
				<div class="form__row">
					<label for="country">Country</label>
					<input type="text" name="country" value="{{ @$address->country }}" id="country" placeholder="Enter country" />
				</div>
				<div class="form__row">
					<label for="postcode">Postcode</label>
					<input type="text" name="postcode" value="{{ @$address->postcode }}" id="postcode" placeholder="Enter postcode" />
				</div>

			</div>
		</div>

		{{-- mobile number --}}
		<div class="form__grid">
			<div class="form__left">
				
				<div class="form__row">
					<label for="telephone">Mobile Number</label>
					<input type="text" name="telephone" value="{{ $user->telephone }}" id="telephone" placeholder="Enter your mobile number" />
				</div>

			</div>
		</div>
		
		<input type="submit" value="Continue" />

	</form>



	@extends('layouts.site')

    @section('meta')

        {{--*/ 
        $meta = array(
                "title"=> "Checkout Payment",
                "description" => "Checkout payment page Ricoh Arena Official Parking",
                "keywords" => "checkout payment ricoh arena parking"
        );
        /*--}}

        @include('site.includes.meta', $meta)

    @endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Payment</h1>

					@include('site.includes.checkout.checkout-progress', array("active_step" => 2))		

					<div class="card">

						@include('site.includes.forms.checkout-payment')

					</div>

				</div>
			</div>

		</div>

	@endsection
        
        @section('snippet-bottom')
        
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                
                var error = false;
                
                Stripe.setPublishableKey("{{ _STRIPE_PUBLIC_KEY_ }}");
                
                $("#submitButton").click(function(event) {

                    disableSubmitButton();

                    error = false;
                    $(".form-message").remove();
                    $(".error").each(function(){
                        $(this).remove();
                    });
                    
                    var ccNum = $('#order_card_number').val(), cvcNum = $('#order_card_security').val(), expMonth = $('#order_card_expiry_month').val(), expYear = $('#order_card_expiry_year').val();

                    if (!Stripe.card.validateCardNumber(ccNum)) {
                            error = true;
                            if ( !$("#order_card_number-error").is(':visible') ) {
                                $("#order_card_number").after('<label id="order_card_number-error" class="error" for="order_card_number">Please enter card number</label>');
                                $("#order_card_number-error").show();
                            }
                    }

                    // Validate the CVC:
                    if (!Stripe.card.validateCVC(cvcNum)) {
                            error = true;
                            if ( !$("#order_card_security-error").is(':visible') ) {
                                $("#order_card_security").after('<label id="order_card_security-error" class="error" for="order_card_security">Please enter card security code</label>');
                                $("#order_card_security-error").show();
                            }
                    }

                    // Validate the expiration:
                    if (!Stripe.card.validateExpiry(expMonth, expYear)) {
                            error = true;
                            if ( !$("#order_card_expiry-error").is(':visible') ) {
                                $("#order_card_expiry_year").after('<label id="order_card_expiry-error" class="error" for="order_card_expiry">Please enter correct expiry date</label>');
                                $("#order_card_expiry-error").show();
                            }
                    }
                    
                    if ( $("#order_card_holder").val().length < 2 ) {
                        error = true;
                        if ( !$("#order_card_holder-error").is(':visible') ) {
                            $("#order_card_holder").after('<label id="order_card_holder-error" class="error" for="order_card_holder">Please enter card holder\'s name</label>');
                            $("#order_card_holder-error").show();
                        }
                    }

                    if ( !error ) {

                        // Get the Stripe token:
                        Stripe.card.createToken({
                                number: ccNum,
                                cvc: cvcNum,
                                exp_month: expMonth,
                                exp_year: expYear,
                                name: $("#order_card_holder").val(),
                                address_line1: $("#address1").val(),
                                address_line2: $("#address2").val(),
                                address_city: $("#town").val(),
                                address_state: $("#county").val(),
                                address_country: $("#country").val(),
                                address_zip: $("#postcode").val()

                        }, stripeResponseHandler);
                    } else {

                        enableSubmitButton();


                    }

                    event.preventDefault();
                    return false;

                });
                
                
                
            });
            
            function disableSubmitButton() {
                $("#submitButton").prop('value', 'Please wait...');
                $("#submitButton").attr('disabled', 'disabled');
                $("#submitButton").css("background-color","#ccc");
            }
            function enableSubmitButton() {
                $("#submitButton").prop('value', 'Complete Order');
                $("#submitButton").removeAttr('disabled');
                $("#submitButton").css("background-color","#eb3913");
            }
            
            // Function handles the Stripe response:
            function stripeResponseHandler(status, response) {

                    $(".form-message").remove();
                    
                    // Check for an error:
                    if (response.error) {
                        
//                       $('#checkout-payment-form').prepend('<div class="form-message"><ul><li><i class="icon-info"></i> '+ response.error.message +'</li></ul></div>');
                       $('#checkout-payment-form').prepend('<div class="form-message"><ul><li><i class="icon-info"></i> Error processing payment.</li></ul></div>');
//                          reportError(response.error.message);
                        enableSubmitButton();

                    } else { // No errors, submit the form:

                      var f = $("#checkout-payment-form");

                      // Token contains id, last4, and card type:
                      var token = response['id'];

                      // Insert the token into the form so it gets submitted to the server
                      f.append("<input type='hidden' name='stripeToken' value='" + token + "' />");

                      // Submit the form:
                      f.get(0).submit();

                    }

            }            
        </script>
        @endsection
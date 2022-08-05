
	
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Orders', 'url' => '/admin/orders'],
				['title' => 'View Order', 'url' => '/admin/orders']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Orders</h1>
				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/orders/">All Orders</a>
						<a class="active">View</a>
					</div>
					<div class="tabs--content">
					<div class="tabs--content__panel active">

						{{-- order information --}}
						<div class="order--information">

							<div class="grid">
								<div class="column__25"><p>Order Reference</p></div>
								<div class="column__75"><p>{{ $orderDetails['orderRef'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Transaction Reference</p></div>
								<div class="column__75"><p>{{ $orderDetails['orderTransaction'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Date</p></div>
								<div class="column__75"><p>{{ $orderDetails['orderDate'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Time</p></div>
								<div class="column__75"><p>{{ $orderDetails['orderTime'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Name</p></div>
								<div class="column__75"><p>{{ $orderDetails['fullName'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Address</p></div>
								<div class="column__75"><p>{{ $orderDetails['address'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Email</p></div>
								<div class="column__75"><p>{{ $orderDetails['email'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Telephone</p></div>
								<div class="column__75"><p>{{ $orderDetails['telephone'] }}</p></div>
							</div>
							<div class="grid">
								<div class="column__25"><p>Order Total</p></div>
								<div class="column__75"><p>&pound;{{ $orderDetails['orderTotal'] }}</p></div>
							</div>
						</div>
						{{-- end order information --}}

						<div class="tabs--content__spacer">

							{{-- order update details --}}
							<div class="order--update--details">
								<div class="form--panel">
									<form class="form--standard update-email-form" action="">
										<div class="update-email-msg"></div>
										<div class="grid">
											<div class="column__50">
												<div class="form--standard__row">
													<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
													<label for="email">Edit Email Address</label>
													<input type="text" name="email" id="email" placeholder="Enter email" value="{{ $orderDetails['email'] }}" autocomplete="off" />
												</div>
											</div>
											<div class="column__50">&nbsp;</div>
										</div>
										<input class="button--submit" type="submit" value="save" />
									</form>
								</div>
							</div>

							{{-- order details --}}
							@foreach($orderDetails['details'] as $orderDetail)

								{{--*/ $order_status = strtolower($orderDetail['status']) /*--}}

								<div class="order--details {{ $order_status }}" data-order-detail-id="{{ $orderDetail['orderDetailId'] }}">
									<div class="order--details__header">		

										<div class="grid">
											<div class="column__50">
												<p class="order--details__eventname">
												<strong>{{ $orderDetail['eventName'] }} </strong>
												- {{ $orderDetail['carparkName'] }}
												</p>
											</div>
											<div class="column__25">
												<p class="order--details__price">
												<strong>Cost:</strong> &pound;{{ $orderDetail['price'] }}
												</p>
											</div>
											<div class="column__25">
												<p class="order--details__status">
												<strong>status:</strong> {{ $orderDetail['status'] }}
												</p>
											</div>
										</div>

									</div>

									@if( $order_status != 'cancelled')
									<div class="order--details__body">
										<div class="order--details__msg"></div>
										<div class="grid">
											<div class="column__50">
												
												{{-- DEV: commented out UI for cancel/refund --}}

												{{-- <a class="js-confirm button button--outline" href="" data-confirm-message="Are you sure you wish to refund this order?" data-confirm-class="js-refund-order" data-confirm-id="{{ $orderDetail['orderDetailId'] }}">Cancel / Refund &pound;{{ $orderDetail['price'] }}</a> --}}

												@if( $orderDetail['plateNumber'] != '' )
													<a class="button" href="/account/eticket?token={{ $orderDetail['eTicketHash'] }}">Print eTicket</a>
												@else
													<p>
													eTicket not available as customer has not entered a plate number.</p>
												@endif

											</div>
											<div class="column__50">&nbsp;

												{{-- DEV: commented out UI for plate change --}}
												
												{{-- <div class="plate--change">
													<div class="plate--change__input">
														<input type="text" name="plate" value="{{ $orderDetail['plateNumber'] }}" placeholder="Enter Plate" data-original-plate="{{ $orderDetail['plateNumber'] }}" />
													</div>
													<div class="plate--change__button">
														<a class="button" href="" data-order-detail-id="{{ $orderDetail['orderDetailId'] }}">Add Plate</a>
													</div>
												</div> --}}

											</div>																					
										</div>
									</div>
									@endif

								</div>

							@endforeach
							{{-- end order details --}}

						</div>

					</div>
					</div>

				</div>
			</div>

		</div>

	@endsection

	@section('snippet-bottom')

		{{-- include Mustache JS template partial --}}
		@include('admin.templates.msg')

		<script type="text/javascript">

			// update email
			$('.update-email-form').submit(function(e){

				var user_id 	= {{ $orderDetails['userId'] }};
				var new_email 	= $(this).find('#email').val();

				$.ajax({
		            headers: {  'X-CSRF-TOKEN': $('#_token').val() },
		            url: '/admin/orders/update-email/?user_id=' + user_id + '&new_email=' + new_email
			    })
			    .done(function(response){ 
			    	
			    	if(response == 1){

			    		// message data
                		var data = {
                			type : "success", messages : [{ msg : 'Email was updated successfully' }]
                		};

			    	}
			    	else{
			    		
			    		// message data
                		var data = {
                			type : "error", messages : [{ msg : 'Email could not be updated at this time.' }]
                		};

			    	}

					var template = $('#msg_template').html();
					$('.update-email-msg').html( Mustache.render(template, data ));

					setTimeout(function(){
						window.location.reload();
					},3000);

			    });

	         	e.preventDefault();

	        });

			// change plate
			$(document).on('click','.plate--change a.button', function(e){
		
				var $plate_elem		= $(this).parents('.plate--change').find('input');
				var $msg_elem		= $(this).parents('.order--details__body').find('.order--details__msg');
				var $original_plate	= $plate_elem.data('original-plate');

				var order_detail_id = $(this).attr('data-order-detail-id');
				var new_plate 		= $plate_elem.val();

				$.ajax({
                    headers: { 'X-CSRF-TOKEN': $('#_token').val() },
                    url: '/account/save-plate',
                    type: 'post',
                    data: {newPlate: new_plate, orderDetailId: order_detail_id },
                    cache : false
                })
                .done(function(response){

                	response 		= jQuery.parseJSON(response);
                	var data 		= {};	// Data for the mustache JS template
                	var template 	= $('#msg_template').html();

                    if ( response['status'] == 1 ) {

                    	if( response['message'].length ){
                    		$plate_elem.val(response['message']);
                    		data = { type : 'success', messages : [{ msg : 'Plate updated succesfully' }] }
                    	}
                    	else{
                    		data = { type : 'error', messages : [{ msg : 'Plate could not be updated' }] }
                    	}

                    	$msg_elem.html( Mustache.render(template, data) );
                    	setTimeout(function(){
							window.location.reload();
						},3000);

                    }
                    else{
                    	$plate_elem.val($original_plate);
                    	data = { type : 'error', messages : [{ msg : 'Please enter a valid plate' }] }
                    	$msg_elem.html( Mustache.render(template, data) );
                    	setTimeout(function(){
							$msg_elem.html('');							
						},3000);
                    	
                    }

                });

				e.preventDefault();

			});

			// refund order detail
			$(document).on('click', '.js-refund-order', function(e){

				var order_detail_id 	= $(this).attr('data-confirm-id');
				var $msg_elem			= $('.order--details[data-order-detail-id="' + order_detail_id + '"]')
										  .find('.order--details__msg');

				// add ajax spinner to confirm box
                $('.confirm--box__content p').html('processing...<div class="spinner"><i class="icon-spinner"></i></div>');		
				$.ajax({
                    headers: { 'X-CSRF-TOKEN': $('#_token').val() },
                    url: '/account/request-refund',
                    type: 'post',
                    data: { orderDetailId: order_detail_id },
                    cache: false
                })
                .done(function(response){
               
                	response = jQuery.parseJSON(response);

                	if( response['status'] == 1 ){
                		window.location.reload();
                	}
                	else{
                		var data = { 
                			type : 'error', 
                			messages : [
                				{ msg : 'Order could not be cancelled / refunded' }
                			] 
                		}

                		var template 	= $('#msg_template').html();
                		$msg_elem.html( Mustache.render(template, data) );
                		$('.js-confirm-close').click();
                		setTimeout(function(){
                			$msg_elem.html('');
                		},3000);

                	}

                });

				e.preventDefault();

			});

		</script>

	@endsection



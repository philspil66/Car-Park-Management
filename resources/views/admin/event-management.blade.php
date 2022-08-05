
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Events', 'url' => '/admin/events'],
				['title' => 'Event Management']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>{{ $eventMgmt['event']['eventTitle'] }}</h1>
					<p>
						<i class="icon-calendar"></i> {{ $eventMgmt['event']['eventDate'] }}&nbsp;&nbsp;
						<i class="icon-clock"></i> {{ $eventMgmt['event']['eventTime'] }}
					</p>
				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/events/event-create-edit?id={{ $eventMgmt['event']['eventId'] }}">Edit</a>
						<a class="active">Car Parks</a>
						<a class="disabled">Multi Tickets</a>
						<a class="disabled">Stats</a>
						<a class="disabled">Guest Lists</a>
						<a class="disabled">Wastage</a>
						<a class="disabled">Checkins</a>
						<a class="disabled">Income</a>
					</div>
					<div class="tabs--content">
						<div class="tabs--content__panel active">
					
							{{-- stats --}}
							<div class="stats--panel">
								<div class="stats--panel__left">
								
									<?php
									$max_spaces  = $eventMgmt['stats']['forDoughnut']['spacesTotal'];
									$allocated   =  $eventMgmt['stats']['forDoughnut']['spacesLeft'];

									$used_percentage = 0;
									$remaining_percentage = 0;
									if($max_spaces != 0){
										$used_percentage = \App\Classes\Tools::calculate_percentage($allocated, $max_spaces);
										$remaining_percentage = 100 - $used_percentage;
									}
									
									?>

									@if( $remaining_percentage <= _STATUS_RED_ )
										<?php $chart_colour = '#D9272E'; ?>
									@elseif( $remaining_percentage <= _STATUS_AMBER_ )
										<?php $chart_colour = '#FF5E29'; ?>
									@else
										<?php $chart_colour = '#00aa00'; ?>
									@endif

									<div class="chart"> 
										<canvas id="doughnut_chart" width="150" height="150"></canvas>
									</div>

									<div class="chart--key">
										<div class="chart--key__item">
											<div class="chart--key__item--name">
												<span style="background: {{ $chart_colour }};"></span> Unallocated Spaces
											</div>
											<div class="chart--key__item--stat">{{ $max_spaces - $allocated }}</div>
										</div>	
										<div class="chart--key__item">
											<div class="chart--key__item--name">
												<span></span> Total Allocated
											</div>
											<div class="chart--key__item--stat">{{ $max_spaces }}</div>
										</div>	
									</div>

								</div>
								<div class="stats--panel__right">
									
									<table class="stats--table">
										<tr>
											<td class="column33">

												@include('admin.includes.stat', $data = $eventMgmt['stats']['numberOfCarParksStats'])

											</td>
											<td class="column33">
												
												@include('admin.includes.stat', $data = $eventMgmt['stats']['capacityStats'])

											</td>
											<td class="column33">

												@include('admin.includes.stat', $data = $eventMgmt['stats']['allocatedStats'])

											</td>
										</tr>
									</table>
									<table class="stats--table">
										<tr>
											<td class="column25">
												@include('admin.includes.stat', $data = $eventMgmt['stats']['singleTicketsStats'])
											</td>
											<td class="column25">
												@include('admin.includes.stat', $data = $eventMgmt['stats']['multiTicketsStats'])
											</td>
											<td class="column25">
												@include('admin.includes.stat', $data = $eventMgmt['stats']['guestListsStats'])
											</td>
											<td class="column25">
												@include('admin.includes.stat', $data = $eventMgmt['stats']['wastageStats'])
											</td>
										</tr>
									</table>

								</div>
							</div>
							{{-- end stats --}}

							<div class="tabs--content__spacer">

								{{-- CSFR Token --}}
								<input class="token" type="hidden" name="token" value="{{ csrf_token() }}">

								{{-- add car park form --}}
								@include('admin.includes.event-add-carpark')

	                            {{-- car parks for event --}}
	                            @if ($eventMgmt['products'])
	                                @foreach($eventMgmt['products'] as $product)
	                                    @include('admin.includes.event-carpark')
	                                @endforeach
	                            @endif
								{{-- end car parks for event --}}
		
							</div>

						</div>
					</div>
					{{-- end tabs --}}

				</div>
			</div>

		</div>


	@endsection

	@section('snippet-bottom')

		{{-- include Mustache JS template partial --}}
		@include('admin.templates.msg')

		<script type="text/javascript">

			$(document).ready(function(){

				// get canvas context
				var ctx = document.getElementById("doughnut_chart").getContext("2d");

				// the chart data
				var data = {
				    labels: [
				        "Remaining",
				        "Used"
				    ],
				    datasets: [{
			            data: [<?php echo $max_spaces - $allocated; ?>, <?php echo $allocated; ?>],
			            backgroundColor: [
			                "<?php echo $chart_colour; ?>",
			                "#eeeeee"
			            ]
			        }]
				};

				// display the chart
				var doughtnut_chart = new Chart(ctx, {
				    type: 'doughnut',
				    data: data,
				    options: {
				    	legend : false,
				    	responsive: true
				    }
				});

				// Add new carpark ajax
				$('form.add-car-park').on('submit', function(e){

					var $msg_elem = $(this).find('.form-msg');

					// get product id, product event id and token
					var product_id 		 = "";	// this is always blank for adding a carpark 
					var product_event_id = $(this).find('input.product-event-id').val();
					var token 			 = $('input.token').val();
                                        var product_car_park_id = $(this).find('select#event__add__carpark__dropdown').val();

//					console.log(product_event_id + '-' + token);

					// get data from input fields
					var price_input 	= $(this).find('.price-input').val();
					var open_input 		= $(this).find('.open-input').val();
					var close_input 	= $(this).find('.close-input').val();
					var allocated_input = $(this).find('.allocated-input').val();
					var status_select 	= $(this).find('.status-select option:selected').val();

					// convert pounds to pence
					price_input = convert_pounds_to_pence(price_input);

					$.ajax({
	                    headers: {'X-CSRF-TOKEN': token },
	                    url: '/admin/events/car-park',
	                    type: 'post',
	                    data: { product_price : price_input, product_open: open_input, product_close: close_input, product_allocated: allocated_input, product_status: status_select, product_id: product_id, product_event_id: product_event_id, product_car_park_id: product_car_park_id },
	                    cache: false,
	                })
	                .done(function(response){

	                	var edit_success = response['status'];
                    	if(edit_success == '1'){
                    		
                                
                    		// window reload page here as editing a carpark was successful
                    		window.location.reload();
//                            location.reload();                            

                    	}
                    	else{
                        response = jQuery.parseJSON(response['message']);
                        var errors = '<div class="msg msg-error"><ul>';
                        $.each(response, function(i, item) {
                            errors += '<li><i class="icon-info"></i>&nbsp;'+item+'</li>';
                        });
                        errors += '</ul></div>';
                        
                        
                    		// message data
                    		var data = {
                    			type : "error",
                    			messages : response
                    		};

                    		// mustache js template
							var template 	= $('#msg_template').html();

							// Render mustache template using data and add to .form-msg elem
//    						$( $msg_elem ).html( Mustache.render(template, response ));
    						$( $msg_elem ).html( errors );

//    						setTimeout(function(){
//    							$( $msg_elem ).html('');
//    						},3000);

                    	}

	                });

					e.preventDefault();
				});

				// Edit carpark ajax
				$('form.edit-car-park').on('submit', function(e){

					// clear all .form-errors elems
					$('form.edit-car-park .form-msg').html('');

					// find current .form-errors element
					var $msg_elem = $(this).find('.form-msg');

					// get product id and token
					var product_id 	= $(this).find('input.product-id').val();
					var token 		= $('input.token').val();

					// get data from input fields
					var price_input 	= $(this).find('.price-input').val();
					var open_input 		= $(this).find('.open-input').val();
					var close_input 	= $(this).find('.close-input').val();
					var allocated_input = $(this).find('.allocated-input').val();
					var status_select 	= $(this).find('.status-select option:selected').val();

					// convert pounds to pence
					price_input = convert_pounds_to_pence(price_input);

					// ajax action for editing a carparks details
					$.ajax({
	                    headers: {  'X-CSRF-TOKEN': token },
	                    url: '/admin/events/car-park',
	                    type: 'post',
	                    data: { product_price : price_input, product_open: open_input, product_close: close_input, product_allocated: allocated_input, product_status: status_select, product_id: product_id  },
	                    cache: false
	                })
	                .done(function(response){

                                $( $msg_elem ).html( '' );
	                	var edit_success = response['status'];
                    	if(edit_success == '1'){
                    		
                                
                    		// window reload page here as editing a carpark was successful
                    		window.location.reload();
//                            location.reload();                            

                    	}
                    	else{
                        response = jQuery.parseJSON(response['message']);
                        var errors = '<div class="msg msg-error"><ul>';
                        $.each(response, function(i, item) {
                            errors += '<li><i class="icon-info"></i>&nbsp;'+item+'</li>';
                        });
                        errors += '</ul></div>';
                        
                        
                    		// message data
                    		var data = {
                    			type : "error",
                    			messages : response
                    		};

                    		// mustache js template
							var template 	= $('#msg_template').html();

							// Render mustache template using data and add to .form-msg elem
//    						$( $msg_elem ).html( Mustache.render(template, response ));
    						$( $msg_elem ).html( errors );

//    						setTimeout(function(){
//    							$( $msg_elem ).html('');
//    						},3000);

                    	}

	                });

					e.preventDefault();
				});

				function convert_pounds_to_pence(pounds){

					var pence = pounds * 100;
					return pence;

				}

			});

		</script>

	@endsection



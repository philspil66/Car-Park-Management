
	{{-- event carpark --}}

	<div class="event--carpark">

		@if( $product['status'] != 'online' )
			<div class="event--carpark__disabled">
				<i class="icon-info"></i> This car park is {{ $product['status'] }}
			</div>
		@endif

		<div class="event--carpark__head">
			<div class="event--carpark__head__left">
				<h2>{{ $product['carParkName'] }}</h2>
			</div>
			<div class="event--carpark__head__right">
				
				<div class="event--carpark__info">
					
					<div class="info">
						<p>status</p>
						<p>{{ $product['status'] }}</p>
					</div>
					<div class="info">
						<p>allocated</p>
						<p>{{ $product['allocated'] }}</p>
					</div>

					<div class="info">
						<p>close</p>
						<p>{{ $product['closingTime'] }}</p>
					</div>
					<div class="info">
						<p>open</p>
						<p>{{ $product['openingTime'] }}</p>
					</div>
					<div class="info">
						<p>price</p>
						<p>&pound;{{ $product['price'] }}</p>
					</div>
					
				</div>

				<div class="event--carpark__actions">

					<div class="dropdown--wrapper">
						<a class="button button--dropdown" href="">Actions <i class="icon-arrow"></i></a>
						<div class="dropdown">

							<a class="js-panel-switch" href="" 
								data-parent-elem='.event--carpark'
							   	data-visible-panels='[".event--carpark__form--edit"]'
							   	data-hidden-panels='[".event--carpark__stats", ".event--carpark__form--delete"]'>
								<i class="icon-cogs"></i> Edit
							</a>

							<a href="/admin/print-sheets-plate-number?event_id={{ $eventMgmt['event']['eventId']}}&amp;carpark_id={{ $product['carParkId'] }}" target="_blank">
								<i class="icon-download"></i> Print Sheet - Plates
							</a>

							<a href="/admin/print-sheets-name?event_id={{ $eventMgmt['event']['eventId']}}&amp;carpark_id={{ $product['carParkId'] }}" target="_blank">
								<i class="icon-download"></i> Print Sheet - Names
							</a>

							{{-- <a class="js-panel-switch" href="" 
								data-parent-elem='.event--carpark'
							   	data-visible-panels='[".event--carpark__form--delete"]'
							   	data-hidden-panels='[".event--carpark__form--edit", ".event--carpark__stats"]'>
								<i class="icon-cross"></i> Close &amp; Move
							</a> --}}

							{{--
							<a class="js-confirm" href="" data-confirm-url="/delete-event-carpark/">
								<i class="icon-bin"></i> Delete
							</a>
							--}}
						
						</div>
					</div>

				</div>


			</div>
		</div>

		<div class="event--carppark__panel">

			<div class="event--carpark__stats">
				
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Max Spaces</div>
					<div class="event--carpark__stat--right">{{ $product['capacity'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Single Tickets Sold</div>
					<div class="event--carpark__stat--right">{{ $product['singleTicketsSold'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Multi Tickets Sold</div>
					<div class="event--carpark__stat--right">{{ $product['multiTicketsSold'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Multi Tickets Checked In</div>
					<div class="event--carpark__stat--right">{{ $product['multiTicketsCheckedIn'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Guest List Spaces</div>
					<div class="event--carpark__stat--right">{{ $product['guestListSpaces'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Guest List Checked In</div>
					<div class="event--carpark__stat--right">{{ $product['guestListCheckedIn'] }}</div>
				</div>
				<div class="event--carpark__stat">
					<div class="event--carpark__stat--left"><i class="icon-stats-bars"></i> Wastage</div>
					<div class="event--carpark__stat--right">{{ $product['wastedSpaces'] }}</div>
				</div>

			</div>

			<div class="event--carpark__form event--carpark__form--edit">

				<form class="form--standard edit-car-park" action="/admin/events/car-park" method="post">

					<div class="form-msg"></div>

					<input class="product-id" type="hidden" name="product_id" value="{{ $product['productId'] }}" />

					<div class="grid">
						<div class="column__20">			
							<div class="form--standard__row">
								<label>Price:</label>
                                                                <input autocomplete="off" class="price-input" type="text" name="product_price" id="" value="{{ $product['price'] }}" placeholder="£" />
							</div>
						</div>
						<div class="column__20">							
							<div class="form--standard__row">
								<label>Open:</label>
								<input class="open-input" type="text" name="product_open" id="" value="{{ $product['openingTime'] }}" data-masked-input="99:99" />
							</div>
						</div>
						<div class="column__20">							
							<div class="form--standard__row">
								<label>Close:</label>
								<input class="close-input" type="text" name="product_close" id="" value="{{ $product['closingTime'] }}" data-masked-input="99:99" />
							</div>							
						</div>
						<div class="column__20">							
							<div class="form--standard__row">
								<label>Allocated:</label>
								<input class="allocated-input" type="text" name="product_allocated" id="" value="{{ $product['allocated'] }}" data-masked-input="99999" />	
							</div>							
						</div>
						<div class="column__20">

							<?php 
								$selectedOnline = ''; 
								$selectedOffline = ''; 
								$selectedPrivate = ''; 
								$selectedDisabled = ''; 
							?>
							
							@if( $product['status'] == 'online' )
								<?php $selectedOnline = 'selected'; ?>
							@elseif( $product['status'] == 'offline')
								<?php $selectedOffline = 'selected'; ?>
							@elseif( $product['status'] == 'private')
								<?php $selectedPrivate = 'selected'; ?>
							@elseif( $product['status'] == 'disabled')
								<?php $selectedDisabled = 'selected'; ?>
							@endif
								
							<label>Status:</label>
	                        <select class="status-select" name="product_status">
								<option value="{{_STATUS_ONLINE_}}" {{ $selectedOnline }}>{{ ucwords(_STATUS_ONLINE_)}}</option>
								<option value="{{_STATUS_OFFLINE_}}" {{ $selectedOffline }}>{{ ucwords(_STATUS_OFFLINE_)}}</option>
								<option value="{{_STATUS_PRIVATE_}}" {{ $selectedPrivate }}>{{ ucwords(_STATUS_PRIVATE_)}}</option>
								<option value="{{_STATUS_DISABLED_}}" {{ $selectedDisabled }}>{{ ucwords(_STATUS_DISABLED_)}}</option>
							</select>

						</div>
					</div>
					
					<input class="button--submit" type="submit" value="Save" />
					<a class="button button--outline js-panel-switch" href="" 
						data-parent-elem='.event--carpark'
					   	data-visible-panels='[".event--carpark__stats"]'
					   	data-hidden-panels='[".event--carpark__form--edit", ".event--carpark__form--delete"]'
					   	onclick="$('.form-msg').html('');">
						Cancel
					</a>

				</form>

			</div>

			{{--
			<div class="event--carpark__form event--carpark__form--delete">

				<form class="form--standard" action="/admin/events/move-car-park" method="post">

					<div class="grid">
						<div class="column__20">			
							<div class="form--standard__row">

								<label>Select a car park:</label>
								<select name="" id="">
									<option value="">Please select a car park</option>
									<option value="1">Car Park A</option>
									<option value="2">Car Park B</option>
									<option value="3">Car Park C</option>
									<option value="4">Car Park D</option>
								</select>

							</div>
						</div>
					</div>

					<input class="button--submit" type="submit" value="Close &amp; Move" />
					<a class="button button--outline js-panel-switch" href="" 
						data-parent-elem='.event--carpark'
					   	data-visible-panels='[".event--carpark__stats"]'
					   	data-hidden-panels='[".event--carpark__form--edit", ".event--carpark__form--delete"]'>
						Cancel
					</a>

				</form>

			</div>
			--}}

		</div>
	</div>

	{{-- end event carpark --}}



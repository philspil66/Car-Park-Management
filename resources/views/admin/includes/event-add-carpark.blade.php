

	<div class="event--add--carpark">
		<div class="grid">
			<div class="column__50">&nbsp;
				
				{{-- order by --}}
				{{-- <form class="form--standard">
					<div class="form--inline__row nmb">
						<select name="" id="">
							<option>-- order by --</option>
							<option value="">option</option>
							<option value="">option</option>
							<option value="">option</option>
						</select>
					</div>
					<div class="form--inline__row nmb">
						<input class="button--submit" type="submit" value="Apply" />
					</div>
				</form> --}}
				{{-- end order by --}}

			</div>
			<div class="column__50">
				
				<div class="helper__align--right">

					{{-- add card park button --}}
					<a class="button js-panel-switch" href="" data-parent-elem='.tabs--content__panel'
					   data-visible-panels='[".event--add--carpark__form"]' data-hidden-panels='[]'>
						<i class="icon-plus"></i> Add Car Park To Event
					</a>

				</div>

			</div>
		</div>
	</div>

        {{--*/ $arr_status[] = array( _STATUS_ONLINE_ => ucwords(_STATUS_ONLINE_) )  /*--}}
        {{--*/ $arr_status[] = array( _STATUS_OFFLINE_ => ucwords(_STATUS_OFFLINE_) )  /*--}}
        {{--*/ $arr_status[] = array( _STATUS_PRIVATE_ => ucwords(_STATUS_PRIVATE_) )  /*--}}
        
        {{-- messages --}}
        @if ( Session::has('successCarPark') )
            <div class="msg msg-success">
            <ul>                
                <li><i class="icon-info"></i> {{ Session::get('successCarPark') }}</li>
            </ul>
            </div>
        @endif
                
        <form class="form--standard add-car-park" action="/admin/events/car-park" method="post" novalidate>
		<div class="event--add--carpark__form">

			<div class="event--add--carpark__form__head">

				<div class="grid">
					<div class="column__50">
						
                        <select id="event__add__carpark__dropdown" name="product_car_park_id">
							<option value="">Please select a car park to add to the event</option>
                            @foreach($eventMgmt['carParks'] as $carPark)
							<option value="{{ $carPark['carParkId']}}" data-car-park-capacity="{{ $carPark['capacity']}}">{{ $carPark['carParkName']}}</option>
                            @endforeach
						</select>

					</div>
				</div>

			</div>

			<div class="event--add--carpark__form__panel">

				<div class="form-msg"></div>

                <input class="product-event-id" type="hidden" name="product_event_id" value="{{ $eventMgmt['event']['eventId'] }}" />

				<div class="grid">
					<div class="column__20">
						<div class="form--standard__row">
							<label>Price:</label>
                            <input class="price-input" type="text" name="product_price" id="" value="{{ old('product_price') }}" placeholder="£"/>
						</div>
					</div>
					<div class="column__20">
						<div class="form--standard__row">
							<label>Open:</label>
							<input class="open-input" type="text" name="product_open" id="" value="{{ old('product_open') }}" data-masked-input="99:99" />
						</div>
					</div>
					<div class="column__20">
						<div class="form--standard__row">
							<label>Close:</label>
							<input class="close-input" type="text" name="product_close" id="" value="{{ old('product_close') }}" data-masked-input="99:99" />
						</div>
					</div>
					<div class="column__20">
						<div class="form--standard__row">
							<label>Allocated:</label>
							<input class="allocated-input" type="text" name="product_allocated" id="allocated" value="{{ old('product_allocated') }}" data-masked-input="99999" />
						</div>
					</div>
					<div class="column__20">
						<div class="form--standard__row">
							<label>Status:</label>
		                    <select class="status-select" name="product_status">
		                        @foreach($arr_status as $status)
		                            @if( old('product_status') == key($status))
		                               	<option value="{{ key($status) }}" selected="selected">{{ $status[key($status)] }}</option>
		                            @else
										<option value="{{ key($status) }}">{{ $status[key($status)] }}</option>
		                            @endif
		                        @endforeach
							</select>
						</div>
					</div>
				</div>

				<input class="button--submit" type="submit" value="Save" />
				<a class="button button--outline js-panel-switch" href="" 
					data-parent-elem='.tabs--content__panel'
				   	data-visible-panels=''
				   	data-hidden-panels='[".event--add--carpark__form"]'
				   	onclick="$('.form-msg').html('');">
					Cancel
				</a>

			</div>
        </div>
    </form>
        
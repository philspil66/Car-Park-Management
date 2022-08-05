
	@extends('layouts.site')

    @section('meta')

        {{--*/ 
        $meta = array(
                "title"=> "Your Account",
                "description" => "Your Account - Ricoh Arena Official Parking",
                "keywords" => "your account ricoh arena parking"
        );
        /*--}}

        @include('site.includes.meta', $meta)

    @endsection

	@section('content')

		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

        @include('site.includes.nav-account')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">

                    @if( count($Events) == 0 )

                        <div class="card">
                            <p>
                            You currently have no upcoming events, click the 'Add Events' button below to 
                            find parking for an event.
                            </p>
                            <a class="button button--small" href="/events">Add Events</a>
                        </div>

                    @else

                        <div class="card card--condensed">

                            <?php $event_title = 'event'; ?>
                            @if( count($Events) > 1 )
                                <?php $event_title = 'events' ?>
                            @endif 

                            <h2>Your upcoming {{ $event_title }}</h2>

                            <p> 
                            You have {{ count($Events) }} upcoming {{ $event_title }}, 
                            please see the details below.
                            </p>

                        </div>

                    @endif

                    {{-- upcoming event --}}
                    @foreach($Events as $Event)
                        <div class="card card--account--upcoming">
                
                            {{-- event details --}}
                            <div class="card--account--upcoming__event">
                                <h2>{{ $Event['eventTitle'] }}</h2>
                                @if($Event['eventType'] != _TICKET_TYPE_MULTI_)
                                <p>
                                    <i class="icon-calendar"></i> 
                                    {{ \App\Classes\Tools::dateformat($Event['eventDate']) }}&nbsp;&nbsp;
                                    <i class="icon-clock2"></i> 
                                    {{ \App\Classes\Tools::timeformat($Event['eventTime']) }}
                                </p>
                                @endif    
                            </div>
                            @foreach($Products as $Product)
                                @if ( $Product['eventId'] == $Event['eventId'] )
                                    {{-- event product --}}
                                    @if ($Product['productStatus']==_ORDER_STATUS_SUCCESSFUL_)
                                    <div class="card--acount--upcoming__product" id="{{ $Product['orderDetailsId']}}" >
                                    @else 
                                    <div class="card--acount--upcoming__product disabled" id="{{ $Product['orderDetailsId']}}" >
                                    @endif

                                        {{-- cancelled message (i.e. if product refunded) --}}
                                        <div class="card--account--upcoming__cancelled">Cancelled</div>

                                        {{-- event product details --}}
                                        <div class="card--acount--upcoming__product__details">
                                            <div class="card--acount--upcoming__product__details--left">
                                                <p><strong>{{ $Product['productTitle'] }}</strong></p>
                                                @if($Event['eventType'] != _TICKET_TYPE_MULTI_)
                                                <p>View <a href="http://www.google.com/maps/place/{{ $Product['productLat'] }},{{ $Product['productLong'] }}">car park map</a></p>
                                                @endif
                                            </div>
                                            @if($Event['eventType'] != _TICKET_TYPE_MULTI_)
                                            <div class="card--acount--upcoming__product__details--right">
                                                <p><i class="icon-clock2"></i> opening times</p> 
                                                <p>
                                                    {{ \App\Classes\Tools::timeformat($Product['productOpeningTime']) }} - 
                                                    {{ \App\Classes\Tools::timeformat($Product['productClosingTime']) }}
                                                </p>
                                            </div> 
                                            @endif
                                        </div>

                                        {{-- event product actions --}}
                                        @if ($Product['productStatus']==_ORDER_STATUS_SUCCESSFUL_)
                                        <div class="card--acount--upcoming__product__actions">

                                             <p class="card--account--upcoming__message">
                                                @if ( $Product['productPlate'] )
                                                    To change a plate, type new plate in the box below and click 'Change Plate' button.
                                                @else    
                                                    To add a plate, type a plate in the box below and click 'Add Plate' button.
                                                @endif 
                                            </p>

                                            <div class="card--account--upcoming__plate">
                                                <div class="card--account--upcoming__plate--left">
                                                    <input type="text" name="{{ $Product['productPlate'] }}" placeholder="enter plate" value="{{ $Product['productPlate'] }}" />
                                                </div>
                                                <div class="card--account--upcoming__plate--right">
                                                    <a href="" class="button button--small">
                                                        @if ( $Product['productPlate'] )
                                                            Change Plate
                                                        @else    
                                                            Add Plate
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card--account--upcoming__buttons">
                                                @if ( $Product['productPlate'] )
                                                    <a class="button button--small" href="/account/eticket?token={{ $Product['productToken'] }}">print eticket</a>
                                                @endif
                                                @if ( $Product['productRefundAllowed'] )
                                                    <a class="button button--outline button--small refund--button" href="">
                                                        cancel / refund <strong>&pound;{{ $Product['productPrice'] }}</strong>
                                                    </a>
                                                @endif    
                                            </div>

                                        </div>

                                        <div class="card--account--upcoming__messages">
                                            <div class="card--account--upcoming__messages--left">
                                                
                                                 {{-- Hint about eTicket --}}
                                                @if ( !$Product['productPlate'] )
                                                <div class="msg">
                                                    <p>
                                                        <i class="icon-info"></i> 
                                                        You must add a plate before you can print your eticket.
                                                    </p>
                                                </div>
                                                @endif

                                            </div>        
                                            <div class="card--account--upcoming__messages--right"></div>
                                        </div>

                                        @endif    
                                    </div>
                                    {{-- end event product --}}
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                    {{-- end upcoming event--}}


				</div>
			</div>

		</div>

	@endsection
        
        @section('snippet-bottom')
        
        <script type="text/javascript">

            $(document).ready(function() {
                
                $(".card--account--upcoming__plate--right a").click(function(event) {
                    
                //
                // Change Plate requested
                //
                    
                    // Prevent the HREF from loading
                    event.preventDefault();
                    
                    // Make a note of element clicked
                    var thisButton = $(this);
                    
                    // Disable clicked button for now
                    disableButton( thisButton );
                    
                    // Get plate input box element
                    var newPlateInputBox = $(this).parent().parent().find('input');
                    
                    // Get order detail id for the given product
                    var orderDetailId = thisButton.parent().parent().parent().parent().attr('id');
                    
                    if ( newPlateInputBox.val().length > 0 && orderDetailId) {
                    //
                    // If plate input box IS NOT blank AND order detail id exists
                    //
                        
                        // Save the new plate and get new plate back from the ajax call
                        var newPlateFromAJAX = savePlate( newPlateInputBox.val(), orderDetailId );
                        
                        
                        if ( newPlateFromAJAX.length ) {
                        //
                        // If length of new plate from AJAX call is MORE than 0 
                        // then insert this plate into plate input box
                        //
                            newPlateInputBox.val( newPlateFromAJAX );
                            
                        } else {
                        //
                        // If length of new plate from AJAX call is 0 then an error
                        // occurred so clear the plate input box and enable the button
                        //
                            newPlateInputBox.val('');
                            enableButton( thisButton );                            
                        }
                    }
                    
                    //
                    // If empty plate is entered then revert back to previous plate
                    if ( newPlateInputBox.val().length == 0 ) {
                        newPlateInputBox.val( newPlateInputBox.attr('name') );
                    }
                    
                    //
                    // Reload the page
                    location.reload();                            

                });
                
                $("a.refund--button").click(function(event) {                    
                //
                // Cancel / Refund requested
                //
                
                    var ans = confirm('This action will cancel your booking.\nClick Ok to continue or Cancel to stop.');
                    if ( ans == false ) {
                        return false;
                    }
            
                    // Prevent the HREF from loading
                    event.preventDefault();
                    
                    // Make a note of element clicked
                    var thisButton = $(this);
                    
                    // Disable clicked button for now
                    thisButton.css("border-color","#ccc");
                    thisButton.css("color","#ccc");
                    
                    // Remove any previous message
                    thisButton.parent().find(".refund-message").remove();

                    // Get order detail id for the given product
                    var orderDetailId = thisButton.parent().parent().parent().attr('id');
 
                    if ( orderDetailId) {
                    //
                    // Only if order detail id exists
                    //
                    
                        var refunded = requestRefund( orderDetailId );

                        if ( refunded['status'] == 1 ) {

                           postRefundActions( thisButton );

                        } else {
                            
                            // Add a message
                            thisButton.parents('.card--acount--upcoming__product')
                                    .find('.card--account--upcoming__messages--right')
                                    .html('<div class="msg inline-msg">' + 
                                          '<p><i class="icon-info"></i> ' + 
                                          'Refund request unsuccessful:' + refunded['message'] +
                                          '</p>' + 
                                          '</div>');

                            // make sure that left side message container has a space character (otherwise layout breaks)
                            thisButton.parents('.card--acount--upcoming__product')
                                      .find('.card--account--upcoming__messages--left').
                                      append('&nbsp;');
                            
                            // enable the clicked button
                            thisButton.css("border-color","#eb3913");
                            thisButton.css("color","#eb3913");
                        }
                    }

                });
            });       
            
            function postRefundActions( buttonObj ) {
                buttonObj.parent().parent().parent().find('.card--account--upcoming__noplate').slideUp('slow', function() { $(this).remove(); } );
                buttonObj.parent().parent().slideUp('slow', function() { $(this).remove(); } );
                buttonObj.parent().parent().parent().addClass('disabled');
                
                buttonObj.parents('.card--acount--upcoming__product')
                        .find('.card--account--upcoming__messages--left')
                        .html('&nbsp');
            }
            function disableButton( buttonObj ) {
                buttonObj.attr('disabled', 'disabled');
                buttonObj.css("background-color","#ccc");
            }
            function enableButton( buttonObj ) {
                buttonObj.removeAttr('disabled');
                buttonObj.css("background-color","#eb3913");
            }
            
            function requestRefund( orderDetailId ) {
                
                var retValue;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#_token').val()
                    },
                    url: '/account/request-refund',
                    type: 'post',
                    data: { orderDetailId: orderDetailId },
                    cache: false,
                    async: false,
                    success: function(response) {
                        
                        response = jQuery.parseJSON(response);
                        retValue = response;
                        
                    }
                });

                return retValue;
            }
            
            function savePlate( newPlate, orderDetailId ) {

                var retValue = '';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('#_token').val()
                    },
                    url: '/account/save-plate',
                    type: 'post',
                    data: {newPlate: newPlate, orderDetailId: orderDetailId },
                    cache: false,
                    async: false,
                    success: function(response) {
                        
                        response = jQuery.parseJSON(response);

                        if ( response['status'] == 1 ) {
                            retValue = response['message']; // Message contains new plate from the db or nothing in case of any error
                        }
                    }
                });

                return retValue;
            }
            
        </script>
        @endsection
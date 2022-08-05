
	@extends('layouts.eticket')

	@section('content')

		<div class="eticket">
				
			{{-- header --}}	
			<div class="eticket__header">
				<h1>Official eTicket</h1>
				<p><strong>ORDER REF#</strong> {{ $eTicket['order_ref'] }}</p>
			</div>

			{{-- date and time --}}
			<div class="eticket__eventmeta">
				@if( $eTicket['ticket_type'] == 'single_vs' or $eTicket['ticket_type'] == 'single' )

					@if( $eTicket['event_date'] or $eTicket['opening_time'] or $eTicket['closing_time'])
							
						@if( $eTicket['event_date'] )
							<div class="eticket__date">
								<strong>Date: </strong> {{ $eTicket['event_date'] }}
							</div>
						@endif
						
						@if( $eTicket['opening_time'] )
							<div class="eticket__time--opening">
								<strong>Opening time: </strong> {{ $eTicket['opening_time'] }}
							</div>
						@endif

						@if( $eTicket['closing_time'] )
							<div class="eticket__time--closing">
								<strong>Closing time: </strong> {{ $eTicket['closing_time'] }}
							</div>
						@endif

					@endif

				@endif
			</div>

			@if( $eTicket['ticket_type'] == 'single_vs' )

				@if( isset( $eTicket['team1logo']) and isset( $eTicket['team2logo'] ) )

					{{-- generate team logo urls --}}
					<?php
						//$logo_path    = '/images/teams/400x400/';
						$teamone_logo = explode('.png', $eTicket['team1logo']);
						$teamtwo_logo = explode('.png', $eTicket['team2logo']);

						$teamone_logo = $teamone_logo[0] . '_400x400.png';
						$teamtwo_logo = $teamtwo_logo[0] . '_400x400.png';
					?>

					{{-- single_vs event (team vs team) --}}
					<div class="eticket__teams">
						<div class="eticket__team">
							
							<div class="eticket__team--img">
								<img src="{{ asset('/images/teams/400x400') }}/{{ $teamone_logo }}" alt="" />
							</div>

						</div>
						<div class="eticket__team--vs">VS</div>
						<div class="eticket__team">

							<div class="eticket__team--img">
								<img src="{{ asset('/images/teams/400x400') }}/{{ $teamtwo_logo }}" alt="" />
							</div>
							
						</div>
					</div>

				@endif

			@endif

			@if( $eTicket['ticket_type'] == 'single' )

				{{--- single event (name) --}}
				<div class="eticket__title">
					<div class="eticket__title--inner">
						<h1>{{ $eTicket['title'] }}</h1>
						<h2>{{ $eTicket['carpark_name'] }}</h2>
					</div>
				</div>

			@endif

			@if( $eTicket['ticket_type'] == 'multi' )

				{{-- multi ticket (name) --}}
				<div class="eticket__title">
					<div class="eticket__title--inner">
						<h1>{{ $eTicket['title'] }}</h1>
					</div>
				</div>

			@endif

			{{-- plate --}}
			<div class="eticket__reg">
				<div class="eticket__reg__inner">{{ $eTicket['plate_number'] }}</div>
			</div>
			
			<div class="eticket__details">
				@if( $eTicket['ticket_type'] == 'single_vs' or $eTicket['ticket_type'] == 'single' )

					{{-- event details (name and description) --}}
					<h1>Ricoh Arena Parking</h1>
					<h2>{{ $eTicket['carpark_name'] }}</h2>
					<p>{{ $eTicket['description'] }}</p>

				@endif
			</div>

			{{-- est logo strip --}}
			<div class="eticket__est">
				<div class="eticket__est--logo">
					<img src="{{ asset('/images/eticket/est-logo.png') }}" alt="" />
				</div>
				<div class="eticket__est--strip">&nbsp;</div>
			</div>

		</div>

	@endsection

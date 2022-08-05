
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Events', 'url' => '/admin/events'],
				['title' => $createEditForm['mode'] . ' Event']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">

					@if( $createEditForm['mode'] == 'Edit' )
						<h1>{{ $createEditForm['title'] }}</h1>
						<p>
							<i class="icon-calendar"></i> {{ $createEditForm['vanityDate'] }}&nbsp;&nbsp;
							<i class="icon-clock"></i> {{ $createEditForm['vanityTime'] }}
						</p>
					@else
						<h1>Create {{ $createEditForm['categoryName'] }} Event</h1>
					@endif

				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a class="active" href="">{{ $createEditForm['mode'] }}</a>

						@if( $createEditForm['mode'] == 'Create')						
							<a class="disabled">Car Parks</a>							
							<a class="disabled">Multi Tickets</a>				
							<a class="disabled">Stats</a>
							<a class="disabled">Guest Lists</a>
							<a class="disabled">Wastage</a>
							<a class="disabled">Checkins</a>
							<a class="disabled">Income</a>
						@else							
							<a href="/admin/events/event?id={{ $createEditForm['eventId'] }}">Car Parks</a>
							<a class="disabled">Multi Tickets</a>
							<a class="disabled">Stats</a>
							<a class="disabled">Guest Lists</a>
							<a class="disabled">Wastage</a>
							<a class="disabled">Checkins</a>
							<a class="disabled">Income</a>
						@endif

					</div>

					{{-- tabs content --}}
					<div class="tabs--content">
					<div class="tabs--content__panel active">
					<div class="tabs--content__spacer">
				
						{{-- form panel --}}
						<div class="form--panel">
							
							@if ($errors->all())  
								<div class="msg msg-error">
									<ul>
										@foreach($errors->all() as $error)
										<li><i class="icon-info"></i> {{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							@if ( Session::has('error') )
					            <div class="msg msg-error">
					        		<ul>                
							            <li><i class="icon-info"></i> {{ Session::get('error') }}</li>
							        </ul>
					            </div>
					        @endif

							<p>Please complete the form below to create an event</p>
							<form class="form--standard" action="/admin/events/event-create-edit" method="post">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                    <input type="hidden" name="mode" value="{{ $createEditForm['mode'] }}">
			                    <input type="hidden" name="event_id" value="{{ $createEditForm['eventId'] or '' }}">
			                    <input type="hidden" name="category_id" value="{{ $createEditForm['categoryId'] or '' }}">
			                    <input type="hidden" name="category_type" value="{{ $createEditForm['categoryType'] }}">

			                    {{-- event name and date --}}
			                    <div class="grid">
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="event_title">Event Title: <span>*</span></label>
											<input type="text" name="event_title" id="event_title" value="{{ old('event_title', $createEditForm['title']) }}" />
										</div>
			                    	</div>
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="event_date">Date: <span>*</span></label>
											<input type="text" name="event_date" id="event_date" value="{{ old('event_date', $createEditForm['date']) }}" placeholder="yyyy-mm-dd" />
										</div>
			                    	</div>
			                    </div>

			                    {{-- time and status --}}
			                    <div class="grid">
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="event_time">Time: <span>*</span></label>
											<input type="text" name="event_time" id="event_time" value="{{ old('event_time', $createEditForm['time']) }}" placeholder="hh:mm" data-masked-input="99:99" />
										</div>
			                    	</div>
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="event_status">Status: <span>*</span></label>
											<select name="event_status" id="event_status">
												<option value="">-- choose a status --</option>

												{{--*/ 
													$options = array('active', 'inactive'); 
													$status  = old('event_status', $createEditForm['status']);
												/*--}}

												@foreach($options as $option)
													@if( $status == $option )
														{{--*/ $selected = 'selected' /*--}}
													@else
														{{--*/ $selected = '' /*--}}
													@endif

													<option value="{{ $option }}" {{ $selected }}>{{ $option }}</option>
												@endforeach

											</select>
										</div>
									</div>
								</div>

								{{-- description --}}
								<div class="grid">
									<div class="column__100">
			                    		<div class="form--standard__row">
											<label for="event_description">Description:</label>
											<textarea name="event_description" id="event_description" rows="5">{{ old('event_description', $createEditForm['description']) }}</textarea>
										</div>
			                    	</div>
			                    </div>

			                   	@if( $createEditForm['categoryType'] == 'team' )

				                   	{{-- team event fields --}}
				                    <div class="grid">
				                    	<div class="column__50">
				                    		<div class="form--standard__row">
												<label for="event_team1_id">Team 1: <span>*</span></label>
												<select name="event_team1_id" id="event_team1_id">
													<option value="">-- choose a team --</option>

													@foreach($createEditForm['teams'] as $team)
														@if( $createEditForm['team1'] == $team->name || 
															 $team->team_id == old('event_team1_id') )
															{{--*/ $selected = 'selected' /*--}}
														@else
															{{--*/ $selected = '' /*--}}
														@endif
														<option value="{{ $team->team_id }}" {{ $selected }}>{{ $team->name }}</option>
													@endforeach

												</select>
											</div>
				                    	</div>
				                    	<div class="column__50">
				                    		<div class="form--standard__row">
												<label for="event_team2_id">Team 2: <span>*</span></label>
												<select name="event_team2_id" id="event_team2_id">
													<option value="">-- choose a team --</option>

													@foreach($createEditForm['teams'] as $team)
														@if( $createEditForm['team2'] == $team->name || 
															 $team->team_id == old('event_team2_id') )
															{{--*/ $selected = 'selected' /*--}}
														@else
															{{--*/ $selected = '' /*--}}
														@endif
														<option value="{{ $team->team_id }}" {{ $selected }}>{{ $team->name }}</option>
													@endforeach

												</select>
											</div>
				                    	</div>
				                    </div>
				                    {{-- end team event fields --}}

			                    @endif

								<div class="form--standard__row">
									<input class="button--submit" type="submit" value="{{ $createEditForm['mode'] }} Event" />
								</div>
							</form>
						</div>
						{{-- end form panel --}}

					</div>
					</div>
					</div>
					{{-- tabs content --}}

				</div>
			</div>

		</div>

	@endsection
	

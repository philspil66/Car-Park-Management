
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Teams', 'url' => '/admin/teams'],
				['title' => $addAmendForm['mode'] . ' Team']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Teams</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/teams">All Teams</a>
						<a class="active" href="/admin/teams/add-edit">{{ $addAmendForm['mode'] }}</a>
					</div>
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
							
							<p>Please use the form below to {{ $addAmendForm['mode'] }} a team.</p>
							<form class="form--standard" action="/admin/teams/add-edit" method="post">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                    <input type="hidden" name="team_id" value="{{ $addAmendForm['teamId'] or '' }}">

			                    {{-- name and category --}}
			                    <div class="grid">
			                    	<div class="column__50">			               
			                    		<div class="form--standard__row">
											<label for="team_name">Name <span>*</span></label>
											<input type="text" name="team_name" id="team_name" value="{{ old('team_name', $addAmendForm['teamName']) }}" />
										</div>
			                    	</div>
			                    	<div class="column__50">		
			                    		<div class="form--standard__row">
											<label for="team_category">Category <span>*</span></label>	
											<select name="team_category" id="team_category">
												<option value="">-- choose a category --</option>

												{{--*/ 
													$team_category_id = old('team_category', $addAmendForm['categoryId']) 
												/*--}}

												@foreach( $addAmendForm['categories'] as $option )
													@if( $team_category_id == $option->id )
														{{--*/ $selected = 'selected' /*--}}
													@else
														{{--*/ $selected = '' /*--}}
													@endif
													<option value="{{ $option->id }}" {{ $selected }}>
														{{ $option->lang->description }}
													</option>
												@endforeach

											</select>
										</div>
			                    	</div>
			                    </div>

			                    {{-- logo and status --}}
			                    <div class="grid">
			                    	<div class="column__50">			               
			                    		<div class="form--standard__row">
											<label for="team_logo">Logo URL <span>*</span></label>
											<input type="text" name="team_logo" id="team_logo" value="{{ old('team_logo', $addAmendForm['teamLogo']) }}" placeholder="e.g. coventry_fc.png" />
										</div>
			                    	</div>
			                    	<div class="column__50">		
			                    		<div class="form--standard__row">
											<label for="team_status">Status <span>*</span></label>

											<select name="team_status" id="team_status">
												<option value="">-- choose a status --</option>
												{{--*/ $status_options = array('active','inactive'); /*--}}
												{{--*/ 
													$status = old('team_status', $addAmendForm['teamStatus']) 
												/*--}}												
												@foreach( $status_options as $option )
													@if( $status == $option )
														{{--*/ $selected = 'selected' /*--}}
													@else
														{{--*/ $selected = '' /*--}}
													@endif
													<option value="{{ $option }}" {{ $selected }}>
														{{ $option }}
													</option>													
												@endforeach

											</select>
										</div>
			                    	</div>
			                    </div>

			                    <div class="form--standard__row">
									<input class="button--submit" type="submit" value="{{ $addAmendForm['mode'] }} Team" />
								</div>

			                 </form>
			                 {{-- end form panel --}}

			            </div>

					</div>
					</div>
					</div>

				</div>
			</div>

		</div>

	@endsection
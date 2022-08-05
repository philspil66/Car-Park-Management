
	@extends('layouts.admin')

	@section('content')

		<?php 
			$breadcrumb = array(
				['title' => 'Multi Tickets', 'url' => '/admin/multi-tickets'],
                                ['title' => $addAmendForm['mode'] . ' Create Multi Ticket']
			); 
                        
                        var_dump($addAmendForm);
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					@if( $addAmendForm['mode'] == 'Edit' )
						<h1>{{ $addAmendForm['title'] }}</h1>
						<p>
							<i class="icon-calendar"></i> {{ $addAmendForm['vanityDate'] }}&nbsp;&nbsp;
							<i class="icon-clock"></i> {{ $addAmendForm['vanityTime'] }}
						</p>
					@else
						<h1>Create {{ $addAmendForm['categoryName'] }} Season Ticket</h1>
					@endif
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a class="active" href="">Create</a>
						<a class="disabled" href="">Car Parks</a>
					</div>

					{{-- tabs content --}}
					<div class="tabs--content">
					<div class="tabs--content__panel active">
					<div class="tabs--content__spacer">

						{{-- form panel --}}
						<div class="form--panel">

							@if ( Session::has('success') )
					            <div class="msg msg-success">
						            <ul>                
						                <li><i class="icon-info"></i> {{ Session::get('success') }}</li>
						            </ul>
					            </div>
					        @endif
							
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

					        <p>Please complete the form below to create a multi ticket</p>
							<form class="form--standard" action="/admin/multi-tickets/create-edit" method="post">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                                <input type="hidden" name="mode" value="{{ $addAmendForm['mode'] }}">
			                                <input type="hidden" name="multiticket_id" value="{{ $addAmendForm['multiticketId'] or '' }}">
			                                <input type="hidden" name="category_id" value="{{ $addAmendForm['categoryId'] or '' }}">

					    {{-- category, name and status --}}
			                    <div class="grid">

			                    	<div class="column__33">
			                    		<div class="form--standard__row">
											<label for="">Name:</label>
											<input type="text" name="multiticket_name" id="multiticket_name" value="{{ $addAmendForm['name'] or old('multiticket_name') }}" />
										</div>
			                    	</div>
			                    	<div class="column__33">
			                    		<div class="form--standard__row">
											<label for="">Status:</label>
											<select name="multiticket_status" id="multiticket_status">
												<option value="">-- choose a status --</option>

												<?php $options = array('online', 'offline', 'private'); ?>
												@foreach($options as $option)
													@if( $addAmendForm['status'] == $option || 
														 $option == old('multiticket_status') )
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
			                    			<label for="">Description:</label>
			                    			<textarea name="multiticket_description" id="multiticket_description" rows="5">{{ $addAmendForm['description'] or old('multiticket_description') }}</textarea>
			                    		</div>
			                    	</div>
			                    </div>

			                    <div class="form--standard__row">
                                                                        <input class="button--submit" type="submit" value="{{ $addAmendForm['mode'] }} Create Multi Ticket" />
								</div>

							</form>

					    </div>
					    {{-- end form panel --}}

					</div>
					</div>
					</div>

				</div>
			</div>

		</div>

	@endsection
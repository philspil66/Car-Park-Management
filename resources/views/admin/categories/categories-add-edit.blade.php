
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Categories', 'url' => '/admin/categories'],
				['title' => $addAmendForm['mode'] . ' Category']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Categories</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/categories">All Categories</a>
						<a class="active" href="/admin/categories/create-edit">{{ $addAmendForm['mode'] }}</a>
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

							<p>Please use the form below to {{ $addAmendForm['mode'] }} a category</p>
							<form class="form--standard" action="/admin/categories/add-edit" method="post">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                    <input type="hidden" name="mode" value="">
			                    <input type="hidden" name="category_id" value="{{ $addAmendForm['categoryId'] or '' }}">

			                    {{-- description and type fields --}}
			                    <div class="grid">
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="category_description">Description: <span>*</span></label>
											<input type="text" name="category_description" id="category_description" value="{{ old('category_description', $addAmendForm['description']) }}" />
										</div>
			                    	</div>
			                    	<div class="column__50">
			                    		<div class="form--standard__row">
											<label for="category_type">Type: <span>*</span></label>
											<select name="category_type" id="category_type">
												<option value="">-- choose a type --</option>

												{{--*/ 
													$category_type = old('category_type', $addAmendForm['type']) 
												/*--}}
												{{--*/ $options = array('team', 'single'); /*--}}
												@foreach($options as $option)
													@if( $category_type == $option )
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

			                    <div class="form--standard__row">
									<input class="button--submit" type="submit" value="{{ $addAmendForm['mode'] }} Category" />
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

	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Wastage Reasons', 'url' => '/admin/wastage-reasons'],
				['title' => $addAmendForm['mode'] . ' Wastage Reason']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Wastage Reason</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/wastage-reasons">All Wastage Reason</a>
						<a class="active" href="/admin/wastage-reasons/add-edit">
							{{ $addAmendForm['mode'] }}
						</a>
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
							
							<p>Please use the form below to {{ $addAmendForm['mode'] }} a wastage reason.</p>
							<form class="form--standard" action="/admin/wastage-reasons/add-edit" method="post">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
			                    <input type="hidden" name="wastage_reason_id" value="{{ $addAmendForm['wastageReasonId'] or '' }}">

			                    {{-- description --}}
			                    <div class="grid">
			                    	<div class="column__50">			               
			                    		<div class="form--standard__row">
											<label for="wastage_reason_description">
												Description <span>*</span>
											</label>
											<input type="text" name="wastage_reason_desc" id="wastage_reason_desc" value="{{ old('wastage_reason_desc', $addAmendForm['wastageReasonDesc']) }}" />
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
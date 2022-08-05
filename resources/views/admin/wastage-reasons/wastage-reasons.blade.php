
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Wastage Reasons', 'url' => '/admin/wastage-reasons']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Wastage Reasons</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a class="active">All Wastage Reasons</a>
						<a href="/admin/wastage-reasons/add-edit">Add</a>
					</div>
					<div class="tabs--content">
					<div class="tabs--content__panel active">
						<div class="tabs--content__spacer">

							@if ( Session::has('success') )
					            <div class="msg msg-success">
						            <ul>                
						                <li><i class="icon-info"></i> {{ Session::get('success') }}</li>
						            </ul>
					            </div>
					        @endif

							{{-- datatable --}}
							<div class="table--wrapper">
								<table class="table--base" id="wastage-reasons-table">
							        <thead>		
							            <tr>
 							                <th>
							                	ID
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Description
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>&nbsp;</th>
							            </tr>
							        </thead>
							    </table>
						    </div>
						    {{-- end datatable --}}

						</div>

					</div>
					</div>

				</div>
			</div>


		</div>

	@endsection

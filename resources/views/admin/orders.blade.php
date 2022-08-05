
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Orders', 'url' => '/admin/orders']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Orders</h1>
				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a class="active">All Orders</a>
						<a class="disabled">View</a>
					</div>
					<div class="tabs--content">
					<div class="tabs--content__panel active">
						<div class="tabs--content__spacer">

							{{-- custom search for datatable --}}
							<div class="helper__align--right">
								<form class="form--standard">
									<div class="form--inline__row">
										<label>Search: </label>
										<input class="search-input" type="text" style="min-width: 400px;" />
									</div>
									<div class="form--inline__row">
										<select class="search-column" style="margin-right: 0;">
											<option value="order_ref">Order Ref</option>
											<option value="firstname">Firstname</option>		
											<option value="lastname" selected>Lastname</option>
											<option value="email">Email</option>
										</select>
									</div>
								</form>
							</div>
							
							{{-- datatable --}}
							<div class="table--wrapper">
								<table class="table--base" id="orders-table">
							        <thead>
							            <tr>
							                <th>
							                	Order Ref
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Order Date
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Firstname
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Lastname
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Email
							                	<i class="icon-filter"></i>
							                	<i class="icon-filterup"></i> 
							                	<i class="icon-filterdown"></i> 
							                </th>
							                <th>
							                	Transaction Ref
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

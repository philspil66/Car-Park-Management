
	@extends('layouts.admin')

	@section('content')

		<?php $breadcrumb = array(['title' => 'Multi Tickets']) ?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Multi Tickets</h1>
				</div>
				<div class="panel__body panel__body--border">

					{{-- filter --}}
					<div class="grid">
						<div class="column__75">
							
							<form class="form--standard" novalidate>
								<div class="filter">
									<div class="form--inline__row">
										<h3>Filter</h3>
									</div>
									<div class="form--inline__row">
										<select id="multi_tickets_group_filter">
											<option value="">-- status --</option>
											<option value="all">All</option>
						                    <option value="offline">Offline</option>
						                    <option value="online">Online</option>
										</select>
									</div>
								</div>
							</form>

						</div>
						<div class="column__25" style="text-align: right;">
						
							<form class="form--standard">
								<div class="form--inline__row">

									<div class="dropdown--wrapper">
										<a class="button button--dropdown" href="">
											Create Multi Ticket Group <i class="icon-arrow"></i>
										</a>
 										<div class="dropdown">
											@foreach($Categories as $Category)
												<a href="/admin/multi-tickets/create-edit?category_id={{ $Category->id }}">
													{{ $Category->lang->description }}
												</a>												
											@endforeach
										</div>                                                                           
									</div>

								</div>
							</form>
						</div>

					</div>
					{{-- end filter --}}
                                        
 					{{-- multi_ticket_groups --}}
                                        @foreach ($multi_ticket_groups as $multi_ticket_group)
        				     @include('admin.includes.multi-ticket-group')
                                        @endforeach                                          

				</div>
			</div>

		</div>

	@endsection

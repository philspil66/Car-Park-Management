
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Events']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Events</h1>
				</div>
				<div class="panel__body panel__body--border">
					
					{{-- filter --}}
					<div class="grid">
						<div class="column__75">
							@include('admin.includes.event-filter')
						</div>
						<div class="column__25" style="text-align: right;">
						
							<form class="form--standard">
								<div class="form--inline__row">

									<div class="dropdown--wrapper">
										<a class="button button--dropdown" href="">
											Create Event <i class="icon-arrow"></i>
										</a>
										<div class="dropdown">
											@foreach($Categories as $Category)
												<a href="/admin/events/event-create-edit?category_id={{ $Category->id }}">
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

					@if ( Session::has('success') )
			            <div class="msg msg-success">
				            <ul>                
				                <li><i class="icon-info"></i> {{ Session::get('success') }}</li>
				            </ul>
			            </div>
			        @endif

					{{-- events --}}
                    @foreach ($events as $event)
        				@include('admin.includes.event')
                    @endforeach                                        
	
					{{-- pagination --}}
					<div class="pagination--container">
						<div class="pagination__info">
							<p>Showing {{ $pagination['startRecord'] }} to {{ $pagination['endRecord'] }} of {{ $events->total()}} events</p>
						</div>
						<div class="pagination__links">
							 {!! $events->render() !!}
						</div>                    
					</div>	
					{{-- end pagination --}}

				</div>
			</div>

		</div>

	@endsection
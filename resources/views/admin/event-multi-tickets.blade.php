
	@extends('layouts.admin')

	@section('content')

		<?php
			$breadcrumb = array(
				['title' => 'Events', 'url' => '/admin/events'],
				['title' => 'Event Management']
			)
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Event Name</h1>
					<p>
						<i class="icon-calendar"></i> yyyy-mm-dd&nbsp;&nbsp;
						<i class="icon-clock"></i> 00:00
					</p>
				</div>
				<div class="panel__body">
					
					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/events/event-create-edit?id=">Edit</a>						
						<a href="">Car Parks</a>
						<a class="active" href="/admin/events/event-multi-tickets">Multi Tickets</a>
						<a class="disabled">Stats</a>
						<a class="disabled">Guest Lists</a>
						<a class="disabled">Wastage</a>
						<a class="disabled">Checkins</a>
						<a class="disabled">Income</a>
					</div>
					<div class="tabs--content">
					<div class="tabs--content__panel active">
					<div class="tabs--content__spacer">

						{{-- add multi ticket form --}}
						@include('admin.includes.event-add-multi-ticket')	

						{{--*/ $multi_ticket_groups = array('1','2','3') /* --}}
						@if( $multi_ticket_groups )
							@foreach( $multi_ticket_groups as $multi_ticket_group)
								@include('admin.includes.event-multi-ticket')
							@endforeach
						@endif
		
					</div>
					</div>
					</div>
					{{-- end tabs --}}

				</div>
			</div>

		</div>

	@endsection


	@extends('layouts.admin')

	@section('content')

		<?php 
			$breadcrumb = array(
				['title' => 'Multi Tickets', 'url' => '/admin/multi-tickets'],
				['title' => 'Car Parks']
			); 
		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="panel">
				<div class="panel__header">
					<h1>Multi Ticket Group Name</h1>
				</div>
				<div class="panel__body">

					{{-- tabs --}}
					<div class="tabs">
						<a href="/admin/multi-tickets/create-edit">Edit</a>
						<a class="active" href="">Car Parks</a>
					</div>

					{{-- tabs content --}}
					<div class="tabs--content">
					<div class="tabs--content__panel active">
					<div class="tabs--content__spacer">

						{{-- add car park form --}}
						@include('admin.includes.multi-ticket-add-carpark')

						<?php
							$carparks = array('1','2','3');
						?>	

                        {{-- car parks for multi ticket group --}}
                		@if($carparks)
                            @foreach($carparks as $carpark)
                                @include('admin.includes.multi-ticket-carpark')
                            @endforeach
                        @endif
						{{-- end car parks for multi ticket group --}}

					</div>
					</div>
					</div>

				</div>
			</div>

		</div>

	@endsection
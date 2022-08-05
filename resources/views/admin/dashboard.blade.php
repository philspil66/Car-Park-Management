
	@extends('layouts.admin')

	@section('content')

		<?php

			$breadcrumb = array(
				['title' => 'Welcome To The Admin' , 'url' => '/level1']/*,
				['title' => 'Level 2' , 'url' => '/level2'],
				['title' => 'Level 3' , 'url' => '/level3'],
				['title' => 'Current Page']*/
			)

		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">

			<div class="grid">
				<div class="column__100">

					<div class="card">
						
						<h1>Welcome to the admin</h1>

						<p>Please use the menu links or the buttons below to navigate.</p>

						<a class="button" href="/admin/events">Events</a>
						<a class="button" href="/admin/orders">Orders</a>

					</div>
					
				</div>
			</div>

		</div>

	@endsection
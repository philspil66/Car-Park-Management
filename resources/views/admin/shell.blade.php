
	@extends('layouts.admin')

	@section('content')

		<?php

			$breadcrumb = array(
				['title' => 'Example' , 'url' => '/level1'],
				['title' => 'Current Page']
			)

		?>

		@include('admin.includes.breadcrumb', $breadcrumb)

		<div class="site-wrapper__inner">
			
			<ul>
				<li><a href="/style-guide">UI Components</a></li>
				<li><a href="/admin/events">Events</a></li>
				<li><a href="/admin/events/event-create-edit">Event - Create / Edit</a></li>
				<li><a href="/admin/events/event-stats">Event - Stats</a></li>
				<li><a href="/admin/events/event-carparks?id=1">Event - Carparks</a></li>
			</ul>

		</div>

	@endsection
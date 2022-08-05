
	@if( isset($breadcrumb) )

		<?php $breadcrumb_count = count($breadcrumb); ?>

		<div class="breadcrumb">
			<a href="/admin"><i class="icon-home"></i> Admin</a> / 
				
			@foreach($breadcrumb as $key => $item)

				{{-- check if its the last breadcrumb item --}}
				@if( ($key + 1) == $breadcrumb_count)
					<p>{{ $item['title'] }}</p>
				@else
					<a href="{{ $item['url'] }}">{{ $item['title'] }}</a> /
				@endif

			@endforeach

		</div>

	@endif
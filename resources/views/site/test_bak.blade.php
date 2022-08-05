@extends('layouts.site')

	@section('content')

	<div class="content">

	<?php $total = 0;  $items = 0; ?>

	@if ($single)

		@if ($single)

		<p> SINGLE </p>

		<?php $last_id = 0; $show = 0; $items = 0; ?>

		@foreach($single as $key => $value)

			@foreach($value as $product)

			<?php if ($product->events_id == $last_id ) $show = 0; else $show = 1; ?>

			<p> <?php $total += $product->price; ?> </p>

			@if ($show == 1) 

				<p> {{ $product->event->category['slug'] }} </p>

				<p> {{ $product->event->date }} {{ $product->event->time }} </p>

				@if ($product->event->teamone['logo'] or $product->event->teamtwo['logo'])

					<p> {{ $product->event->teamone['lang']['name'] }} VS {{ $product->event->teamtwo['lang']['name'] }} </p>

					<p> {{ $product->event->teamone['logo'] }} VS {{ $product->event->teamtwo['logo'] }} </p>

				@else

					<p> {{ $product->event->lang->title }} </p>

				@endif

			@endif

			<p> {{ $product->carpark->lang->name }} - £{{ $product->price }} <a href="{{ url('basket/remove-single', $key) }}">remove</a></p>

			<?php $last_id = $product->events_id; ?>

			@endforeach

			<?php $items++; ?>

		@endforeach

		@endif

		<p> Items: {{ $items }} </p>

		<p> Total: £{{ $total }} </p>

 	@else

 	Your Basket Is Empty

 	@endif

	</div>
			
	@endsection
	





	
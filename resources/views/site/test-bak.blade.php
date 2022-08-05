
	@extends('layouts.site')

	@section('content')

	<div class="content">

	<?php $total = 0; ?>

	@if ($single or $multi)

		@if ($single)

		<?php $count = 0; ?>

		<p> SINGLE </p>

		@foreach($single as $key => $value)

			@foreach($value as $product)

			<p> <?php $total += $product->price; ?> </p>

			@if ($count == 0) <p> {{ $product->event->teamone['lang']['name'] }} VS {{ $product->event->teamtwo['lang']['name'] }} </p> @endif

			<p> {{ $product->event->date }} {{ $product->event->time }} </p>

			@if ($count == 0) <p> {{ $product->event->category['slug'] }} </p> @endif

			<p> {{ $product->carpark->lang->name }} - £{{ $product->price }} <a href="{{ url('basket/remove-single', $key) }}">remove</a></p>

			<?php $count++; ?>

			@endforeach

		@endforeach

		@endif

		@if ($multi)

		<?php $count = 0; ?>

		<p> MULTI </p>

		@foreach($multi as $key => $value)

			@foreach($value as $product)

			<p> <?php $total += $product->price; ?> </p>

			@if ($count == 0) <p> {{ $product->event->teamone['lang']['name'] }} VS {{ $product->event->teamtwo['lang']['name'] }} </p> @endif

			<p> {{ $product->event->date }} {{ $product->event->time }} </p>

			@if ($count == 0) <p> {{ $product->event->category['slug'] }} </p> @endif

			<p> {{ $product->carpark->lang->name }} - £{{ $product->price }} <a href="{{ url('basket/remove-multi', $key) }}">remove</a></p>

			<?php $count++; ?>

			@endforeach

		@endforeach

		<p> Total: £{{ $total }} </p>

		@endif

 	@else

 	Your Basket Is Empty

 	@endif

	</div>
			
	@endsection
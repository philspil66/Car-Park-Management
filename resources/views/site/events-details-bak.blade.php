
	@extends('layouts.site')

	@section('content')

	<div class="content">

	<p>Event id: {{ $event->id }}</p>

	<p>Event title: {{ $event->lang->title }}</p>

	<p>Event date: {{ $event->date }}</p>

	<p>Event time: {{ $event->time }}</p>

	@foreach($event->product as $product)

	<p>Product id: {{ $product->id }}</p>

	<p>Car park name: {{ $product->carpark->lang->name }} <a href="{{ url('basket/add', [$product->id]) }}">Add to basket</a></p>

	<p>Description: {{ $product->carpark->lang->description }}</p>

	<p>Price: {{ $product->price }}</p>
	<p>Open: {{ $product->opening_time }}</p>
	<p>Close: {{ $product->closing_time }}</p>

	@endforeach

	</div>
			
	@endsection

	<div class="card--basket--summary">
		{{-- <p><strong>items:</strong> {{ $basket_items or 0 }}, </p>  --}}
		<p><strong>total:</strong> &pound;{{ $basket_total or 0 }}</p>
		<a class="button button--outline" href="/events">Add More</a>
		<a class="button" href="{{ url('checkout/details') }}">Checkout</a>
	</div>
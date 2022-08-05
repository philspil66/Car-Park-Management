
	@extends('layouts.site')

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Contact us</h1>

				</div>
			</div>
				
			<div class="simplegrid">
				<div class="column column__50">

					<div class="card">	

						<h2>Email</h2>
						@include('site.includes.forms.contact')

					</div>

				</div>
				<div class="column column__50">

					<div class="card">

						<p>
						To reach the parking support team please either complete our form, or call us on the number 
						below during normal office hours.
						</p>
						
						<h2>Phone</h2>

						<a href="tel: 02476 997605">
							<i class="icon-phone"></i> 02476 997605
						</a>

					</div>

				</div>
			</div>
		</div>

	@endsection
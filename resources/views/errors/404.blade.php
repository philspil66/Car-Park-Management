
	@extends('layouts.site')

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">
					<h1>Page not found</h1>
				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__100">

					<div class="card">
						<p>
						Sorry the page you were looking for could not be found.
						</p>

						<p>
						We have recently redesigned our site so maybe one of the links below is what you are looking for?
						</p>

						<p>
						<a class="button button--small" href="/events">Find an event</a>
						<a class="button button--small" href="/season-tickets">Season Tickets</a>
						<a class="button button--small" href="/faq">FAQ</a>
						<a class="button button--small" href="/auth">Login</a>
						</p>

						<div class="msg">
							<div class="msg--inner">
								<h2>Download Your eTicket</h2>
								<ul>
									<li>
										If you are trying to download your eticket for an event please 
										<a href="/auth">login</a> to your account with your email and password.
									</li>
									<li>
										If you are a guest user simply supply your email and enter 
										'guest' as the password.
									</li>
								</ul>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>

	@endsection
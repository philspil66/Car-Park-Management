
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Login or Register",
				"description" => "Login or Register for Ricoh Arena Official Parking",
				"keywords" => "login ricoh arena parking, register ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">
					<h1>Login or Register</h1>
				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__50">
					
					<div class="card">
						@include('site.includes.forms.login')
					</div>

				</div>
				<div class="column column__50">
					
					<div class="card">
						<h2>Not yet a member?</h2>

						<p>Create an account with us by clicking the button below.</p>

						<p>
						You will then be able to login at any time to update your car registration details or 
						re-print your eticket prior to the event.
						</p>

						<a class="button button--small" href="/auth/register">Register</a>
					</div>

				</div>

			</div>

		</div>

	@endsection
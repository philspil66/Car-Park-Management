	
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Register",
				"description" => "Register for Ricoh Arena Official Parking",
				"keywords" => "register ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					<h1>Register</h1>	
				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__100">
					
					<div class="card">
						
						@include('site.includes.forms.register')

					</div>

				</div>
			</div>

		</div>

	@endsection


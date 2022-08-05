
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array(
				"title"=> "Reset Password",
				"description" => "Reset Password - Ricoh Arena Official Parking",
				"keywords" => "reset password ricoh arena parking"
		);
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					<h1>Reset Password</h1>	
				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__100">
					
					<div class="card">
						
						@include('site.includes.forms.reset-password')

					</div>

				</div>
			</div>

		</div>

	@endsection
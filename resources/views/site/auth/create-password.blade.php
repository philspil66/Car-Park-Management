
	@extends('layouts.site')

	@section('meta')

		{{--*/ 
		$meta = array("title"=> "Create Password");
		/*--}}

		@include('site.includes.meta', $meta)

	@endsection

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					<h1>Create Password</h1>	
				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__100">
					
					<div class="card">
						
						@include('site.includes.forms.create-password')

					</div>

				</div>
			</div>

		</div>

	@endsection

	@extends('layouts.site')

	@section('content')

		<div class="content">
			
			<div class="simplegrid">
				<div class="column column__100">
					
					<h1>Change Password</h1>

				</div>
			</div>

			<div class="simplegrid">
				<div class="column column__33">
					
					@include('site.includes.menu.account-menu')
					
				</div>
				<div class="column column__66">

					<div class="card">
						@include('site.includes.forms.change-password')
					</div>

				</div>
			</div>

		</div>

	@endsection
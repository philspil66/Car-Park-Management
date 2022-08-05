
	@extends('layouts.site')

	@section('content')

		<div class="content">

			<div class="simplegrid">
				<div class="column column__100">

					<h1>Registration</h1>
					
					<div class="card">
                        @if ( Session::has('error') )
                            <div class="form-message">
                                <ul>                
                                    <li><i class="icon-info"></i> {{ Session::get('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        @if ( Session::has('info') )
                            <div class="form-message form-message-success">
                                <ul>                
                                    <li><i class="icon-info"></i> {{ Session::get('info') }}</li>
                                </ul>
                            </div>
                        @endif
						
						@if ( $action == _MESSAGE_ACTION_REGISTER_THANKYOU_ )
	
						<p>Thank you for registering</p>

                        @endif
                	</div>

				</div>
			</div>
     
		</div>

	@endsection
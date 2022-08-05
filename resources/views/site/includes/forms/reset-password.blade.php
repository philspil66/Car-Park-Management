        @if ( Session::has('migrate_user') )
                <div class="form-message">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('migrate_user') }}</li>
		        </ul>
                </div>
        @elseif ( Session::has('info') )
                <div class="form-message form-message-success">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('info') }}</li>
		        </ul>
                </div>
        @else
            <p>To reset your password please type or confirm your email address that was used to create the account and click 'Send reset email' button.</p>
        @endif


	<form class="form" id="reset-password-form" action="/auth/reset-password" method="post" novalidate>
               
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @if ($errors->all())
        	<div class="form-message">
        		<ul>                
		            @foreach($errors->all() as $error)
		               <li><i class="icon-info"></i> {{ $error }}</li>
		            @endforeach
		        </ul>
            </div>
        @endif

        @if ( Session::has('error') )
                <div class="form-message">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('error') }}</li>
                        </ul>
                </div>    
        @endif

		<div class="form__row">
			<label for="email">Email</label>
			<input type="text" name="email" value="{{ $email }}" id="email" placeholder="Enter your email" />
		</div>
		<input type="submit" value="Send reset email" />

	</form>
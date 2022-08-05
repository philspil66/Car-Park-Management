        @if ( Session::has('migrate_user') )
                <div class="form-info">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('migrate_user') }}</li>
		        </ul>
                </div>
        @else
        	<p>To create your new password please complete the form below.</p>
        @endif
	<form class="form" id="create-password-form" action="/auth/create-password" method="post" novalidate>
               
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
        @if (Session::has('error'))
        	<div class="form-message">
        		<ul>                
		               <li><i class="icon-info"></i> {{ Session::get('error') }}</li>
		        </ul>
            </div>
        @endif

        @if ($tokenValid)
		<div class="form__row">
			<label for="password">New Password:</label>
			<input type="password" name="password" id="password" placeholder="Enter your new password" />
		</div>
		<div class="form__row">
			<label for="password_confirmation">Confirm New Password:</label>
			<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new password" />
		</div>
                <input type="hidden" name="user_id" value="{{ $User->id }}" />
                <input type="hidden" name="password_reset_token" value="{{ $User->remember_token }}" />
		<input type="submit" value="Save" />
        @endif 
        
	</form>
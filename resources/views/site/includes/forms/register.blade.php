
    @if ($errors->all())  
    	<div class="form-message">                  
    		<ul>
        	@foreach($errors->all() as $error)
           		<li><i class="icon-info"></i> {{ $error }}</li>
           	</ul>
        	@endforeach
        </div>
    @endif
                        
	<p>To register please complete the form below.</p>

	<form class="form" id="register-form" action="/auth/register" method="post" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
		<div class="form__row">
			<label for="user_firstname">Firstname</label>
			<input type="text" name="user_firstname" value="{{ old('user_firstname') }}" id="user_firstname" placeholder="Enter your firstname" />
		</div>
		<div class="form__row">
			<label for="user_surname">Surname</label>
			<input type="text" name="user_surname" value="{{ old('user_surname') }}" id="user_surname" placeholder="Enter your surname" />
		</div>
		<div class="form__row">
			<label for="email">Email</label>
			<input type="text" name="email" value="{{ old('email') }}" id="email" placeholder="Enter your email" />
		</div>
		<div class="form__row">
			<label for="user_password">Password</label>
			<input type="password" name="user_password" id="user_password" placeholder="Choose a password" />
		</div>
		<div class="form__row">
			<label for="user_password_confirm">Please confirm your password</label>
			<input type="password" name="user_password_confirm" id="user_password_confirm" placeholder="Confirm your password" />
		</div>

		<div class="form__row--checkbox">
			<input type="checkbox" name="terms_agree" id="terms_agree" />
			<label for="terms_agree">I agree to the <a href="/terms" target="_blank">terms and conditions</a></label>
		</div>
		<input type="submit" value="Register" />
	</form>
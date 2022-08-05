
	<p>Please enter your exisiting password for security reasons and then your new password twice.</p>

	<form class="form" id="change-password-form" action="" method="post" novalidate>
               
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

        <div class="form__row">
			<label for="password">Existing Password:</label>
			<input type="password" name="password" id="password" placeholder="Enter your existing password" />
		</div>
		<div class="form__row">
			<label for="new_password">New Password:</label>
			<input type="password" name="new_password" id="new_password" placeholder="Enter your new password" />
		</div>
		<div class="form__row">
			<label for="password_confirmation">Confirm New Password:</label>
			<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new password" />
		</div>
		<input type="submit" value="Save" />

	</form>
        
                 
	<form class="form" id="login-form" action="/auth" method="post" novalidate>
               
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
        @if ( Session::has('info') )
            <div class="form-message form-message-success">
        		<ul>                
		            <li><i class="icon-info"></i> {{ Session::get('info') }}</li>
		        </ul>
            </div>
        @endif

		<h2>Login</h2>
		<div class="form__row">
			<label for="user_email">Email:</label>
			<input type="text" name="user_email" id="user_email" value="{{ old('user_email') }}" placeholder="Enter your email address" />
		</div>
		<div class="form__row">
			<label for="user_password">Password:</label>
			<input type="password" name="user_password" id="user_password" placeholder="Enter your password" />
		</div>

		{{-- <div class="form__row--checkbox">			
			<input type="checkbox" name="user_remember" id="user_remember" />
			<label for="user_remember">Remember me</label>
		</div> --}}

		<div class="form__row">
			<a href="/auth/reset-password">I forgot my password</a>
		</div>
		<input type="submit" value="Login" />

	</form>
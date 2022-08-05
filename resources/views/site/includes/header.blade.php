
	<!-- header -->
	<header class="header">

		<div class="simplegrid nomb">
			<div class="column column__100">
				
				<a class="header__logo" href="/">Ricoh Arena Official Parking</a>

				<div class="header__links tb-hide">

					@if( \Auth::user() )
                        <p>Welcome <strong>{{ \Auth::user()->firstname }}</strong></p>
						<a class="header__link" href="/account"><i class="icon-user"></i>Your Account</a>

						@if( ! \Auth::user()->isImpersonating() )
						<a class="header__link" href="/auth/logout"><i class="icon-user-minus"></i> Logout</a>
						@endif

					@else
						<a class="header__link" href="/auth/"><i class="icon-user"></i> Login / Register</a>
					@endif

					<a class="header__link" href="/basket/"><i class="icon-cart"></i> Basket</a>

				</div>

				@if( \Auth::user() )
					<div class="account-icon">
						<a href=""><i class="icon-user"></i></a>
					</div>
				@endif

				<div class="navicon">
					<a class="js-nav-open" href=""><i class="icon-menu2"></i></a>
				</div>

			</div>
		</div>

	</header>
	<!-- end header -->
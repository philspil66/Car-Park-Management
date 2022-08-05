
	<!-- navigation (mobile only) -->
	<nav class="nav--mobile">
		<div class="nav__inner">

			@foreach($navigation as $nav)
		    	<a href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
		    @endforeach

		   	@if( \Auth::user() )
				<a href="/account"><i class="icon-user"></i>Your Account</a>
				<a href="/auth/logout"><i class="icon-user-minus"></i> Logout</a>
			@else
				<a class="header__link" href="/auth/"><i class="icon-user"></i> Login / Register</a>
			@endif

			<a href="/basket"><i class="icon-cart"></i> Basket</a>

		</div>
		<a class="nav__close js-nav-close" href="#"><i class="icon-close"></i></a>
	</nav>
	<!-- end navigation (mobile only) -->
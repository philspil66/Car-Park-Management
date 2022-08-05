
	<?php

		$account_navigation = array(
			['title' => 'Your Upcoming Events', 'link' => 'account']/*,
			['title' => 'Change Password', 'link' => 'account/change-password']*/
		);
	?>

	<nav class="nav--account--mobile">

		<div class="nav__inner">

			<h2><i class="icon-user"></i> Your Account</h2>
			
			@if(count($account_navigation))

                @foreach($account_navigation as $nav)
                    @if( Request::path() == $nav['link'] )
                        <a class="active" href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
                    @else
                        <a href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
                    @endif
                @endforeach

            @endif

		</div>
		<a class="nav__close" href="#"><i class="icon-close"></i></a>

	</nav>
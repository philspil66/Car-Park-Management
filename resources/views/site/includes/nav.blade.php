
	<!-- navigation -->
	<nav class="nav tb-hide">
		<div class="simplegrid nomb">
			<div class="column column__100">

			@if(count($navigation))

			    @foreach($navigation as $nav)

			    	<?php
			    		$current_url = Request::path();
			    		if($current_url != '/'){
			    			$current_url = '/' . $current_url;
			    		}
			    	?>

			    	@if( $current_url == $nav['link'] )
			    		<a class="active" href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
			    	@else
			    		<a href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
			    	@endif

			    @endforeach
			  @endif

			</div>
		</div>
	</nav>
	<!-- end navigation -->
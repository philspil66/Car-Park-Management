
	<?php

		$steps = array(
			"Your Details",
			"Payment",
			"Completed"
		);

		if( !isset($active_step) )
			$active_step = 0;

	?>
	
	<div class="checkout--steps">

		@foreach($steps as $key => $step)
			<?php 
				$active_class = ($active_step == ($key + 1)) ? ' active' : '';
			?>

			<div class="checkout--steps__step {{ $active_class }}"><strong>{{ $key + 1 }}</strong> {{ $step }}</div>
		@endforeach

	</div>
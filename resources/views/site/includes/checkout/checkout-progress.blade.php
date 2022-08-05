
	<?php
		if( !isset($active_step) )
			$active_step = 1;
	?>

	<div class="checkout--progress">

		<div class="checkout--progress__bars">
			<div class="checkout--progress__bar <?php if( $active_step > 1): echo ' active'; endif; ?>"></div>
			<div class="checkout--progress__bar <?php if( $active_step > 2): echo ' active'; endif; ?>"></div>

			<div class="checkout--progress__step step1 <?php if( $active_step > 0): echo ' active'; endif; ?>"></div>
			<div class="checkout--progress__step step2 <?php if( $active_step > 1): echo ' active'; endif; ?>"></div>
			<div class="checkout--progress__step step3 <?php if( $active_step > 2): echo ' active'; endif; ?>"></div>
		</div>

		<div class="checkout--progress__text">
			<div class="checkout--progress__text--left <?php if( $active_step > 0): echo ' active'; endif; ?>">Your Details</div>
			<div class="checkout--progress__text--center <?php if( $active_step > 1): echo ' active'; endif; ?>">Payment</div>
			<div class="checkout--progress__text--right <?php if( $active_step > 2): echo ' active'; endif; ?>">Completed</div>
		</div>

	</div>
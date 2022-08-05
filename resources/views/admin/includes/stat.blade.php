
	<div class="stat <?php if( isset($data['large']) ){ echo ' stat-large'; } ?>">

		@if( isset($data['title']) )
			<p class="stat__title">{{ $data['title'] }}</p>
		@endif

		@if( isset($data['stat']) )
			<p class="stat__number">

				@if( strpos($data['stat'], '/') !== false)
					<?php
						$stats = explode('/', $stat);
						$stats_string = '';

						foreach($stats as $key => $stat){
							if($key == 0){
								$stats_string .= '<span class="first">' . $stat . '</span>';
							}
							else{
								$stats_string .= '<span>' . $stat . '</span>';
							}

							if( count($stats) != ($key + 1)){
								$stats_string .= '<span class="stats__separator">/</span>';
							}
						}

						echo $stats_string;

					?>
				@else
					{{ $data['stat'] }}
				@endif

			</p>
		@endif

		@if( isset($data['description']) )
			<p class="stat__description">{{ $data['description'] }}</p>
		@endif

	</div>
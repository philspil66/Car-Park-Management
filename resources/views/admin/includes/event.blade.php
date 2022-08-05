
	<?php 
		$allocated_percentage = 0; 
		$remaining_percentage = 0;	

		// calculate allocated percentage and remaining percentage (overall total for all car parks on the event)
		if( $allocatedBar[$event->id]['total'] != 0){	

			$allocated_percentage = \App\Classes\Tools::calculate_percentage( 
										$allocatedBar[$event->id]['used'], 
										$allocatedBar[$event->id]['total']  );

			$remaining_percentage = 100 - $allocated_percentage;
		}
	?> 

	{{--event card --}}
	<div class="event {{ $event->status }}">
		
		<div class="event__status"><i class="icon-info"></i> This event is inactive</div>
		<div class="event__inner">
		
            <a class="event__title" href="/admin/events/event?id={{ $event->id }}">{{ $event->title }}</a>
			<p>
				<i class="icon-calendar"></i> {{ \App\Classes\Tools::dateformat( $event->date) }}&nbsp;&nbsp;
				<i class="icon-clock"></i> {{ \App\Classes\Tools::timeformat($event->time) }}
			</p>

			<div class="dropdown--wrapper">
				<a class="button button--dropdown" href="">Actions <i class="icon-arrow"></i></a>
				<div class="dropdown">
					<a href="/admin/events/event-create-edit?id={{ $event->id }}"><i class="icon-cogs"></i> Edit</a>
					<a href="/admin/events/event?id={{ $event->id }}"><i class="icon-cogs"></i> Car Parks</a>
				</div>
			</div>

			<div class="event__flag"></div>
			<div class="event__icon {{ $event->slug }}"></div>
		</div>

		<div class="event__progress">
			<div class="event__progress__scale"></div>
			<div class="event__progress__scale"></div>
			<div class="event__progress__scale"></div>
			<div class="event__progress__scale"></div>
			<div class="event__progress__scale"></div>

			<?php 
				$progress_class = ''; 
				if( $remaining_percentage <= _STATUS_RED_ ){
					$progress_class = 'red';
				}
				else if( $remaining_percentage <= _STATUS_AMBER_ ){
					$progress_class = 'amber';
				}
			?>

			<div class="event__progress__bar {{ $progress_class }}" style="width: {{ $allocated_percentage }}%;"></div>
		</div>

	</div>
	{{-- end event card --}}
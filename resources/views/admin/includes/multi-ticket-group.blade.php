
	{{-- multi ticket group card --}}
	<div class="multi--ticket--group {{ $multi_ticket_group->id }}">						
		<div class="multi--ticket--group__status">
			<i class="icon-info"></i> This multi ticket group is inactive
		</div>
		<div class="multi--ticket--group__inner">
		
            <a class="multi--ticket--group__title" href="/admin/multi-tickets/carparks?id={{ $multi_ticket_group->id }}">
            	{{ $multi_ticket_group->name }}
            </a>

			<div class="dropdown--wrapper">
				<a class="button button--dropdown" href="">Actions <i class="icon-arrow"></i></a>
				<div class="dropdown">
					<a href="admin/multi-tickets/create-edit?id={{ $multi_ticket_group->id }}"><i class="icon-cogs"></i> Edit</a>
					<a href="admin/multi-tickets/carparks?id={{ $multi_ticket_group->id }}"><i class="icon-cogs"></i> Car Parks</a>
				</div>
			</div>

			<div class="multi--ticket--group__flag"></div>
			<div class="multi--ticket--group__icon"></div>
		</div>

		<div class="multi--ticket--group__progress">
			<div class="multi--ticket--group__progress__scale"></div>
			<div class="multi--ticket--group__progress__scale"></div>
			<div class="multi--ticket--group__progress__scale"></div>
			<div class="multi--ticket--group__progress__scale"></div>
			<div class="multi--ticket--group__progress__scale"></div>

			<div class="multi--ticket--group__progress__bar" style="width: 50%;"></div>
		</div>

	</div>
	{{-- end multi ticket group card --}}

	<div class="impersonate">	
		<div class="impersonate__inner">
			<p>
				<i class="icon-warning"></i> 
				You are impersonating <strong>{{ \Auth::user()->getFullname() }}</strong> 
			</p>
			<a class="button button--small" href="/admin/stop-impersonating">stop impersonating</a>
		</div>
	</div>
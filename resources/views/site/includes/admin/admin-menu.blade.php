	
	<div class="admin--menu">
		<div class="simplegrid">
			<div class="column column__50">
				<p>Hi <strong>{{ \Auth::user()->firstname }}</strong>, you are logged in as an admin user.</p>
			</div>
			<div class="column column__50">
				<a class="button button--small" href="/admin/"><i class="icon-cogs"></i> View Admin</a>
			</div>
		</div>
	</div>
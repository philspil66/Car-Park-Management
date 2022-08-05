	
	{{-- event multi ticket --}}
	<div class="form--edit">

		<div class="form--edit__head">
			<div class="form--edit__head__left">
				<h2>Multi Ticket Group Name</h2>
			</div>
			<div class="form--edit__head__right">
				<div class="form--edit__info">					
					<div class="info">
						<p>status</p>
						<p>offline</p>
					</div>
					<div class="info">
						<p>total allocated</p>
						<p>0</p>
					</div>
				</div>
				<div class="form--edit__actions">

					<div class="dropdown--wrapper">
						<a class="button button--dropdown" href="">Actions <i class="icon-arrow"></i></a>
						<div class="dropdown">

							<a class="js-panel-switch" href="" 
								data-parent-elem='.form--edit'
							   	data-visible-panels='[".form--edit__form--edit"]'
							   	data-hidden-panels='[".form--edit__stats", ".form--edit__form--delete"]'>
								<i class="icon-cogs"></i> Edit
							</a>
						
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="form--edit__panel">
			<div class="form--edit__form form--edit__form--edit">
				<form class="form--standard" action="" method="post">

					<div class="grid">
						<div class="column__50">
							<div class="form--standard__row">
								<label>Status:</label>
		                        <select name="">
									<option value="">-- select status --</option>
								</select>
							</div>
						</div>
					</div>
					
					<input class="button--submit" type="submit" value="Save" />
					<a class="button button--outline js-panel-switch" href="" 
						data-parent-elem='.form--edit'
					   	data-visible-panels=''
					   	data-hidden-panels='[".form--edit__form--edit"]'>
						Cancel
					</a>

				</form>
			</div>
		</div>
	</div>
	{{-- end event multi ticket --}}

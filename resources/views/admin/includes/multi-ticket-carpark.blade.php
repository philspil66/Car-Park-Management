
	{{-- multi ticket carpark --}}
	<div class="form--edit">

		<div class="form--edit__head">
			<div class="form--edit__head__left">
				<h2>Carpark Name</h2>
			</div>
			<div class="form--edit__head__right">
				
				<div class="form--edit__info">
					<div class="info">
						<p>status</p>
						<p>status</p>
					</div>
					<div class="info">
						<p>allocated</p>
						<p>0</p>
					</div>
					<div class="info">
						<p>price</p>
						<p>&pound;100</p>
					</div>
				</div>

				<div class="form--edit__actions">
					<div class="dropdown--wrapper">
						<a class="button button--dropdown" href="">Actions <i class="icon-arrow"></i></a>
						<div class="dropdown">

							<a class="js-panel-switch" href="" 
								data-parent-elem='.form--edit'
							   	data-visible-panels='[".form--edit__form--edit"]'
							   	data-hidden-panels=''>
								<i class="icon-cogs"></i> Edit
							</a>
						
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="multi--ticket--carppark__panel">

			<div class="form--edit__form form--edit__form--edit">

				<form class="form--standard edit-car-park" action="" method="post">

					<div class="grid">
						<div class="column__33">			
							<div class="form--standard__row">
								<label>Price:</label>
                        		<input autocomplete="off" class="price-input" type="text" name="" id="" value="" placeholder="£" />
							</div>
						</div>
						<div class="column__33">							
							<div class="form--standard__row">
								<label>Allocated:</label>
								<input class="allocated-input" type="text" name="" id="" value="" data-masked-input="99999" />	
							</div>							
						</div>
						<div class="column__33">
								
							<label>Status:</label>
	                        <select class="status-select" name="product_status">
								<option value="status">Status</option>
								<option value="status">Status</option>
								<option value="status">Status</option>
							</select>

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
	{{-- end multi ticket carpark --}}

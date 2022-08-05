
	<div class="form--add">
		<div class="helper__align--right">
			<a class="button js-panel-switch" href="" data-parent-elem='.tabs--content__panel'
			   data-visible-panels='[".form--add__form"]' data-hidden-panels='[]'>
				<i class="icon-plus"></i> Add Car Park
			</a>
		</div>
	</div>

    {{-- messages --}}
    @if ( true )	{{-- success --}}
        <div class="msg msg-success">
        <ul>                
            <li><i class="icon-info"></i> success message</li>
        </ul>
        </div>
    @endif

    @if ( true )	{{-- error --}}
        <div class="msg msg-error">
        <ul>                
            <li><i class="icon-info"></i> error message</li>
        </ul>
        </div>
    @endif
                
	<form class="form--standard" action="" method="post" novalidate>
		<div class="form--add__form">

			<div class="form--add__form__head">
				<div class="grid">
					<div class="column__50">
						
                        <select name="product_car_park_id">
							<option value="">
								Please select a carpark to add to the multi ticket group
							</option>
                            <option value="">car park name</option>
                            <option value="">car park name</option>
                            <option value="">car park name</option>
						</select>

					</div>
				</div>
			</div>
			<div class="form--add__form__panel">

				<div class="grid">
					<div class="column__33">
						<div class="form--standard__row">
							<label>Price:</label>
                            <input class="price-input" type="text" name="product_price" id="" value="" placeholder="£"/>
						</div>
					</div>
					<div class="column__33">
						<div class="form--standard__row">
							<label>Allocated:</label>
							<input class="allocated-input" type="text" name="product_allocated" id="allocated" value="" data-masked-input="99999" />
						</div>
					</div>
					<div class="column__33">
						<div class="form--standard__row">
							<label>Status:</label>
		                    <select class="status-select" name="product_status">
		                        <option value="">status</option>
		                        <option value="">status</option>
		                        <option value="">status</option>
							</select>
						</div>
					</div>
				</div>

				<input class="button--submit" type="submit" value="Save" />
				<a class="button button--outline js-panel-switch" href="" 
					data-parent-elem='.tabs--content__panel'
				   	data-visible-panels=''
				   	data-hidden-panels='[".form--add__form"]'>
					Cancel
				</a>

			</div>
        </div>
    </form>

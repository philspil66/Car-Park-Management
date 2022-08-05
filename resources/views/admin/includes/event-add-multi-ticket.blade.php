
	<div class="form--add">
		<div class="helper__align--right">
			<a class="button js-panel-switch" href="" data-parent-elem='.tabs--content__panel'
			   data-visible-panels='[".form--add__form"]' data-hidden-panels='[]'>
				<i class="icon-plus"></i> Add Multi Ticket To Event
			</a>
		</div>
	</div>

	{{-- messages --}}
	{{-- success --}}
    @if ( true )
        <div class="msg msg-success">
        <ul>                
            <li><i class="icon-info"></i> success message</li>
        </ul>
        </div>
    @endif

    {{-- error --}}
    @if ( true )
        <div class="msg msg-error">
        <ul>                
            <li><i class="icon-info"></i> error message</li>
        </ul>
        </div>
    @endif

    <form class="form--standard" action="" method="post" novalidate>	
		<div class="form--add__form">
			<div class="form--add__form__head">						
                <h2>Select a multi ticket group to add to the event</h2>
			</div>
			<div class="form--add__form__panel">

				<div class="grid">
					<div class="column__50">
						<div class="form--standard__row">	
							<select id="event__add__carpark__dropdown" name="product_car_park_id">
								<option value="">-- select multi ticket group --</option>
								<option value="id" data-car-park-capacity="">multi ticket group</option>
								<option value="id" data-car-park-capacity="">multi ticket group</option>
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
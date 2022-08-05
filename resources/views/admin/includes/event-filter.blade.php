	
	<form class="form--standard" action="/admin/events" method="post" novalidate>
      		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

		<div class="filter">

			<div class="form--inline__row">
			<h3>Sort by</h3>
			</div>

			<div class="form--inline__row">
				<select name="orderBy" id="">
					<option value="">-- order by --</option>
                                        @foreach($orderBy as $k=>$v)
                                            @if( $fields[_FILTER_TEXT_ORDER_BY_] == $k)
                                                <option selected="selected" value="{{ $k }}">{{ $v }}</option>
                                            @else
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endif    
                                        @endforeach
				</select>
			</div>

			<div class="form--inline__row">
				<select name="categoryId" id="">
					<option>-- categories --</option>
					<option value="0">All</option>
                                        @foreach($Categories as $Category)
                                            @if( $fields[_FILTER_TEXT_CAT_ID_] == $Category->id)
        					<option selected="selected" value="{{ $Category->id }}">{{ $Category->lang->description }}</option>
                                            @else
        					<option value="{{ $Category->id }}">{{ $Category->lang->description }}</option>
                                            @endif
                                        @endforeach
				</select>
			</div>

			<div class="form--inline__row">
				<select name="status" id="">
					<option>-- status --</option>
                                        @foreach($status as $k=>$v)
                                            @if( $fields[_FILTER_TEXT_STATUS_] == $k)
        					<option selected="selected" value="{{ $k }}">{{ $v }}</option>
                                            @else
        					<option value="{{ $k }}">{{ $v }}</option>
                                            @endif
                                        @endforeach
				</select>
			</div>

			<div class="form--inline__row">
                            @if( (BOOL)$fields[_FILTER_TEXT_INC_OLD_] )
				<input type="checkbox" checked='checked' name="includeOld" value="true" id="" /> <label class="inline">Show past events</label>
                            @else
				<input type="checkbox" name="includeOld" id="" value="true" /> <label class="inline">Show past events</label>
                            @endif
			</div>

			<div class="form--inline__row">
                            <input class="button--submit" type="submit" name="submit" value="Apply" />
			</div>

		</div>
	</form>

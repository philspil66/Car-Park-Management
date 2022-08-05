@extends('layouts.admin')

@section('content')

    <?php
    $breadcrumb = array(
            ['title' => 'Car Parks', 'url' => '/admin/carparks'],
            ['title' => $addAmendForm['mode'] . ' Car Park']
    )
    ?>

    @include('admin.includes.breadcrumb', $breadcrumb)

    <div class="site-wrapper__inner">

        <div class="panel">
            <div class="panel__header">
                <h1>Car Parks</h1>
            </div>
            <div class="panel__body">

                {{-- tabs --}}
                <div class="tabs">
                    <a href="/admin/carparks">All Car Parks</a>
                    <a class="active" href="/admin/carparks/add-edit">{{ $addAmendForm['mode'] }}</a>
                </div>
                <div class="tabs--content">
                    <div class="tabs--content__panel active">
                        <div class="tabs--content__spacer">

                            {{-- form panel --}}
                            <div class="form--panel">

                                @if ($errors->all())
                                    <div class="msg msg-error">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li><i class="icon-info"></i> {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <p>Please use the form below to {{ $addAmendForm['mode'] }} a car park.</p>
                                <form class="form--standard" action="/admin/carparks/add-edit" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="mode" value="">
                                    <input type="hidden" name="car_park_id"
                                           value="{{ $addAmendForm['carParkId'] or '' }}">

                                    {{-- name --}}
                                    <div class="grid">
                                        <div class="column__66">
                                            <div class="form--standard__row">
                                                <label for="car_park_name">Name <span>*</span></label>
                                                <input type="text" name="car_park_name" id="car_park_name"
                                                       value="{{ old('car_park_name', $addAmendForm['name']) }}"/>
                                            </div>
                                        </div>
                                        {{-- car park owners from users table --}}
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="owners">Owners <span>*</span></label>
                                                <select name="owners" id="owners">
                                                    <option value="">-- choose an owner --</option>
                                                    @foreach($addAmendForm['owners'] as $ownerId => $ownerName )

                                                        <option value="{{ old('owners',$ownerId) }}"
                                                                @if(isset($addAmendForm['owner']) && $addAmendForm['owner']==$ownerId)
                                                                    selected
                                                                @endif;
                                                        >{{ $ownerName }}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- sku, capacity and featured --}}
                                    <div class="grid">
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_sku">Sku <span>*</span></label>
                                                <input type="text" name="car_park_sku" id="car_park_sku"
                                                       value="{{ old('car_park_sku', $addAmendForm['sku']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_capacity">Capacity <span>*</span></label>
                                                <input type="text" name="car_park_capacity" id="car_park_capacity"
                                                       value="{{ old('car_park_capacity', $addAmendForm['capacity']) }}"
                                                       data-masked-input="99999"/>
                                            </div>
                                        </div>
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_featured">Featured <span>*</span></label>
                                                <select name="car_park_featured" id="car_park_featured">
                                                    <option value="">-- choose an option --</option>

                                                    {{--*/ $featured_option = array('false','true') /*--}}
                                                    {{--*/
                                                        $featured = old('car_park_featured', $addAmendForm['featured'])
                                                    /*--}}

                                                    @foreach($featured_option as $option )
                                                        @if( $featured == $option )
                                                            {{--*/ $selected = 'selected' /*--}}
                                                        @else
                                                            {{--*/ $selected = '' /*--}}
                                                        @endif
                                                        <option value="{{ $option }}" {{ $selected }}>{{ $option }}</option>
                                                        }
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- lat, long and priority --}}
                                    <div class="grid">
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_lat">Lat</label>
                                                <input type="text" name="car_park_lat" id="car_park_lat"
                                                       value="{{ old('car_park_lat', $addAmendForm['lat']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_long">Lng</label>
                                                <input type="text" name="car_park_long" id="car_park_long"
                                                       value="{{ old('car_park_long', $addAmendForm['long']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__33">
                                            <div class="form--standard__row">
                                                <label for="car_park_priority">Priority</label>
                                                <input type="text" name="car_park_priority" id="car_park_priority"
                                                       value="{{ old('car_park_priority', $addAmendForm['priority']) }}"
                                                       data-masked-input="99"/>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- description and directions --}}
                                    <div class="grid">
                                        <div class="column__100">
                                            <div class="form--standard__row">
                                                <label for="car_park_description">Description</label>
                                                <textarea name="car_park_description" id="car_park_description"
                                                          rows="5">{{ old('car_park_description', $addAmendForm['description']) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="column__100">
                                            <div class="form--standard__row">
                                                <label for="car_park_description">Directions</label>
                                                <textarea name="car_park_directions" id="car_park_directions"
                                                          rows="10">{{ old('car_park_directions', $addAmendForm['directions']) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form--standard__row">
                                        <input class="button--submit" type="submit"
                                               value="{{ $addAmendForm['mode'] }} Car Park"/>
                                    </div>

                                </form>
                                {{-- end form panel --}}

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
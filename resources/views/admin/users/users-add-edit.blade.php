@extends('layouts.admin')

@section('content')

    <?php
    $breadcrumb = array(
            ['title' => 'Users', 'url' => '/admin/users'],
            ['title' => $addAmendForm['mode'] . ' User']
    )
    ?>

    @include('admin.includes.breadcrumb', $breadcrumb)

    <div class="site-wrapper__inner">

        <div class="panel">
            <div class="panel__header">
                <h1>Users</h1>
            </div>
            <div class="panel__body">

                {{-- tabs --}}
                <div class="tabs">
                    <a href="/admin/users">All Users</a>
                    <a class="active" href="/admin/users/add-edit">{{ $addAmendForm['mode'] }}</a>
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

                                <p>Please use the form below to {{ $addAmendForm['mode'] }} a user</p>
                                <form class="form--standard" action="/admin/users/add-edit" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="mode" value="">
                                    <input type="hidden" name="user_id"
                                           value="{{ $addAmendForm['userId'] or '' }}">
                                    <input type="hidden" name="address_id"
                                           value="{{ $addAmendForm['addresses']['address_id'] or '' }}">

                                    {{-- description and type fields --}}
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="user_role">Role: <span>*</span></label>
                                                <select name="user_role" id="user_role">
                                                    <option value="">-- choose a role --</option>
                                                    @foreach($addAmendForm['roles'] as $role)
                                                        {{--add assigned role if this is an update--}}


                                                        <option value="{{$role->id}}"
                                                        @if(isset($addAmendForm['role_id']))
                                                            {{($role->id == $addAmendForm['role_id'])?'selected':''}}
                                                                @endif
                                                        >{{$role->role}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="status">Status:</label>
                                                <select name="status" id="status">
                                                    <option value="active" @if($addAmendForm['status']=='active')
                                                    selected
                                                            @endif>Active
                                                    </option>
                                                    <option value="inactive" @if($addAmendForm['status']=='inactive')
                                                    selected
                                                            @endif>Inactive(Delete)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="telephone">Telephone:</label>
                                                <input type="text" name="telephone" id="telephone"
                                                       value="{{ old('telephone', $addAmendForm['telephone']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="email">Email: <span>*</span></label>
                                                <input type="text" name="email" id="email"
                                                       value="{{ old('email', $addAmendForm['email']) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="user_firstname">First Name:</label>
                                                <input type="text" name="user_firstname" id="user_firstname"
                                                       value="{{ old('user_firstname', $addAmendForm['firstname']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="user_lastname">Last Name:</label>
                                                <input type="text" name="user_lastname" id="user_lastname"
                                                       value="{{ old('user_lastname', $addAmendForm['lastname']) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="address1">Address1:</label>
                                                <input type="text" name="address1"
                                                       id="address1"
                                                       value="{{ old('address1', $addAmendForm['addresses']['address1']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="address2">Address2:</label>
                                                <input type="text" name="address2"
                                                       id="address2"
                                                       value="{{ old('address2', $addAmendForm['addresses']['address2']) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="address1">Post Code:</label>
                                                <input type="text" name="postcode"
                                                       id="postcode"
                                                       value="{{ old('postcode', $addAmendForm['addresses']['postcode']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="town">Town:</label>
                                                <input type="text" name="town"
                                                       id="town"
                                                       value="{{ old('town', $addAmendForm['addresses']['town']) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid">
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="county">County:</label>
                                                <input type="text" name="county"
                                                       id="county"
                                                       value="{{ old('county', $addAmendForm['addresses']['county']) }}"/>
                                            </div>
                                        </div>
                                        <div class="column__50">
                                            <div class="form--standard__row">
                                                <label for="country">Country:</label>
                                                <input type="text" name="country"
                                                       id="country"
                                                       value="{{ old('country', $addAmendForm['addresses']['country']) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form--standard__row">
                                        <input class="button--submit" type="submit"
                                               value="{{ $addAmendForm['mode'] }} User"/>
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
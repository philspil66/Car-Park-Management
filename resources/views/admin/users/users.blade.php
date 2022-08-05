@extends('layouts.admin')

@section('content')

    <?php
    $breadcrumb = array(
            ['title' => 'Users', 'url' => '/admin/users']
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
                    <a class="active">All Users</a>
                    <a href="/admin/users/add-edit" class="">Add</a>
                </div>
                <div class="tabs--content">
                    <div class="tabs--content__panel active">
                        <div class="tabs--content__spacer">
                            @if ( Session::has('success') )
                                <div class="msg msg-success">
                                    <ul>
                                        <li><i class="icon-info"></i> {{ Session::get('success') }}</li>
                                    </ul>
                                </div>
                            @endif
                            {{-- custom search for datatables --}}
                            <div class="helper__align--right">
                                <form class="form--standard">
                                    <div class="form--inline__row">
                                        <label for="search_input">Search: </label>
                                        <input class="search-input" id="search_input" type="text"
                                               style="min-width: 400px;"/>
                                    </div>
                                    <div class="form--inline__row">
                                        <select class="search-column" style="margin-right: 0;">
                                            <option value="firstname">Firstname</option>
                                            <option value="lastname" selected>Lastname</option>
                                            <option value="role">Role</option>
                                            <option value="email">Email</option>
                                            <option value="postcode">Post Code</option>
                                            <option value="action">Actions</option>
                                        </select>
                                    </div>
                                </form>
                            </div>

                            {{-- datatable --}}
                            <div class="table--wrapper">
                                <table class="table--base" id="users-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            ID
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>
                                            First Name
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>
                                            Last Name
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>
                                            Email
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>
                                            Role
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>
                                            Post Code
                                            <i class="icon-filter"></i>
                                            <i class="icon-filterup"></i>
                                            <i class="icon-filterdown"></i>
                                        </th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            {{-- end datatable --}}

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

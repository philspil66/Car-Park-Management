
    <header class="header">

        <div class="header__home">
            <a class="link" href="/admin/"><i class="icon-home"></i> Ricoh Parking Admin</a>

            <a class="header__menu__icon" href="">
                <span><i class="icon-menu"></i></span>
            </a>
        </div>

        <div class="header__bar">

            @if( \Auth::user() and \Auth::user()->role->lang->name == _ROLE_ADMIN_TEXT_ )

                <div class="header__user">
                    Hello <strong> {{ \Auth::user()->firstname }}</strong> |
                    <a href="/">View Live Site</a> |
                    <a href="/auth/logout">Logout</a>
                </div>

            @endif

            {{-- <div class="header__search__link">
                <a href=""><i class="icon-search"></i></a>
            </div>

            <div class="header__search">
                <input type="text" name="" id="" />
            </div> --}}

        </div>

    </header>
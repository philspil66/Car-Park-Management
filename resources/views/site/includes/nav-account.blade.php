
    <?php
        $account_navigation = array(
            ['title' => 'Your Upcoming Events', 'link' => 'account']/*,
            ['title' => 'Change Password', 'link' => 'account/change-password']*/
        );
    ?>

    <div class="nav-account tb-hide">
         <div class="simplegrid">
            <div class="column column__100">
                
                <p><i class="icon-user"></i> Your account</p>

                @if(count($account_navigation))

                    <nav>
                        @foreach($account_navigation as $nav)
                            @if( Request::path() == $nav['link'] )
                                <a class="button button--small active" href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
                            @else
                                <a class="button button--small" href="{{ $nav['link'] }}">{{ $nav['title'] }}</a>
                            @endif
                        @endforeach
                    </nav>

                @endif

            </div>
        </div>
    </div>
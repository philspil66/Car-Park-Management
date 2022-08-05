
	<?php

        $menu = array(

            array(
                "title" => "Events",
                "link_url" => "/admin/events",  
            ),
            array(
                "title" => "Orders",
                "link_url" => "/admin/orders",  
            ),
            array(
                "title" => "Users",
                "link_url" => "/admin/users",  
            ),
            array(
                "title" => "Multi Tickets",
                "link_url" => "/admin/multi-tickets",  
            ),
            array(
                "title" => "Categories",
                "link_url" => "/admin/categories",  
            ),
            array(
                "title" => "Car Parks",
                "link_url" => "/admin/carparks",  
            ),
            array(
                "title" => "Teams",
                "link_url" => "/admin/teams",  
            ),
            array(
                "title" => "Wastage Reasons",
                "link_url" => "/admin/wastage-reasons",  
            )/*,    
            array(
                "title" => "Menu Item 2",
                "sub_menu" => array(
                    array(
                        "title" => "Sub Link 1",
                        "link_url" => "/sub1"
                    ),
                    array(
                        "title" => "Sub Link 2",
                        "link_url" => "/sub2"
                    ),
                )
            )*/

        );

    ?>

    <div class="menu">

        @if( isset($menu) )

            <ul class="menu__top">

                @foreach( $menu as $key => $item)

                    <li>

                        @if( isset($item['sub_menu']) )

                            <a href="#">
                                <i class="icon-cogs"></i> <span>{{ $item['title'] }}</span> <i class="icon-arrow"></i>
                            </a>

                            <ul class="menu__sub">
                                @foreach($item['sub_menu'] as $sub_menu)
                                    <li><a href="{{ $sub_menu['link_url'] }}"> {{ $sub_menu['title'] }}</a></li>
                                @endforeach
                            </ul>

                        @else

                            <a href="{{ $item['link_url'] }}">
                                <i class="icon-cogs"></i> <span>{{ $item['title'] }}</span>
                            </a>

                        @endif

                    </li>

                @endforeach

            </ul>

        @endif

    </div>
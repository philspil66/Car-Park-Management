<!DOCTYPE html>
<html>
<head>

	{{-- default meta values (used if none are supplied in views) --}}
	{{--*/
		$default_meta = '<title>' . _META_TITLE_ . '</title>' .
						'<meta name="description" content="'. _META_DESCRIPTION_ .'" />' . 
						'<meta name="keywords" content="' . _META_KEYWORDS_ . '" />';
	/*--}}

	@yield('meta', $default_meta)

	@include('site.includes.head-section')

</head>
<body>

	@if( \Auth::user() and \Auth::user()->role->lang->name == _ROLE_ADMIN_TEXT_ )		
		@include('site.includes.admin.admin-menu')
	@endif

	@if(\Auth::user() && \Auth::user()->isImpersonating() && \Auth::user()->role_id != _ROLE_ADMIN_)
		@include('site.includes.impersonate')
	@endif

	@include('site.includes.header')

	<?php

		// navigation array is used in nav and nav-mobile includes below to add nav links
		$navigation = array(
			['title' => 'Home', 'link'  => '/'],
			['title' => 'Events', 'link'  => '/events'],
			['title' => 'Season Tickets', 'link'  => '/season-tickets'],
			['title' => 'Car Parks', 'link'  => '/car-parks'],
			['title' => 'FAQ', 'link'  => '/faq']
		);

	?>

	@include('site.includes.nav', $navigation)

	@include('site.includes.nav-mobile', $navigation)

	@if( \Auth::user() )
		@include('site.includes.nav-account-mobile')
	@endif

	@yield('content')

	@include('site.includes.footer-alt')

	@yield('snippet-bottom')

</body>
</html>
<!DOCTYPE html>
<html>
<head>

	@include('admin.includes.head-section')

</head>
<body>

	@include('admin.includes.header')

	@include('admin.includes.menu')

	<div class="site-wrapper">
			
		@yield('content')

	</div>

	@include('admin.includes.overlay')

	<script type="text/javascript" src="/js/admin/admin-scripts.js"></script>

	@yield('snippet-bottom')

</body>
</html>



<!DOCTYPE HTML>
<html>
     @include('frontend.layouts.header')
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	@include('frontend.layouts.bodyheader')

	@yield('content')

	@include('frontend.layouts.bodyfooter')
	</div>

	@include('frontend.layouts.footer')

	</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.partials.meta')
	@include('admin.partials.css')
	@yield('styles')
</head>
<body>

<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
	<div class="page-sidebar">
		@include('admin.partials.aside')
  </div>
  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container gray-bg">

		<!-- Main header -->
		<div class="main-header row">
  		@include('admin.partials.header')
		</div>
		<!-- /main header -->

		<!-- Main content -->
		<div class="main-content">
			@yield('title')
			@include('admin.partials.flash_messages')
			@yield('content')
			<!-- Footer -->
			<footer style="position: fixed;left: 0;bottom: 0;width: 78.5%;" class="animatedParent animateOnce z-index-10">
				@include('admin.partials.footer')
			</footer>
			<!-- /footer -->

	  </div>
	  <!-- /main content -->

  </div>
  <!-- /main container -->

</div>
<!-- /page container -->

<!--Load JQuery-->
@include('admin.partials.js')
@yield('javascripts')
</body>
</html>

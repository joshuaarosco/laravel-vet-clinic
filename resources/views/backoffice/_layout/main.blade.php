<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://rhythm-admin-template.multipurposethemes.com/images/favicon.ico">

    <title>@stack('title') | {{config('app.name')}}</title>
    
	@include('backoffice._includes.styles')
     
  </head>

<body class="hold-transition light-skin sidebar-mini theme-success fixed">
	
<div class="wrapper">
	<div id="loader"></div>
	
  @include('backoffice._components.header')
  
  @include('backoffice._components.sidebar')

  @stack('content')
  @include('backoffice._components.footer')
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
	
	{{-- @include('backoffice._components.sticky') --}}
		
	{{-- @include('backoffice._components.chatbox') --}}
	
	<!-- Page Content overlay -->
  @include('backoffice._includes.scripts')
	@stack('js')
	
</body>

</html>

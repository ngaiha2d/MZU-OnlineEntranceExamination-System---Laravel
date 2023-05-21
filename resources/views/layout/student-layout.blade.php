
<!doctype html>
<html lang="en">
  <head>
  	<title>MZUOEE</title>
    <link rel = "icon" href = "https://iili.io/HOoZm11.png" type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>



  <body>
  <nav class="navbar1 bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      
      <b style="color:rgb(12, 81, 28);">MZU</b> <small style="font-family:MV Boli; color:rgb(12, 81, 28);">Online Entrance Examination</small>
     </a>
  </div>
</nav>
		<!-- menu on the admin dashboard -->
		<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="collapse d-lg-block bg-light">
  <div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
    <div class="position-sticky">
      <div class="list-group list-group-flush">
        
      <h1 ><a href="/dashboard" class="logo" ><i class="fa fa-user-circle" aria-hidden="true"></i> {{Auth::User()->name}} </a></h1>
      
        <a href="/admin/dashboard" class="list-group-item py-2  active ">
          <i class="fa fa-th-list mr-3"></i><span>Dashboard</span>
        </a>
        <a href="/logout" class="list-group-item  py-2 ripple active ">
          <i class="fa fa-sign-out mr-3"></i><span>Logout</span>
        </a>
        
        
      </div>
    </div>
  </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('space-work')
        </div>
		</div>

    <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->
     <script src="{{asset('js/popper.js')}}"></script> 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
</html>
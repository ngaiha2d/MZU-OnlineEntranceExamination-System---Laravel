
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

  <style>
    .navbar1 {
      border-color: #828487;
      padding-top: 0px; /* Adjust the top padding */
      padding-bottom: 0px; /* Adjust the bottom padding */
    }
  
    .navbar-brand {
      margin-right: 25px; /* Adjust the right margin for the brand logo */
    }
  
    .navbar-brand b {
      font-size: 24px; /* Adjust the font size of the brand logo */
    }
  
    .navbar-brand small {
      font-size: 17px; /* Adjust the font size of the small text */
    }
    .nav-link {
    color:rgb(43, 173, 180) ; /* Set the desired color */
    }

    .nav-link:hover {
      color: rgb(23, 94, 94); /* Set the desired hover color */
    }
  </style>

  <body>
    <nav class="navbar1 bg-light" style="border-color: #828487;">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="/homepage">
          <b style="color:rgb(32, 159, 168);">MZU</b> <small style="font-family:MV Boli; color:rgb(32, 159, 168);">Online Entrance Examination</small>
        </a>
        <a href="/logout" class="nav-link">
          <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
        </a>
      </div>
    </nav>

    
		<!-- menu on the admin dashboard -->
		<div class="wrapper d-flex align-items-stretch">

        <!-- Page Content  -->
        <div id="content" class="p-md-4">
          <h4 >Welcome <a href="/dashboard" class="logo" ><i class="fa fa-user-circle" aria-hidden="true"></i> {{Auth::User()->name}} </a></h4>
            @yield('space-work')
        </div>
		</div>

    <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->
     <script src="{{asset('js/popper.js')}}"></script> 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
</html>
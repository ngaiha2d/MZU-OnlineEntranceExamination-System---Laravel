<!doctype html>
<html lang="en">
<head>
  <title>MZUOEE ADMIN</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="https://iili.io/HOoZm11.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{ asset('js/multiselect-dropdown.js')}}"></script>
  <style>
    .tile {  
      width: 100%;
      display: inline-block;
      box-sizing: border-box;
      background: transparent;
      padding: 20px;
      margin-bottom: 30px;
      transition: background-color 0.3s ease;
      border-radius: 10px;
      border: 2px solid rgb(36, 138, 138);
    } 

    .tile:hover {
      background-color: rgba(121, 242, 248, 0.171);
    }

    .title {
      margin-top: 0px;
      color: #2e93a5;
      font-size: 40px;
      display: flex;
      align-items: center;
    }

    .title i {
      margin-right: 10px;
    }

    .purple, .blue, .red, .orange, .green {
      color: #fff;
    }
    
    .purple {
      background: #5133AB;
    }

    .purple:hover {
      background: darken(#000000, 10%);
    }	
    
    .red { 
      background: #AC193D;
    }

    .red:hover {
      background: darken(#000000, 10%);
    }		


    .green {
      background: #ffffff;
    }

    .green:hover {
      background: darken(#000000, 10%);
    }		


    .blue {
      background: #2672EC;
    }

    .blue:hover {
      background: darken(#000000, 10%);
    }	


    .orange {
      background: #DC572E;
    }

    .orange:hover {
      background: darken(#000000, 10%);
    }
    .nav-link {
    color:rgb(43, 173, 180) ; /* Set the desired color */
    }

    .nav-link:hover {
      color: rgb(23, 94, 94); /* Set the desired hover color */
    }
</style>
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
</style>

</head>

<body>
  <span>
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
    
  
  <div>
    @yield('space-work')
  </div>
</div>

  <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->
  <script src="{{asset('js/popper.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
</body>
</html>

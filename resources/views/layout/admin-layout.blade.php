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
    p, span, a, ul, li, button {
      font-family: inherit;
      font-size: inherit;
      font-weight: inherit;
      line-height: inherit;
    }

    strong {
      font-weight: 600;
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Open Sans', "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serify;
      line-height: 1.5em;
      font-weight: 300;	
    }

    strong {
      font-weight: 400;
    }

    .tile {  
      width: 100%;
      display: inline-block;
      box-sizing: border-box;
      background: #fff;		
      padding: 20px;
      margin-bottom: 30px;
      transition: background-color 0.3s ease;
      border-radius: 10px; /* Rounded border edges */
    } 

    .tile:hover {
      background-color: rgb(56, 138, 40);
    }

    .title {
      margin-top: 0px;
      color: #fff;
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
      background: darken(#5133AB, 10%);
    }	
    
    .red { 
      background: #AC193D;
    }

    .red:hover {
      background: darken(#AC193D, 10%);
    }		


    .green {
      background: #17a2b8;
    }

    .green:hover {
      background: darken(#ffffff, 10%);
    }		


    .blue {
      background: #2672EC;
    }

    .blue:hover {
      background: darken(#2672EC, 10%);
    }	


    .orange {
      background: #DC572E;
    }

    .orange:hover {
      background: darken(#DC572E, 10%);
    }
  </style>

</head>

<body>
  <nav class="navbar1 bg-light" style="border-color: #828487;">
    <div class="container-fluid">
      <a class="navbar-brand" href="/homepage">
        <b style="color:rgb(12, 81, 28);">MZU</b> <small style="font-family:MV Boli; color:rgb(12, 81, 28);">Online Entrance Examination</small>
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

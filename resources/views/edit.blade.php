@extends('layout/layout-common')

@section('space-work')

<h1>Register</h1>

@if($errors->any())
    @foreach($errors->all() as $error)
    <p style="color:red">{{ $error }}></p>
    @endforeach
@endif

<form action="{{route('studentRegister')}}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Enter name">
    <br><br>
    <input type="text" name="email" placeholder="Enter email">
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter Confirm  Password">
    <br><br>
    <input type="submit" value="Register">


</form>

    @if(Session::has('success'))
        <p style="color:green">{{Session::get('success') }}</p>
        <h5>You can <a href="/login"> here</a></h5>
    @endif

@endsection


<img src="https://iili.io/H9Dojl2.png" alt="H9Dojl2.png" border="0" /></a>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://iili.io/H9Dojl2.png" class="me-2" height="30"
        alt="MDB Logo" loading="lazy" />
      <small>Online Entrance Examination</small>
    </a>
  </div>
</nav>





@extends('layout/layout-common')


@section('space-work')


    
<br><br><br><br><br>
<div div class="mx-auto" style="width: 700px;">

<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="/login" role="tab"
      aria-controls="pills-login" aria-selected="true">Register</a>
  </li>
  
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">



  @if($errors->any())
    @foreach($errors->all() as $error)
    <p style="color:red">{{ $error }}></p>
    @endforeach
@endif
    <form action="{{route('userLogin')}}" method="POST">
    @csrf

      <!-- Email input -->
      <div class="form-outline mb-4">
        <br><br>
        <input type="text" name="name" placeholder="Enter name" style="width: 700px;">
        <br>
        <label class="form-label" for="loginName">Name</label>
      </div>
      <!-- Password input -->
      <div class="form-outline mb-4">
        <input type="text" name="email" placeholder="Enter email" style="width: 700px;">
        <label class="form-label" for="loginPassword">Enter email</label>
      </div>

      <div class="form-outline mb-4">
        <input type="password" name="password" placeholder="Enter Password" style="width: 700px;">
        <label class="form-label" for="loginPassword">Password</label>
      </div>

      <div class="form-outline mb-4">
        <input type="password" name="password_confirmation" placeholder="Enter Confirm  Password" style="width: 700px;">
        <label class="form-label" for="loginPassword">Password Confirmation</label>
      </div>

      <!-- 2 column grid layout -->
      <div class="row mb-4">
        <div class="col-md-6 d-flex justify-content-center">
          <!-- Checkbox -->
          <!-- <div class="form-check mb-3 mb-md-0">
            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
            <label class="form-check-label" for="loginCheck"> Remember me </label>
          </div> -->
        </div>

        <!-- <div class="col-md-6 d-flex justify-content-center">
        
          <a href="#!">Forgot password?</a>
        </div> -->
      </div>
      <!-- Submit button -->
      <div class="text-center">
      <input type="submit" value="Sign-Up" class="btn btn-primary  mb-1" style="width: 200px; align:center;">
      </div>
      <!-- Register buttons -->
      <div class="text-center">
        <p><a href="/login">Back</a></p>
      </div>
    </form>
    
  </div>
</div>
<!-- Pills content -->
</div>
@if(Session::has('success'))
        <p style="color:green">{{Session::get('success') }}</p>
        <h5>You can <a href="/login">Login here</a></h5>
    @endif
@endsection
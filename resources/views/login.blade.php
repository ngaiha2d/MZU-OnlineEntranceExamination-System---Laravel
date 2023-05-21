@extends('layout/layout-common')


@section('space-work')


<div div class="mx-auto" style="width: 300px;">

<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="/login" role="tab"
      aria-controls="pills-login" aria-selected="true"><h1 style="font-family: fantasy; color:rgb(12, 81, 28);">Login</h1></a>
  </li>
  
</ul>
<!-- Pills navs -->
@if($errors->any()) 
    @foreach($errors->all() as $error)
        <p style="color:red" style="text-align:center">{{ $error }}</p>
    @endforeach
@endif

@if(Session::has('error'))
        <p style="color:red">{{Session::get('error') }}</p>
    @endif
<!-- Pills content -->
<div class="tab-content">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">

  


    <form action="{{route('userLogin')}}" method="POST">
    @csrf

      <!-- Email input -->
      
      
        <div class="form-outline mb-4">
          <br>
          <div class="d-flex justify-content-center">
          <!-- <label  for="loginName">Email or username</label> -->
          </div>
          
          <div class="d-flex justify-content-center">
          <input type="text" name="email" placeholder="Enter your email" style="width: 300px;">
          </div>
          
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4 ">
          <div class="d-flex justify-content-center">
          <!-- <label class="form-label" for="loginPassword">Password</label> -->
          </div>
          
          <div class="d-flex justify-content-center">
          <input type="password" name="password" placeholder="Enter Password" style="width: 300px;">
          </div>
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
      <button type="submit" class="btn btn-success  mb-1" style="width: 200px; align:center; ">Sign in</button>
      </div>
      <!-- Register buttons -->
      
    </form>
  </div>





</div>
<!-- Pills content -->
</div>
@endsection
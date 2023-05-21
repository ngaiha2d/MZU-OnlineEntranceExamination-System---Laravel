@extends('layout/layout-common')
@section('space-work')

<br><br><br>
<div div class="mx-auto" style="width: 300px;">

<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link " id="tab-login" data-mdb-toggle="pill" href="/register" role="tab"
      aria-controls="pills-login" aria-selected="true"><h1 style="font-family: fantasy; color:blue;">Register</h1></a>
  </li>
  
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content ">
  <div  class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">



    @if($errors->any())
      @foreach($errors->all() as $error)
      <p style="color:red">{{ $error }}></p>
      @endforeach
    @endif
      <form action="{{route('studentRegister')}}" method="POST">
      @csrf

      <!-- Email input -->
      <div class="form-outline mb-4">
        
        <div class="d-flex justify-content-center">
        
        </div>   
        <div class="d-flex justify-content-center">
        <input type="text" name="name" placeholder="Enter : name" style="width: 300px;">
        </div>
      </div>
      <!-- Password input -->
      <div class="form-outline mb-4">
        <div class="d-flex justify-content-center">
        </div>
        <div class="d-flex justify-content-center">       
        <input type="text" name="email" placeholder="Enter : email" style="width: 300px;">
        </div>
      </div>

      <div class="form-outline mb-4">
        <div class="d-flex justify-content-center">
        </div>
        <div class="d-flex justify-content-center">
        <input type="password" name="password" placeholder="Enter : Password" style="width: 300px;">
        </div>
      </div>

      <div class="form-outline mb-4">
        <div class="d-flex justify-content-center">
        </div>
        <div class="d-flex justify-content-center">        
        <input type="password" name="password_confirmation" placeholder="Confirm  Password" style="width: 300px;">
        </div>
        <br>
      </div>
      </div>
      <!-- Submit button -->
      <div class="text-center">
      <input type="submit" value="Sign-Up" class="btn btn-primary  mb-1" style="width: 200px; align:center;">
      </div>
      </form>
      <!-- Register buttons -->
      <div class="text-center">
        <p><a href="/login">Back</a></p>
        @if(Session::has('success'))
        <p style="color:green">{{Session::get('success') }}</p>
        <h5>You can <a href="/login">Login here</a></h5>
        @endif
      </div>
     
  </div>
</div>
<!-- Pills content -->
</div>

@endsection

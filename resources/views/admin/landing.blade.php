@extends('layout/admin-layout')

@section('space-work')

<br>
  <!-- menu on the admin dashboard -->
  <div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="font-family: 'Poppins', sans-serif; font-size: 40px; color:rgb(41, 141, 158)">Admin Dashboard</strong></h1>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-4">
        <div class="tile green">
          <a href="/admin/exam">
            <h3 class="title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Exams</h3>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="tile green">
          <a href="/admin/resultss">
            <h3 class="title"><i class="fa fa-bar-chart" aria-hidden="true"></i> Result</h3>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="tile green">
          <a href="/admin/students">
            <h3 class="title"><i class="fa fa-users" aria-hidden="true"></i> Candidates</h3>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="tile green">
          <a href="/subject">
            <h3 class="title"><i class="fa fa-book" aria-hidden="true"></i> Subjects</h3>
          </a>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="tile green">
          <a href="/admin/qna-ans">
            <h3 class="title"><i class="fa fa-question-circle" aria-hidden="true"></i> Q&A</h3>
          </a>
        </div>
      </div>


      <div class="col-sm-4">
        <div class="tile green">
          <a href="/admin/marks">
            <h3 class="title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Marks</h3>
          </a>
        </div>
      </div>

      
    </div>
  </div>  

@endsection
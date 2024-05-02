@extends('layout/admin-layout')

@section('space-work')

<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="color:rgb(41, 141, 158); font-family: 'Poppins', sans-serif; font-size: 40px;">{{$exam_name}}  Candidate</strong></h1>
      </div>
    </div>
<span>
<button style="font-family: Bahnschrift;" type="button" class="btn btn-outline-info mr-2" data-toggle="modal" data-target="#addStudentModal">
    <span class="fa fa-plus-circle"></span> Add Candidate
    </button>
</span>
<span>
    <button style="font-family: Bahnschrift; " type="button" class="btn deleteButton btn-outline-danger mr-2" data-toggle="modal" data-target="#DeleteStudentModal">
        <span class="fa fa-minus-circle"></span> Delete Candidate
        </button>
    </span>

<a class="btn btn-outline-info" href="{{ route('CandidateExport',['exam_id' => $exam_id])}}">Export Candidate list</a>
<span>
    <a class="btn btn-outline-info" href="/sortExam">Sort by Exam</a>
    </span>
<div>
    
<br>
    <table class="table">
        <thead class="table-rawng">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone no.</th>
            <th>Exam Code</th>
        </thead>
        <tbody>
            @if(count($students) > 0)
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone_no }}</td>
                    <td>{{ $student->exam_code }}</td>
                    
                </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="3">Students not found!!</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Modal for adding student-->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>
  
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
              <form id="addStudent">
                  @csrf
              <div class="modal-body">
                  <div class="row">
                      <div class="col">
                          <input type="text" class="w-100" name="name" placeholder="Enter Candidate name" required>
                      </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col">
                        <input type="email" class="w-100" name="email" placeholder="Enter Candidate email" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="text" class="w-100" name="phone_no" placeholder="Enter Candidate Phone no." required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="text" class="w-100" name="exam_code" placeholder="Enter Exam Code" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <input type="password" class="w-100" name="password" placeholder="Enter Candidate password" required>
                    </div>
                </div>
                 
              </div>
              
              <div class="modal-footer">
                  
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-info">Add Student</button>
              </div>
              </form>
              </div>
    </div>
  </div>  

  <!-- Modal for deleting Candidate-->
<div class="modal fade" id="DeleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle"> Delete Candidate</h5>
  
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
              <form id="DeleteCandidate">
                  @csrf
              <div class="modal-body">
                  <div class="row">
                      <div class="col">
                          <input type="text" class="w-100" name="id" placeholder="Enter Candidate id" required>
                      </div>
                  </div>
                 
              </div>
              
              <div class="modal-footer">
                  
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-danger">delete Candidate</button>
              </div>
              </form>
              </div>
    </div>
  </div>  

<script>
 
    $(document).ready(function(){
        $("#addStudent").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addStudent') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                    }
                    else{
                        alert(data.msg);
                    }

                }
            });
        });


        

        $("#DeleteCandidate").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();
            
            $.ajax({
                url:"{{ route('DeleteCandidate') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                        alert(data.msg);
                    }
                    else{
                        alert(data.msg);
                    }
                }
        });
        });
    });
</script>



@endsection

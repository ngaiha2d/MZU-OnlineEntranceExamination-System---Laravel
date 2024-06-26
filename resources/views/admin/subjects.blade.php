@extends('layout/admin-layout')

@section('space-work')


<div class="container-fluid ">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1><strong style="color:rgb(41, 141, 158); font-family: 'Poppins', sans-serif; font-size: 40px;">Subjects </strong></h1>
    </div>
  </div>


<div class="container-fluid px-5">
  <div>
    <!-- Button trigger modal -->
  <button style="font-family: Bahnschrift; " type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addSubjectModal">
  <span class="fa fa-plus-circle"></span> Add New Subject
  </button>
  <br><br>
</div>
<!-- Table for the subjects -->
<table class="table">
  <thead class="table-rawng">
    <tr>
      <th scope="col">Exam No.</th>
      <th scope="col">Subject</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  @if(count($subjects) > 0)

    @foreach($subjects as $subject)
    <tr>
        <td>{{ $subject->id}}</td>
        <td>{{ $subject->subject}}</td>
        <td>
          <button class="btn btn-outline-info btn-sm editButton" data-id="{{ $subject->id}}" data-subject="{{ $subject->subject}}" data-toggle="modal" data-target="#editSubjectModal"><span class="fa fa-pencil-square-o"></span></button>
          </td>
          <td>
          <button class="btn btn-outline-danger btn-sm deleteButton" data-id="{{ $subject->id}}" data-toggle="modal" data-target="#deleteSubjectModal"><span class="fa fa-trash"></span></button>
          </td>
    </tr>
    @endforeach
  @else
  <tr>
      <td colspan="4">Subject not found!</td>
  </tr>
  @endif

  </tbody>
</table>
</div>




<!-- Modal for adding the subject -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <form id="addSubject">
      <!-- Tpken for sending the value/data -->
      @csrf
        <div class="modal-body">
            <label>Subject</label>
            <input type="text" name="subject" placeholder="Enter Subject Name" required>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-info">Add</button>
        </div>
        </div>
    </form>
  </div>
</div>   


<!--edit subject  Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <form id="editSubject">
      <!-- Tpken for sending the value/data -->
      @csrf
            <div class="modal-body">
                <label>Subject</label>
                
                <input type="text" name="subject" placeholder="Enter Subject Name" id="edit_subject" required>
                <input type="hidden" name="id" id="edit_subject_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Update</button>
            </div>
          </div>
    </form>
  </div>
</div>


<!--delete subject  Modal -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <form id="deleteSubject">
      <!--passing Token for sending the value/data -->
      @csrf
            <div class="modal-body">
                <p>Are you sure you wan't to delete this Subject?</p>
                <input type="hidden" name="id" id="delete_subject_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </div>
          </div>
    </form>
  </div>
</div>


<!-- preventing data to send// if the form is submotting we call the variable e to stop the data and then we take the data and then we serialize and then we use ajax to take the input form the vacant side -->
<!-- jquery script for adding subject on admin dashboard -->
<script>

//script JQuery for adding the subjects in the admin dashboard 
  $(document).ready(function(){
    
      //adding the subject
      $("#addSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();//take the current id for this specific element and it will give csrf token

        $.ajax({
          url:"{{route('addSubject')}}",
          type:"POST",
          data:formData,

          // to check what code come from the controller
          success:function(data){
            if(data.success ==true){
                location.reload();
            }
            else{
                alert(data.msg);
            }

          }
        });
      });

  
      //edit subject //to show the data in the modal of the edit in the admin dashboard
      $(".editButton").click(function(){
        var subject_id = $(this).attr('data-id');
        var subject = $(this).attr('data-subject');
        //to shoe inside the input label
        $("#edit_subject").val(subject);
        $("#edit_subject_id").val(subject_id);
        
      });


      //JQuery script fot the edit subjects 
      $("#editSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize(); ///take the current id for this specific element and it will give csrf token
        $.ajax({
          url:"{{route('editSubject')}}",
          type:"POST",
          data:formData,

          // to check what code come from the controller
          success:function(data){
            if(data.success ==true){
                location.reload();
            }
            else{
                alert(data.msg);
            }

          }
        });
      });
      

      //for delete form popup this function will select the id for the specific button attributes
      $(".deleteButton").click(function(){

        var subject_id = $(this).attr('data-id');//take the current id for this specific element
        $("#delete_subject_id").val(subject_id); //we keep in the hidden field

      });

      //JQuery script fot the delete subjects 
      $("#deleteSubject").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize(); //take the current id for this specific element and it will give csrf token

        $.ajax({
          url:"{{route('deleteSubject')}}", //send to the delete subject route
          type:"POST",
          data:formData,

          // to check what code come from the controller
          success:function(data){
            if(data.success ==true){
                location.reload();
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
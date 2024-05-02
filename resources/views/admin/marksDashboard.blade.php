@extends('layout/admin-layout')

@section('space-work')

<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="color:rgb(41, 141, 158); font-family: 'Poppins', sans-serif; font-size: 40px;">Marks </strong></h1>
      </div>
    </div>
<div>
    
<br>
    <table class="table">
        <thead class="table-rawng">
            <th>Id</th>
            <th>Exam Name</th>
            <th>Marks / Q</th>
            <th>Total Marks</th>
            <th>Edit</th>
        </thead>
        <tbody>
            @if(count($exams) > 0)
            @php $x = 1; @endphp
                @foreach($exams as $exam)
                    <tr>
                        <td>{{ $x++ }}</td>
                        <td>{{ $exam->exam_name }}</td>
                        <td>{{ $exam->marks }}</td>
                        <td>{{ count($exam->getQnaExam) * $exam->marks }}</td>
                        <td>
                            <button class="btn btn-outline-info btn-sm editMarks" data-id="{{ $exam->id }}" data-marks="{{ $exam->marks }}" data-totalq="{{ count($exam->getQnaExam) }}" data-toggle="modal" data-target="#editMarksModal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">Exams not added!</td>
                </tr>
            @endif 
        </tbody>
    </table>

    
<div class="modal fade" id="editMarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Marks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
  
            <form id="editMarks">
  
        @csrf
              <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label> Marks/Q</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="hidden" name="exam_id" id="exam_id" >
                        <input type="text"
                        onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode == 46"
                        name="marks" placeholder="Enter Marks per Question" id="marks" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label> Total Marks</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" disabled placeholder="Total Marks" id="tmarks">
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-info">Update Marks</button>
              </div>
              </div>
      </form>
    </div>
  </div> 
</div>
 
<script>
    $(document).ready(function(){
        var totalQna = 0;
        $('.editMarks').click(function(){
            
            var exam_id = $(this).attr('data-id');
            var marks = $(this).attr('data-marks');
            var totalq = $(this).attr('data-totalq');

            $('#marks').val(marks);
            $('#exam_id').val(exam_id);
            $('#tmarks').val((marks*totalq).toFixed(1));

            totalQna = totalq;
        });

        $('#marks').keyup(function(){

            $('#tmarks').val( ($(this).val()*totalQna ).toFixed(1));

        });

        $('#editMarks').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('updateMarks')}}",
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
            })

        });

    });
</script>


@endsection

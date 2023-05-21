@extends('layout/admin-layout')

@section('space-work')

<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="font-family: 'Poppins', sans-serif; font-size: 40px;">{{$exam_name}} Exam Mark List </strong></h1>
      </div>
    </div>

<a  class="btn btn-outline-info btn-sm" href="{{route('export_exam_pdf',['attempt_id'=> $exam_id])}}">Download list in PDF</a>

<br>
<br>
<div>

    <table class="table">
        <thead>
            <th>id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone no.</th>
            <th>Exam Name</th>
            <th>Mark</th>
            <th>Download PDF</th>
        </thead>
        <tbody>
         
            @if(count($attempts) > 0)

                @foreach ($attempts as $attempt)
                @php $x = 1; @endphp
                    <tr>
                        <td> {{ $attempt->user->id }}</td>
                        <td> {{ $attempt->user->name }}</td>
                        <td> {{ $attempt->user->email }}</td>
                        <td> {{ $attempt->user->phone_no }}</td>
                        <td> {{ $attempt->exam->exam_name }}</td>
                        <td> {{ $attempt->marks }}</td>
                        <td>
                            <a  class="btn btn-outline-success btn-sm" href="{{route('export_user_pdf',['attempt_id' => $attempt->id,'name'=>$attempt->user->name,'id'=>$attempt->user->id])}}"> <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Download </a> 
                        </td>
                    </tr>
                    
                @endforeach

            @else
            <tr>
                <td colspan="5"> No candidate attempts</td>
            </tr>
                
            @endif

        </tbody>
    </table>


  <!-- Modal -->
  <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Review Answer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="reviewForm">
            @csrf 
            <input type="hidden" name="attempt_id" id="attempt_id">
        <div class="modal-body reviewResult">
          Loading...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Approve</button>
        </div>
      </form>
      </div>
    </div>

    <script>
        $(document).ready(function(){

            $('.resultExam').click(function(){

                var id = $(this).attr('data-id');
                $('#attempt_id').val(id);
                    $.ajax({
                        url:"{{ route('qnaResult') }}",
                        type:"GET",
                        data:{attempt_id: id},
                        success:function(data){

                            var html = '';
                            if(data.success == true){
                                
                                var data = data.data; 
                                if(data.length > 0){

                                    

                                    for(let i = 0; i < data.length; i++){

                                        let isCorrect = '<span style="color:red;" class="fa fa-close"></span>';

                                        if(data[i]['answers']['is_correct'] == 1){
                                            isCorrect = '<span style="color:green;" class="fa fa-check"></span>';
                                        }
                                        let answer = data[i]['answers']['answer'];

                                        html += `
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h6>Q(`+(i+1)+`). `+data[i]['question']['question']+`</h6>
                                                    <p>Ans:- `+answer+` `+isCorrect+` </p> 
                                                </div>
                                            </div>
                                        `;
                                    }

                                }else{
                                    html += `<h6> Candidate does not attempt any Question </h6>
                                     <p>If you approve this Candidate will fail</p>`;
                                }

                            }else{
                                html += `<p> Having some server issue!`;
                            }

                            $('.reviewResult').html(html);
                        }
                    });
            });

            //aprove answer
            $('#reviewForm').submit(function(event){
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url:"{{ route('approveQna') }}",
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
            $('.print-window').click(function() {
                window.print();
            }); 
            
        });
    </script>
    @endsection
@extends('layout/admin-layout')

@section('space-work')

<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="font-family: 'Poppins', sans-serif; font-size: 40px;">Q&A Dashboard </strong></h1>
      </div>
    </div>>

<div>
      <!-- Button trigger modal -->
    <button style="font-family: Bahnschrift; " type="button" class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#addQnaModal">
    <span class="fa fa-plus-circle"></span>Add Q&A
    </button>
    
    <button style="font-family: Bahnschrift; " type="button" class="btn btn-outline-info mr-5" data-toggle="modal" data-target="#importQnaModal">
        <i class="fa fa-download" aria-hidden="true"> </i>  Import Q&A
        </button>
    <br><br>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Subject</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @if(count($questions) > 0)
                @foreach($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td> 
                        <a href="#" class="ansButton" data-id="{{ $question->id }}" style="color:#206649;" data-toggle="modal" data-target="#showAnsModal"><i class="fa fa-eye" aria-hidden="true"></i> See Answers</a>
                    </td>
                    <td>{{ $question->exams[0]->subject }}  </td>
                    <td> 
                        <a href="#" class="btn btn-outline-danger btn-sm deleteButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#deleteQnaModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach

            @else
                <tr>
                    <td colspan="3">Questions & Answers not found!!</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>



<!-- Modal for adding the exam -->
<div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>

                <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>
            <form id="addQna">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="text" class="w-100" name="question" placeholder="Enter Question" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="w-100" name="subject_id" placeholder="Enter Subject_id" required>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <span class="error" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Q&A</button>
            </div>
            </form>
            </div>
  </div>
</div>  


<!-- Modal for showing answer -->
<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
        <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Answers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Answer</th>
                        <th>Correct Ans</th>
                    </thead>
                    <tbody class="showAnswers">

                    </tbody>

                </table>
            </div>
            
            <div class="modal-footer">
                <span class="error" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
  </div>
</div> 
<!-- Modal for Deleting the question -->
<div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Delete Qna</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
  
            <form id="deleteQna"> 
  
        @csrf
              <div class="modal-body">
                  <input type="hidden" name="id"  id="delete_qna_id">
                  <p>are you sure you wan't to delete the Question and Answer ?</p>
              </div>
              
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </div>
              </div>
      </form>
    </div>
  </div> 

<!-- Modal for importing question -->
<div class="modal fade" id="importQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Import Q&A</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <form id="importQna" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                  <input type="file" name="file" id="fileupload" required accept=".csv, application/vmd.ms.excel, .xlsx">
              </div>
              
              <div class="modal-footer">
                  <span class="error" style="color:red;"></span>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Import</button> 
              </div>
              </form>
              </div>
    </div>
  </div> 

<script>
    $(document).ready(function(){

        //form submittion to prevent for reloading
        $("#addQna").submit(function(e){
            e.preventDefault();

            //for warning
            if($(".answers").length < 2){
                $(".error").text("Please add minimum 2 answer option.")
                setTimeout(function(){
                    $(".error").text("")
                },3000);
            }
            else{
                
                var checkIsCorrect = false;

                for(let i = 0; i < $(".is_correct").length; i++){ //is_correct value os going to pass to controller
                    if( $(".is_correct:eq("+i+")").prop('checked') == true)  //cooncatinating //to check if its is correct position eg 1,2,3,
                    {

                        checkIsCorrect = true; //selected
                        $(".is_correct:eq("+i+")").val( $(".is_correct:eq("+i+")").next().find('input').val() );
                    }
                }

                // checking the radio button is selected or not
                //using ajax
                if(checkIsCorrect ){

                    var formData = $(this).serialize();

                    $.ajax({
                        url:"{{ route('addQna')}}",
                        type:"POST",
                        data:formData,
                        success:function(data){
                            console.log(data);
                            if(data.success == true){
                                location.reload();
                            }
                            else{
                                alert(data.msg);
                            }

                        }
                    });

                }
                else{
                        $(".error").text("Please select the correct answer.")
                    setTimeout(function(){
                        $(".error").text("")
                    },3000);
                }

            }
        });

        //add answer
        $("#addAnswer").click(function(){

                if($(".answers").length >= 14){
                    $(".error").text(" You can add maximum 4 answer only.")
                    setTimeout(function(){
                        $(".error").text("")
                    },3000);
                }
                else{
                    var html0 = `
                <div class="row mt-2 answers">

                    <input type="radio" name="is_correct" class="is_correct">
                    <div class="col">
                        <input type="text" class="w-100" name="answers[]" placeholder="Enter Answer" required>
                    </div>
                    <button class="btn btn-danger removeButton">Remove</button>
                </div>
                `;


                $(".modal-body").append(html0);
                }

        });


        //remove button on the add subject modal
        $(document).on("click",".removeButton",function(){

            $(this).parent().remove();
        });


        //show answer script

        $(".ansButton").click(function(){

            var questions = @json($questions);
            var qid = $(this).attr('data-id');
            var html = '';
            //console.log(questions);

            for(let i = 0; i < questions.length; i++){
 
               if(questions[i]['id'] == qid){


                var answersLength = questions[i]['answers'].length;
                for(let j=0; j< answersLength; j++)
                {
                    let is_correct ='No';
                    if(questions[i]['answers'][j]['is_correct'] == 1){
                        is_correct = 'Yes';
                    }

                    //printing te answers in  the modal 
                    html += ` 
                        <tr>
                            <td>`+(j+1)+`</td>
                            <td>`+questions[i]['answers'][j]['answer']+`</td>
                            <td>`+is_correct+`</td>
                        </tr>
                    `; //concatination
                }
                break;
               }
            }

            // to appent the html
            $('.showAnswers').html(html);

        });

        $("#importQna").submit(function(e){
            e.preventDefault();

            let formData = new FormData();

            formData.append("file",fileupload.files[0]);

            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                }
            });

            $.ajax({
                url:"{{ route('importQna')}}",
                type:"POST",
                data:formData,
                processData:false,
                contentType:false,
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

        //delete q and a

        $('.deleteButton').click(function(){
            var id = $(this).attr('data-id')
            $('#delete_qna_id').val(id);
        });

        $('#deleteQna').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('deleteQna')}}",
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

    });
</script>



@endsection

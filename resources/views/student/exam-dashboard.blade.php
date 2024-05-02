<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>OnlineEntranceExamination</title>
    <head>
  	<title>MZUOEE ADMIN</title>
    <link rel = "icon" href = "https://iili.io/HOoZm11.png" type = "image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>

        i.size {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 200px;
          
        }
      
        input[type=text] {
          width: 100%;
          padding: 0px 0px;
          margin: opx 3;
          box-sizing: border-box;
          border: none;
          border-bottom: 1px solid rgb(10, 67, 23);}

        input[type=password] {
          width: 100%;
          padding: 0px 0px;
          margin: 0px 0;
          box-sizing: border-box;
          border: none;
          border-bottom: 1px solid rgb(10, 67, 23);
}
</style>
<style>
    .sticky-nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 999;
    }
</style>
  </head>
<body>
    <nav class="navbar bg-white sticky-nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <b style="color:rgb(12, 81, 28);">MZU</b> <small style="font-family:MV Boli; color:rgb(12, 81, 28);">Online Entrance Examination</small>
            </a>
            <p style="color:rgb(12, 81, 28)"><h5> Welcome, <b>{{ Auth::user()->name }}</b></h5></p>
            <h4 class='text-right time'> {{ $exam[0]['time']}}</h4>
        </div>
    </nav>
    <br>
    <br>


    @php
        $time = explode(':',$exam[0]['time']);

    @endphp

   
        
        <div class="container-fluid border">
            <i class="size" href="#"><img src="https://iili.io/HOx2t0x.png" alt="" width="190" height="190" ></i>
        <h3 class="text-center">{{ $exam[0]['exam_name']}} Entrance Examination</h3>
    </div>
    <div class='container ' style="width:800px;">
        [![Hg69GQn.md.png](https://iili.io/Hg69GQn.md.png)](https://freeimage.host/i/Hg69GQn)

<br>

        @php $qcount = 1; @endphp
        @if($success == true)

            @if(count($qna) > 0)
            <div class="container-fluid"> 
            <form action="{{ route('examSubmit') }}" method="POST" class="mb-5" onsubmit="return isValid()">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam[0]['id']}}">
            
                @foreach($qna as $data)
                        <div>
                        <h5>Q{{ $qcount++ }}. {{ $data['question'][0]['question'] }}</h5>
                        <input type="hidden" name="q[]" value="{{ $data['question'][0]['id'] }}">
                        <input type="hidden" name="ans_{{ $qcount-1}}" id="ans_{{ $qcount-1}}">
                        @php $acount = 1; @endphp
                        @foreach($data['question'][0]['answers'] as $answer)
                            <p ><b>{{$acount++}}.</b> {{$answer['answer']}}
                                <input type="radio" name="radio_{{ $qcount-1}}" data-id="{{ $qcount-1}}" class="select_ans" value="{{$answer['id']}}">
                            </p>
                    @endforeach
                    </div>
                    <br>
                @endforeach
                <div class="text-center">
                    <input type="submit" class="btn btn-info">
                </div>
            </form>
        </div>
            @else
                <h3 style="color:red" class="text-center">Question and Answer not available</h3>
            @endif
        @else
            <h3 style="color:red" class="text-center">{{ $msg }}</h3>
        @endif
    </div>

<script>

    $(document).ready(function(){

        $('.select_ans').click(function(){
            var no = $(this).attr('data-id');
            $('#ans_'+no).val($(this).val());
        });

        var time = @json($time);
        $('.time').text(time[0]+':'+time[1]+':00 Time left')
        
        var seconds = 60;
        var hours = time[0];
        var minutes =  time[1];

        setInterval(() => {

            if(seconds <= 0){
                minutes--;
                seconds = 60;
            }

            if(minutes <= 0){
                hours--;
                minutes = 59;
                seconds = 60;
            }

            let temphours = hours.toString().length > 1? hours:'0'+hours;
            let tempminutes = minutes.toString().length > 1? minutes:'0'+minutes;
            let tempseconds = hours.toString().length > 1? seconds:+seconds;

            $('.time').text(temphours+':'+tempminutes+':'+tempseconds+' Time left')

            seconds--;

        }, 1000);
    });

    function isValid(){
            var result = true;

            var qlength = parseInt("{{ $qcount}}")-1;
            $('.error_msg').remove();
            for(let i = 0; i <= qlength; i++){
                if($('#ans_'+i).val() == ""){
                    result = false;
                    $('#ans_'+i).parent().append('<span style="color:red;" class="error_msg">Please select answer.</span>')
                    setTimeout(() => {
                        $('.error_msg').remove();
                    }, 5000);

                }
            }

            return result;
        }


</script>

</body>
</html>
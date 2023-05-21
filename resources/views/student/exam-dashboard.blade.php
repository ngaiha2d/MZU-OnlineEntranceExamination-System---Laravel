@extends('layout/layout-common')

@section('space-work')

    @php
        $time = explode(':',$exam[0]['time']);

    @endphp

    <div class='container' style="width:800px;">
        
        <p style="color:black"> <h5> Welcome, {{ Auth::user()->name }}</h5></p>
        <div class="container border">
        <h2 class="text-center">MZU </h2>
        <h3 class="text-center">{{ $exam[0]['exam_name']}} Entrance Examination</h3>
    </div>
        <h4 class='text-right time'> {{ $exam[0]['time']}}</h4>
        <br>



        @php $qcount = 1; @endphp
        @if($success == true)

            @if(count($qna) > 0)
            <div class="container-fluid border"> 
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

@endsection
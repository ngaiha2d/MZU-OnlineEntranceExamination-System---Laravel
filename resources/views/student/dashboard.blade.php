@extends('layout/student-layout')

@section('space-work')
<h1>Exams </h1>

    <table class="table">

    <thead>
        <th>#</th>
        <th>Exam name</th>
        <th>Subject Name</th>
        <th>date</th>
        <th>Duration</th>
        <th>Exam Link</th>
    </thead>

    <tbody>
        @if(count($exams) > 0)
            @php $count = 1; @endphp
            @foreach($exams as $exam)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$exam->exam_name}}</td>
                    <td>{{$exam->subjects[0]['subject']}}</td>
                    <td>{{$exam->date}}</td>
                    <td>{{$exam->time}} Hrs</td>
                    <td><a href="#" data-code="{{ $exam->entrance_id }}" class="copy">Exam</a></td>
                </tr>
            @endforeach

        @else
            <tr>
                <td colspan="8">No Exam available</td>
            </tr>

        @endif
    </tbody>
    </table>

    <script>
        $(document).ready(function(){

            //function to copy the link
            $('.copy').click(function(){

                var code = $(this).attr('data-code');
                var url = "{{URL::to('/')}}/exam/"+code;  //generate link
                window.location.href = url;
            })

        });
    </script>
@endsection
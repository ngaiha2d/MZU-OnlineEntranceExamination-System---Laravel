@extends('layout/admin-layout')

@section('space-work')
<div class="container bootstrap snippets bootdey">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1><strong style="font-family: 'Poppins', sans-serif; font-size: 40px;">Results </strong></h1>
      </div>
    </div>
<div>

    <table class="table">
        <thead>
            <th>Exam id</th>
            <th>Exam Name</th>
            <th>Exam Date</th>
            <th>View</th>
        </thead>
        <tbody>
         
            @if(count($attempts) > 0)

                @foreach ($attempts as $attempt)
                @php $x = 0; @endphp
                    <tr>
                        <td> {{ $attempt->id }}</td>
                        <td> {{ $attempt->exam_name }}</td>
                        <td> {{ $attempt->date }}</td>
                        <td><a href="{{route('resultView',['exam_id' => $attempt->id])}}">view <i class="fa fa-file-o" aria-hidden="true"></i></a></td>
                        
                    </tr>
                    
                @endforeach

            @endif

        </tbody>
    </table>
    </div>
<script>
    
</script>


@endsection
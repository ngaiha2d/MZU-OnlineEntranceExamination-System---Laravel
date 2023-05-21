<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Answer Script</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: rgb(12, 81, 28);
            font-size: 35px;
            margin-bottom: 10px;
        }

        h1 small {
            font-family: MV Boli;
            font-size: 18px;
            color: rgb(12, 81, 28);
        }

        h2 {
            font-family: Bahnschrift;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 13px;
            margin-bottom: 10px;
        }

        h5 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .fa {
            margin-right: 5px;
        }

        .fa-close {
            color: red;
        }

        .fa-check {
            color: green;
        }
    </style>
</head>
<body>
    <h1><b>MZU</b> Online Entrance Examination</h1>
    <h2>Answer Script</h2>
    <h3>Candidate Name: {{ $name }}</h3>
    <h3>Candidate ID: {{ $id }}</h3>
    <hr>
    @php
        $html = '';
        if (count($attempts) > 0) {
            foreach ($attempts as $i => $result) {
                $isCorrect = '<span class="fa fa-close" style="color: red;">Wrong</span>';
                if ($result['answers']['is_correct'] == 1) {
                    $isCorrect = '<span class="fa fa-check" style="color: green;">Correct</span>';
                }
                $answer = $result['answers']['answer'];

                $html .= '
                    <div>
                        <h5>Q('.($i+1).'). '.$result['question']['question'].'</h5>
                        <p>Ans: '.$answer.' '.$isCorrect.'</p>
                    </div>
                    
                ';
            }
        } else {
            $html .= '
                <p>Candidate did not attempt any questions.</p>
            ';
        }
    @endphp
    <div class="reviewResult">
        {!! $html !!}
    </div>
</body>
</html>

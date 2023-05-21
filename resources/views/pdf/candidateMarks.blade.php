<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            font-family: Bahnschrift;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #e9e9e9;
        }

        table tbody td:first-child {
            font-weight: bold;
        }

        .no-attempts {
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1><b style="color:rgb(12, 81, 28);">MZU</b> <small style="font-family:MV Boli; color:rgb(12, 81, 28);">Online Entrance Examination</small></h1>
    <h2>Candidate Marks</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Exam Name</th>
                    <th>Mark</th>
                </tr>
            </thead>
            <tbody>
                @if(count($attempts) > 0)
                    @foreach ($attempts as $attempt)
                        <tr>
                            <td>{{ $attempt->user->id }}</td>
                            <td>{{ $attempt->user->name }}</td>
                            <td>{{ $attempt->user->email }}</td>
                            <td>{{ $attempt->user->phone_no }}</td>
                            <td>{{ $attempt->exam->exam_name }}</td>
                            <td>{{ $attempt->marks }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="no-attempts">No candidate attempts</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>

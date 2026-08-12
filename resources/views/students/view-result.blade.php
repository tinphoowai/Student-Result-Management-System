@include('layouts.header')
<title>View Result</title>
<link rel="stylesheet" href="{{ asset('css/view-result.css') }}" />
</head>

<body>
    <header>
        <h5 class="title">Student's Result Information System</h5>
        <a href="javascript:history.back()" class="btn back-btn">Back</a>
    </header>
    <p class="result-title my-3">{{ $academic_year->name }} Academic Year</p>
    <p class="result-title">Year-{{ $year_level }} B.C.Sc/B.C.Tech</p>
    <p class="result-title">Semester-{{ $semester }} Grade</p>
    <div class="container">
        <table
            class="table table-bordered table-striped align-middle text-center">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 12%">Student ID</th>
                    <th style="width: 15%" class="text-start">Name</th>
                    @foreach($results as $result)
                    <th>{{ $result->subject->subject_code }}</th>
                    @endforeach
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="fw-semibold text-secondary">{{$student->student_code }}</td>
                    <td class="text-start fw-bold text-dark">{{ $student->name }}</td>
                    @foreach($results as $result)
                    <td class="grade-cell">{{ $result->mark->grade }}</td>
                    @endforeach
                    
                </tr>
            </tbody>
        </table>
    </div>
</body>
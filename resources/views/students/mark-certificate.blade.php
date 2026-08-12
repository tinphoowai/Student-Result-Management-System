@include('layouts.header')
<title>Mark Certificate</title>
<link rel="stylesheet" href="{{ asset('css/mark-certificate.css') }}" />
</head>
<body>
    <header>
        <h5 class="title">Student's Result Information System</h5>
        <a href="javascript:history.back()" class="btn back-btn">Back</a>
    </header>

    <div class="container">
        <div class="a4-certificate-card">
            <div class="text-center mb-5">
                <h2 class="certificate-title mb-2">
                    ACADEMIC PERFORMANCE CERTIFICATE
                </h2>
                <p class="text-muted text-uppercase fw-semibold small">
                    Official Mark Sheet Statement
                </p>
                <hr
                    class="mx-auto"
                    style="
                            width: 150px;
                            border-top: 3px solid rgb(6, 6, 68);
                            opacity: 1;
                        " />
            </div>

            <div class="row mb-4 fs-6">
                <div class="col-6 mb-2">
                    <span class="text-muted">Student Code:</span>
                    <strong class="text-dark ms-2">{{ $student->student_code }}</strong>
                </div>
                <div class="col-6 mb-2 text-end">
                    <span class="text-muted">Academic Year:</span>
                    <strong class="text-dark ms-2">{{ $academic->name }}</strong>
                </div>
                <div class="col-6">
                    <span class="text-muted">Student Name:</span>
                    <strong class="text-dark ms-2">{{ $student->name }}</strong>
                </div>
                <div class="col-6 text-end">
                    <span class="text-muted">Year & Semester:</span>
                    <strong class="text-dark ms-2">Year {{ $year_level }} (Semester {{ $semester }})</strong>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr style="border-top: 2px solid rgb(6, 6, 68)">
                            <th style="width: 8%">No.</th>
                            <th class="text-start">Subject Name</th>
                            <th style="width: 20%">Marks (Out of 100)</th>
                            <th style="width: 25%">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                        <tr>
                            <td class="text-center">1.</td>
                            <td>{{ $result->subject->subject_name }}</td>
                            <td class="text-center fw-bold">{{ $result->mark->mark }}</td>
                            <td
                                class="text-center fw-semibold">
                                {{ $result->mark->grade }}
                            </td>
                        </tr>
                        @endforeach
                        <tr
                            class="table-light fs-5"
                            style="border-bottom: 2px solid rgb(6, 6, 68)">
                            <td colspan="2" class="text-end fw-bold">
                                TOTAL MARKS:
                            </td>
                            <td colspan="2" class="text-center fw-bold text-primary">
                                {{$totalMarks }}
                            </td>
                          
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-5 pt-4 no-print">
                <button
                    onclick="window.print()"
                    class="btn btn-primary btn-lg px-5 shadow-sm"
                    style="background-color: rgb(6, 6, 68); border: none">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        fill="currentColor"
                        class="bi bi-printer-fill me-2"
                        viewBox="0 0 16 16">
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zm-1 2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm11 4v3a1 1 0 0 1-1 1h-1v-2a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1m-1 3H4v2h8z" />
                    </svg>
                    Print Certificate
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
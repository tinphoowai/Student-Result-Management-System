@include('layouts.header')
<title>Get Mark Certificate</title>
<link rel="stylesheet" href="{{ asset('css/mark-certificate-page.css') }}" />
</head>

<body>
    <header>
        <h5 class="title">Student's Result Information System</h5>
        <a href="javascript:history.back()" class="btn back-btn">Back</a>
    </header>
    <div class="container">
        <div class="card d-flex my-3 shadow bg-tertiary">
            <form action="" method="get">
                @csrf
                @method ('GET')
                <div class="row g-3 p-2 justify-content-center">
                    <div class="col-10 col-md-3">
                        <select
                            class="form-select"
                            name="academic_year"
                            id="academicYearSelect"
                            required>
                            <option
                                value=""
                                selected
                                disabled>
                                Select Year...
                            </option>
                            @foreach($academic_years as $academic_year)
                            <option value="{{ $academic_year->id }}" {{ request('academic_year') == $academic_year->id ? 'selected' : '' }}>
                                {{ $academic_year->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-10 col-md-2">
                        <select
                            name="year_name"
                            class="form-select"
                            required>
                            <option value="" disable selected>
                                Select Year
                            </option>
                            <option value="1" {{ request('year_name') == '1' }}>First Year</option>
                            <option value="2" {{ request('year_name') == '2' }}>Second Year</option>
                            <option value="3" {{ request('year_name') == '3' }}>Third Year</option>
                            <option value="4" {{ request('year_name') == '4' }}>Fouth Year</option>
                            <option value="5" {{ request('year_name') == '5' }}>Final Year</option>
                        </select>
                    </div>
                    <div class="col-10 col-md-2">
                        <select
                            name="semester"
                            class="form-select"
                            required>
                            <option value="" disable selected>
                                Select Semester
                            </option>
                            <option value="1" {{ request('semester') == '1' }}>First Semester</option>
                            <option value="2" {{ request('semester') == '2' }}>Second Semester</option>
                        </select>
                    </div>
                    <div class="col-10 col-md-3">
                        <select
                            name="specialization"
                            id="specialization"
                            class="form-select p-2">
                            <option value="" disabled selected>
                                Enter your specialization
                            </option>
                            <option value="Computer Science and Technology">
                                Computer Science and Technology (CST)
                            </option>
                            <option value="Computer Science">
                                Computer Science (CS)
                            </option>
                            <option value="Computer Technology">Computer Technology</option>
                            <option value="High Performance Computing">
                                High Performance Computing(HPC)
                            </option>
                            <option value="Knowledge Engineering">
                                Knowledge Engineering(KE)
                            </option>
                            <option value="Business Information System">
                                Business Information System(BIS)
                            </option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Networking">Networking</option>
                            <option value="Embedded System">Embedded System</option>
                        </select>
                    </div>
                    <div class="col-10 col-md-2">
                        <button class="btn search-btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container marksForm" id="marksForm">
        <h5 class="marks-title my-3">Marks Certificate Form</h5>
        <div class="row justify-content-center my-4">
            <div class="col-10 col-md-6">
                <div class="card bg-tertiary shadow">
                    <div class="card-body">
                        <form action="{{ route('students.generateCertificate') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="academic_year" value="{{ request('academic_year') }}">
                            <input type="hidden" name="year_level" value="{{ request('year_name') }}">
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            <input type="hidden" name="specialization" value="{{ request('specialization') }}">
                            <input
                                class="form-control mt-2"
                                type="text"
                                id="student_code"
                                name="student_code"
                                placeholder="Enter student Code:" />
                            <input
                                class="form-control mt-3"
                                type="text"
                                id="name"
                                name="student_name"
                                placeholder="Enter your name:" />
                            <p class="subjects-title mt-2">Subjects</p>
                            @if($subjects)
                            @foreach($subjects as $subject)
                            <input
                                class="form-check-input mt-2"
                                type="checkbox"
                                value="{{$subject['id']}}"
                                name="subjects[]"
                                id="subjectMyanmar" />
                            <label
                                class="form-check-label text-dark"
                                for="subjectMyanmar">
                                {{ $subject['subject_name'] }}
                            </label><br />
                            @endforeach
                            @endif
                            <button type="submit" class="btn submit-btn">
                                Submit Application
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
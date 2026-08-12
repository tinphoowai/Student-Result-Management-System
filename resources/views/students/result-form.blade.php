@include('layouts.header')
<title>Result Form</title>
<link rel="stylesheet" href="{{ asset('css/result-form.css') }}" />
</head>

<body>
    <header>
        <h5 class="title">Student's Result Information System</h5>
        <a href="javascript:history.back()" class="btn back-btn">Back</a>
    </header>
    <h4 class="form-title">Result Form</h4>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow bg-tertiary my-4">
                    <form class="p-5" action="{{ route('students.getResult') }}" method="post">
                        @csrf
                        @method ('POST')
                        <label for="student_code" class="form-label label">Student Code:
                        </label>
                        <input
                            type="text"
                            name="student_code"
                            id="student_code"
                            required
                            class="form-control p-2"
                            placeholder="Enter your student code: MKPT-XXXX" />
                        <label for="academic_year" class="form-label input-label">Academic Year:
                        </label>
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
                            <option value="{{ $academic_year->id }}" >
                                {{ $academic_year->name }}
                            </option>
                            @endforeach

                        </select>
                        
                        <label for="year_name" class="form-label input-label">Year:
                        </label>
                        <select
                            name="year_level"
                            class="form-select"
                            required>
                            <option value="" disable selected>
                                Select Year
                            </option>
                            <option value="1">First Year</option>
                            <option value="2">Second Year</option>
                            <option value="3">Third Year</option>
                            <option value="4">Fouth Year</option>
                            <option value="5">Final Year</option>
                        </select>
                        <label for="semester" class="form-label input-label">Semester:
                        </label>
                        <select
                            name="semester"
                            class="form-select"
                            required>
                            <option value="" disable selected>
                                Select Semester
                            </option>
                            <option value="1">First Semester</option>
                            <option value="2">Second Semester</option>
                        </select>
                        <button class="btn submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.header')
<link rel="stylesheet" href="css/registration.css" />
<title>Student Registration Form</title>
</head>

<body>
    <h4 class="form-title">Register Here!</h4>
    <div class="container registration-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow bg-tertiary my-4">
                    <form class="p-5" method="post" action="{{route('students.register')}}">
                        @csrf
                        @method('POST')
                        <!-- Display General Credential Error -->
                        @if ($errors->any())
                        <div class="alert alert-danger p-2 small mb-3">
                            @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif
                        <label for="student_code" class="form-label label">Student Code:
                        </label>
                        <input
                            type="text"
                            name="student_code"
                            id="student_code"
                            required
                            value="{{ old('student_code') }}"
                            class="form-control p-2 @error('student_code') is-invalid @enderror"
                            placeholder="Enter your student code: MKPT-XXXX" />
                        @error('student_code')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="name" class="form-label sec-label">Student Name:
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            required
                            class="form-control p-2"
                            placeholder="Enter your name:" />
                        @error('name')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="email" class="form-label sec-label">Email:
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            required
                            class="form-control p-2"
                            placeholder="Enter your email:" />
                        @error('email')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="password" class="form-label sec-label">Password:
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="form-control p-2"
                            placeholder="Enter your password:" />
                        @error('password')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="nrc" class="form-label sec-label">NRC:
                        </label>
                        <input
                            type="text"
                            name="nrc"
                            id="nrc"

                            class="form-control p-2"
                            placeholder="Enter your NRC:" />
                        @error('nrc')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="dob" class="form-label sec-label">Date of Birth:
                        </label>
                        <input
                            type="date"
                            name="dob"
                            id="dob"
                            required
                            class="form-control p-2"
                            placeholder="Enter your date of birth:" />
                        @error('dob')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="phone" class="form-label sec-label">Phone:
                        </label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            required
                            class="form-control p-2"
                            placeholder="Enter your phone number:" />
                        @error('phone')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label for="address" class="form-label sec-label">Address:
                        </label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            class="form-control p-2"
                            placeholder="Enter your address:" />
                        @error('address')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <label
                            for="specialization"
                            class="form-label sec-label">Specialization:
                        </label>
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
                            <option value=" Knowledge Engineering">
                                Knowledge Engineering(KE)
                            </option>
                            <option value="Business Information System">
                                Business Information System(BIS)
                            </option>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Networking">Networking</option>
                            <option value="Embedded System"></option>
                        </select>
                        @error('specialization')
                        <div class="text-danger">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                        <span class="login-span">Have an account <a href="/login">Login Here</a></span>
                        <button class="register-btn" type="submit">
                            Register Now!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/student-dashboard.css')}}" />
<title>Home Page</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <h5 class="title">Student's Result Information System</h5>
        <form action="{{ route('students.logout') }}" method="post">
            @csrf 
            @method('POST')
            <button class="logout-btn logout-link">Logout</button>
        </form>

    </header>
    <div class="container">
        <div class="row justify-content-center d-flex gap-3">
            <a href="{{route('students.getCertificate') }}" class="btn btn-lg btn-marks-certificate col-auto">GET MARKS CERTIFICATE</a>
            <a href="{{ route('students.viewResult') }}" class="btn btn-lg  btn-exam-result col-auto">VIEW EXAMINATION RESULT</a>
        </div>
    </div>
    <footer class="mt-auto">
        <div class="footer-content">
            <p>Designed & Developed by </p>
            <p>Github:<a class="footer-link" href="https://github.com/tinphoowai">Tin Phoo Wai</a></p>
        </div>
    </footer>
</body>

</html>
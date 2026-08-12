@include('layouts.header')
<link rel="stylesheet" href="css/login.css" />
<title>Login Form</title>
</head>

<body>
    <h4 class="form-title">Login Here!</h4>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow bg-tertiary my-4">
                    <form class="p-5" action="{{route('login.perform')}}" method="post">
                        @csrf
                        @method('POST')
                        <label for="email" class="form-label label">Email:
                        </label>
                        <input
                            type="text"
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
                        <div class="form-check mb-2 mt-2">
                            <input class="form-check-input" type="checkbox" name="remember" />
                            <label class="form-check-label text-secondary" for="remember" />
                            Remember me
                        </div>
                        <button class="login-btn" type="submit">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
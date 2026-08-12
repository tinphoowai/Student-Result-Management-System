@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/admin-dashboard.css')}}" />
<title>@yield('title','Admin Dashboard')</title>
</head>

<body>
    @include('layouts.admin.navbar')
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>
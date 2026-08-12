@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/admin-dashboard.css')}}" />
<title>Admin Dashboard</title>
</head>

<body>
    @include('layouts.admin.navbar')
    @if (request()->routeIs('admin.index'))
    @include('admin.dashboard')
    @elseif (request()->routeIs('admin.students*'))
    @include('admin.students')
    @elseif (request()->routeIs('admin.subjects*'))
    @include('admin.subjects')
    @elseif (request()->routeIs('admin.registrations*'))
    @include('admin.registrations')
    @elseif (request()->routeIs('admin.marks*'))
    @include('admin.marks')
    @endif


</body>
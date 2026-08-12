@extends('layouts.admin')
@section('title','Admin Dashboard')
@section('content')
<div class="main-content">
    <h3 class="fw-bold text-dark mb-4">Dashboard Overview</h3>
    <div class="row">
        <div class="col-md-4 col-6">
            <div class="card border-0 p-4 shadow-sm bg-white">
                <p class="mb-0 text-muted">Total Students- {{ $total_student }}</p>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card border-0 p-4 shadow-sm bg-white">
                <p class="mb-0 text-muted">Total Subjects- {{ $total_subject }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
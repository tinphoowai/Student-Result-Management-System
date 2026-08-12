@extends('layouts.admin')
@section('title','Manage marks and results')
@section('content')
<div class="main-content">
    <div
        class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <h4 class="fw-bold m-0 text-dark">
            <i class="bi bi-calculator me-2"></i>Marks and Result
        </h4>
        <button
            type="button"
            class="btn btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#addMarksModal"
            data-url="{{ route('marks.add') }}"
            onclick="openAddMarkModal(this)">
            <i class="bi bi-plus-circle-fill"></i> Add Student Marks
        </button>
    </div>

    <!--Only Mark Records-->
    @include('admin.mark.mark-record')

    <!-- Result records -->
    @include('admin.mark.result-record')
</div>

<!-- Modal- Create Mark Record -->
@include('admin.mark.add-mark-modal')

<!-- Modal- Edit Mark Record -->
@include('admin.mark.edit-mark-modal')

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@push('scripts')
<script>
    function openAddMarkModal(button) {
        const form = document.getElementById('addMarkForm');
        const url = button.getAttribute('data-url');
        form.action = url;
    }

    function openEditMarkModal(button) {
        const form = document.getElementById('editMarkForm');
        const url = button.getAttribute('data-url');

        const registration_id = document.getElementById('registration_id');
        const mark = document.getElementById('mark');
        const grade = document.getElementById('grade');

        registration_id.value = button.getAttribute('data-registration_id');
        mark.value= button.getAttribute('data-mark');
        grade.value= button.getAttribute('data-grade');

        form.action = url;

    }
</script>
@endpush
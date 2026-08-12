@extends('layouts.admin')
@section('title','Manage Subjects')
@section('content')
<div class="main-content">
    <div
        class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <h4 class="fw-bold m-0 text-dark">
            <i class="bi bi-book-half me-2"></i> Subjects Master Data
        </h4>
        <div class="d-flex gap-2 action-btns">
            <a href="{{ url()->previous() }}" class="btn back-btn">
                <i class="bi bi-caret-left-fill"></i> Back
            </a>
            <button
                type="button"
                class="btn add-student-btn"
                data-bs-toggle="modal"
                data-url="{{ route('subjects.add') }}"
                data-bs-target="#addSubjectModal"
                onclick="addSubject(this)">
                <i class="bi bi-plus-circle-fill pe-none"></i> Add New Subject
            </button>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded mb-5">
        <table class="table table-striped align-middle m-0">
            <thead
                class="table-dark"
                style="--bs-table-bg: rgb(6, 6, 68)">
                <tr>
                    <th scope="col" style="width: 80px">ID</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col" style="width: 150px">Credit</th>
                    <th scope="col" style="width: 150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <th scope="row">{{ $subject->id }}</th>
                    <td class="fw-semibold">{{ $subject->subject_code }}</td>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $subject->credit }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button
                                type="button"
                                class="btn btn-sm btn-success"
                                data-url="{{ route('subjects.update',$subject->id) }}"
                                data-code="{{ $subject->subject_code }}"
                                data-name="{{ $subject->subject_name }}"
                                data-credit="{{ $subject->credit }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editSubjectModal"
                                onclick="openSubjectEditModal(this)">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('subjects.delete', $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Student">
                                    <i class="bi bi-trash3-fill" style="font-size:large;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.subject.academic-plan')
</div>
@include('admin.subject.add-subjects-modal')
@include('admin.subject.edit-subjects-modal')
@endsection

@push('scripts')
<script>
    function addSubject(button) {
        const form = document.getElementById('addSubjectForm')
        const url = button.getAttribute('data-url')
        form.action = url;

    }

    function openSubjectEditModal(button) {
        const url = button.getAttribute('data-url')
        const form = document.getElementById('editSubjectForm')
        form.action = url
        const code = button.getAttribute('data-code')
        const name = button.getAttribute('data-name')
        const credit = button.getAttribute('data-credit')
        document.getElementById('subject_code').value = code
        document.getElementById('subject_name').value = name
        document.getElementById('credit').value = credit
    }
</script>
@endpush
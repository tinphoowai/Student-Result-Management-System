@extends('layouts.admin')
@section('title','Manage Students')
@section('content')
<div class="main-content">
    <div
        class="header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <form action="{{ route('admin.students') }}" method="GET" class="input-group" style="max-width: 450px">
        
            <input
                name="search"
                type="text"
                class="form-control"
                placeholder="Enter student code to search"
                value="{{ request('search') }}" />
            <button
                class="btn text-white px-3"
                type="submit"
                style="background-color: rgb(6, 6, 68)">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ route('admin.students') }}" class="btn btn-outline-secondary ms-2">
                Reset
            </a>
            @endif
        </form>
        <div class="d-flex gap-2 action-btns">
            <a href="#" class="btn back-btn">
                <i class="bi bi-caret-left-fill"></i> Back
            </a>

            <a class="btn" href=" {{url('/admin/students/add')}}"
                type="button"
                class="btn add-student-btn"
                data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
                <i class="bi bi-person-plus-fill"></i> Add Student
            </a>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped align-middle m-0">
            <thead
                class="table-dark"
                style="--bs-table-bg: rgb(6, 6, 68)">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Student_ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Specialization</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <td>{{$student->student_code}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->dob}}</td>
                    <td>{{$student->specialization}}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#studentDetailModal"
                                data-nrc="{{ $student->nrc }}"
                                data-dob="{{ $student->dob }}"
                                data-address="{{ $student->address }}"
                                data-email="{{ $student->email }}"
                                data-phone="{{ $student->phone }}"
                                onclick="openStudentModal(this)">
                                <i class="bi bi-eye pe-none"></i> View
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#editStudentModal"
                                data-url="{{ route('students.update',$student->id) }}"
                                data-id="{{$student->id}}"
                                data-studentCode="{{ $student->student_code}}"
                                data-name="{{ $student->name }}"
                                data-password="{{ $student->password }}"
                                data-email="{{ $student->email }}"
                                data-phone="{{ $student->phone }}"
                                data-specialization="{{ $student->specialization }}"
                                data-dob="{{ $student->dob }}"
                                data-nrc="{{ $student->nrc }}"
                                data-address="{{ $student->address }}"
                                onclick="openEditModal(this)">
                                <i class="bi bi-pencil-square pe-none"></i>
                            </button>
                            <form action="{{ route('students.delete', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
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
</div>

<div
    class="modal fade"
    id="studentDetailModal"
    tabindex="-1"
    aria-labelledby="studentDetailModalLabel"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-centered modal-md m-3 m-sm-auto">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5
                    class="modal-title fw-bold"
                    id="studentDetailModalLabel">
                    Student Profile Details
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-6">
                        <small class="text-muted d-block">NRC Number</small>
                        <span class="fw-bold text-dark" id="modalStudentNRC"></span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Date of Birth</small>
                        <span class="fw-bold text-dark" id="modalStudentDob"></span>
                    </div>
                    <div class="col-12">
                        <hr class="my-2 text-muted" />
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Home Address</small>
                        <span class="fw-semibold text-dark" id="modalStudentAddress">
                        </span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Email</small>
                        <span class="fw-semibold text-dark" id="modalStudentEmail"></span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Phone</small>
                        <span class="fw-semibold text-dark" id="modalStudentPhone"></span>
                    </div>

                </div>
            </div>
            <div class="modal-footer bg-light">
                <button
                    type="button"
                    class="btn btn-secondary btn-sm"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- ➕ Add Student Modal -->
<div
    class="modal fade"
    id="addStudentModal"
    tabindex="-1"
    aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <!-- Modal Header -->
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5
                    class="modal-title fw-bold"
                    id="addStudentModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i> Register
                    New Student
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{route('admin.students.add')}}" method="POST">
                @csrf
                @method ('POST')
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Student ID -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Student ID</label>
                            <input
                                name="student_code"
                                type="text"
                                class="form-content-input form-control"
                                placeholder="e.g., MKPT-1111"
                                required />
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Full Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-content-input form-control"
                                placeholder="Enter student name"
                                required />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="example@gmail.com"
                                required />
                        </div>
                        <!-- Password -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Password"
                                required />
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Phone Number</label>
                            <input
                                type="tel"
                                name="phone"
                                class="form-control"
                                placeholder="Enter phone number"
                                required />
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Date of Birth</label>
                            <input
                                type="date"
                                name="dob"
                                class="form-control"
                                required />
                        </div>

                        <!-- NRC Number -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">NRC Number</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="ဥပမာ - ၁၂/လမန(နိုင်)၁၂၃၄၅၆" />
                        </div>

                        <!-- Specialization -->
                        <div class="col-md-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Specialization (Major)</label>
                            <select name="specialization" class="form-select py-2" required ">
                                <option value="" selected disabled>
                                    Choose Specialization...
                                </option>
                                <option value=" Software Engineering">
                                Software Engineering
                                </option>
                                <option
                                    value="Business Information System">
                                    Business Information System
                                </option>
                                <option value="Knowledge Engineering">
                                    Knowledge Engineering
                                </option>
                            </select>
                        </div>

                        <!-- Home Address -->
                        <div class="col-md-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Home Address</label>
                            <textarea
                                class="form-control"
                                name="address"
                                rows="3"
                                placeholder="Enter complete home address"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer (ခလုတ်များ) -->
                <div class="modal-footer bg-light">
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm px-3"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="btn text-white btn-sm px-4 fw-semibold"
                        style="background-color: rgb(6, 6, 68)">
                        Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ✏️ Edit Student Modal -->
<div
    class="modal fade"
    id="editStudentModal"
    tabindex="-1"
    aria-labelledby="editStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5
                    class="modal-title fw-bold"
                    id="editStudentModalLabel">
                    <i class="bi bi-pencil-square me-2"></i> Edit
                    Student Information
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="editStudentForm" method="post">
                @csrf
                @method ('PUT')
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Student ID -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Student ID</label>
                            <input
                                id="editStudentCode"
                                name="student_code"
                                type="text"
                                class="form-control bg-light"
                                value="" />
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Name</label>
                            <input
                                id="editStudentName"
                                name="name"
                                type="text"
                                class="form-control"
                                value=""
                                required />
                        </div>


                        <!-- Password -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Password</label>
                            <input
                                id="editStudentPassword"
                                name="password"
                                type="text"
                                class="form-control"
                                placeholder="Enter the new password" />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Email Address</label>
                            <input
                                id="editStudentEmail"
                                name="email"
                                type="email"
                                class="form-control"
                                value=""
                                required />
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Phone Number</label>
                            <input
                                id="editStudentPhone"
                                name="phone"
                                type="tel"
                                class="form-control"
                                value=""
                                required />
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Date of Birth</label>

                            <input
                                id="editStudentDob"
                                name="dob"
                                type="date"
                                class="form-control"
                                value=""
                                required />
                        </div>

                        <!-- NRC Number -->
                        <div class="col-md-6">
                            <label
                                class="form-label fw-semibold text-secondary small">NRC Number</label>
                            <input
                                id="editStudentNrc"
                                name="nrc"
                                type="text"
                                class="form-control"
                                value="" />
                        </div>

                        <!-- Specialization -->
                        <div class="col-md-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Specialization (Major)</label>
                            <select id="editStudentSpecialization" name="specialization" class="form-select py-2" required>
                                <option
                                    value="Computer Science and Technology">
                                    Computer Science and Technology
                                </option>
                                <option
                                    value="Computer Science">
                                    Computer Science
                                </option>
                                <option value="Computer Technology">
                                    Computer Technology
                                </option>
                                <option
                                    value="Software Engineering">
                                    Software Engineering
                                </option>
                                <option
                                    value="Business Information System">
                                    Business Information System
                                </option>
                                <option value="Knowledge Engineering">
                                    Knowledge Engineering
                                </option>
                                <option
                                    value="High Performance Computing">
                                    High Performance Computing
                                </option>
                                <option
                                    value="Networking">
                                    Networking
                                </option>
                                <option value="Embedded System">
                                    Embedded System
                                </option>
                            </select>
                        </div>

                        <!-- Home Address -->
                        <div class="col-md-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Home Address</label>
                            <textarea
                                id="editStudentAddress"
                                name="address"
                                class="form-control"
                                rows="3">

                                    </textarea>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm px-3"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success btn-sm px-4 fw-semibold">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openStudentModal(button) {

        const nrc = button.getAttribute('data-nrc');
        const dob = button.getAttribute('data-dob');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const address = button.getAttribute('data-address');
        document.getElementById('modalStudentNRC').textContent = nrc || 'Null';
        document.getElementById('modalStudentDob').textContent = dob;
        document.getElementById('modalStudentEmail').textContent = email;
        document.getElementById('modalStudentPhone').textContent = phone;
        document.getElementById('modalStudentAddress').textContent = address || 'Null';

    };

    function openEditModal(button) {
        const url = button.getAttribute('data-url');
        const form = document.getElementById('editStudentForm');
        form.action = url;

        const student_code = button.getAttribute('data-studentCode');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const address = button.getAttribute('data-address');
        const dob = button.getAttribute('data-dob');
        const specialization = button.getAttribute('data-specialization');
        const nrc = button.getAttribute('data-nrc');
        document.getElementById('editStudentCode').value = student_code;
        document.getElementById('editStudentEmail').value = email;
        document.getElementById('editStudentPhone').value = phone;
        document.getElementById('editStudentAddress').value = address;
        document.getElementById('editStudentDob').value = dob;
        document.getElementById('editStudentSpecialization').value = specialization;
        document.getElementById('editStudentName').value = name;
        document.getElementById('editStudentNrc').value = nrc;
    }
</script>
@endpush
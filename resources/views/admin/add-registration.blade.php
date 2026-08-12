<div
    class="modal fade"
    id="newRegistrationModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>New Registration Form
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <form id="addRegistrationForm" method="POST">
                @csrf
                @method ('POST')
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- 👈 LEFT COLUMN: Registration Selectors -->
                        <div class="col-lg-5 border-end pe-lg-4">
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-sliders me-1"></i> 1.
                                Input Details
                            </h6>

                            <div class="row g-3">
                                <!-- Student Input -->
                                <div class="col-12">
                                    <label
                                        class="form-label fw-semibold text-secondary small">Student Code / ID</label>

                                    <input
                                        name="student_code"
                                        type="text"
                                        class="form-control"
                                        name="student_code"
                                        id="studentCodeInput"
                                        placeholder="e.g., MKPT-1111"
                                        required />

                                </div>

                                <!-- Academic Year Selection -->
                                <div class="col-12">
                                    <label
                                        class="form-label fw-semibold text-secondary small">Academic Year</label>
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
                                        <option value="{{ $academic_year->id }}">
                                            {{ $academic_year->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>

                                <!-- Specialization -->
                                <div class="col-12">
                                    <label
                                        class="form-label fw-semibold text-secondary small">Specialization</label>
                                    <select
                                        class="form-select"
                                        name="specialization"
                                        id="specializationSelect"
                                        required>
                                        <option
                                            value=""
                                            selected
                                            disabled>
                                            Select Specialization...
                                        </option>
                                        
                                        <option value="Computer Science and Technology">
                                            Computer Science and Technlogy
                                        </option>
                                        <option value="Computer Science">
                                            Computer Science
                                        </option>
                                        <option value="Computer Technology">
                                            Computer Technology
                                        </option>
                                        <option value="Business Information System">
                                            Business Information System
                                        </option>
                                        <option value="Software Engineering">
                                            Software Engineering
                                        </option>
                                        <option value="Knowledge Engineering">
                                            Knowledge Engineering
                                        </option>
                                        <option value="Embedded System">
                                            Embedded System
                                        </option>
                                        <option value="Networking">
                                            Networking
                                        </option>

                                    </select>
                                </div>

                                <!-- Year Level -->
                                <div class="col-12">
                                    <label
                                        class="form-label fw-semibold text-secondary small">Year Level</label>
                                    <select
                                        name="year_level"
                                        class="form-select"
                                        id="yearLevelSelect"
                                        required>
                                        <option
                                            value=""
                                            selected
                                            disabled>
                                            Choose Year...
                                        </option>
                                        <option value="1">
                                            First Year
                                        </option>
                                        <option value="2">
                                            Second Year
                                        </option>
                                        <option value="3">
                                            Third Year
                                        </option>
                                        <option value="4">
                                            Fourth Year
                                        </option>
                                        <option value="5">
                                            Fifth Year
                                        </option>
                                    </select>
                                </div>

                                <!-- Semester -->
                                <div class="col-12">
                                    <label
                                        class="form-label fw-semibold text-secondary small">Semester</label>
                                    <select
                                        name="semester"
                                        class="form-select"
                                        id="semesterSelect"
                                        disabled
                                        required>
                                        <option
                                            value=""
                                            selected
                                            disabled>
                                            Choose Semester...
                                        </option>
                                        <option value="1">
                                            Semester 1
                                        </option>
                                        <option value="2">
                                            Semester 2
                                        </option>
                                    </select>
                                </div>

                                <!-- Add Single Subject Dropdown -->
                                <div
                                    class="col-12 mt-3"
                                    id="subjectSelectorContainer"
                                    style="display: none">
                                    <label
                                        class="form-label fw-bold text-dark small"><i class="bi bi-book me-1"></i>
                                        2. Select & Add Subject</label>
                                    <div class="d-flex gap-2">
                                        <select
                                            class="form-select"
                                            id="subjectDropdown">
                                            <option
                                                value=""
                                                selected
                                                disabled>
                                                Choose a subject to
                                                add...
                                            </option>
                                        </select>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            id="addSubjectBtn">
                                            <i class="bi bi-plus"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 👉 RIGHT COLUMN: Cumulative Subject Queue -->
                        <div
                            class="col-lg-7 ps-lg-4 d-flex flex-column"
                            style="min-height: 400px">
                            <div
                                class="border-bottom pb-2 mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold text-dark m-0">
                                        <i
                                            class="bi bi-list-check me-2 text-primary"></i>
                                        3. Selected Subjects & Types
                                    </h6>
                                    <span class="text-muted small">Summary to verify before
                                        saving.</span>
                                </div>
                                <span
                                    class="badge bg-dark"
                                    id="subjectCounterBadge">0 Added</span>
                            </div>

                            <!-- Student Info Meta Preview -->
                            <div
                                class="mb-3 p-2 bg-white rounded border d-flex justify-content-between text-muted small">
                                <div>
                                    <strong>Student ID:</strong>
                                    <span
                                        id="previewStudentName"
                                        class="text-dark fw-semibold">Not Inputted</span>
                                </div>
                                <div>
                                    <strong>Session:</strong>
                                    <span
                                        id="previewSession"
                                        class="text-dark fw-semibold">Not Selected</span>
                                </div>
                            </div>

                            <!-- Subjects Queue Table -->
                            <div
                                class="flex-grow-1 bg-white rounded border p-2 shadow-sm"
                                style="overflow-y: auto">
                                <table
                                    class="table table-hover align-middle table-sm m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Code</th>
                                            <th>Subject Name</th>
                                            <th>Credits</th>
                                            <th style="width: 140px">
                                                Type
                                            </th>
                                            <th
                                                style="
                                                            width: 50px;
                                                            text-align: center;
                                                        ">
                                                Remove
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        id="selectedSubjectsTableBody">
                                        <tr id="emptyRowPlaceholder">
                                            <td
                                                colspan="5"
                                                class="text-center text-muted py-5 small">
                                                No subjects added yet.
                                                Select a Term, choose
                                                subjects, and click
                                                "Add".
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                        Save Registration
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
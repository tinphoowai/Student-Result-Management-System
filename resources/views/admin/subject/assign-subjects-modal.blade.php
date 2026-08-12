<div
    class="modal fade"
    id="assignSubjectModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(20, 20, 90)">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-link-45deg me-1"></i> Map Subject to
                    Academic Plan
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>
            <form id="addAcademicPlanForm" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Academic Year</label>
                            <select name="year_level" class="form-select" required>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="5">5th Year</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label
                                class="form-label fw-semibold text-secondary small">Semester</label>
                            <select name="semester" class="form-select" required>
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Specialization</label>
                            <select name="specialization" class="form-select" required>
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
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Select Subject</label>
                            <select name="subject_id" class="form-select" required>
                                <option value="" selected disabled>
                                    Choose from master list...
                                </option>
                                @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">
                                    {{ $subject->subject_code }}({{ $subject->subject_name }})
                                </option>
                                @endforeach
                            </select>
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
                    <button
                        type="submit"
                        class="btn text-white btn-sm px-4 fw-semibold"
                        style="background-color: rgb(20, 20, 90)">
                        Assign to Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
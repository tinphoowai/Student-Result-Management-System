<div
    class="modal fade"
    id="addSubjectModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-plus-circle-fill me-2"></i> Add New
                    Subject
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="addSubjectForm">
                @csrf
                @method('POST')
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Subject Code</label>
                            <input
                                name="subject_code"
                                type="text"
                                class="form-control"
                                placeholder="e.g., CS-101"
                                required />
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Subject Name</label>
                            <input
                                name="subject_name"
                                type="text"
                                class="form-control"
                                placeholder="e.g., Web Development"
                                required />
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Credit</label>
                            <input
                                name="credit"
                                type="number"
                                class="form-control"
                                min="1"
                                max="4"
                                placeholder="e.g., 3"
                                required />
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
                        Save Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
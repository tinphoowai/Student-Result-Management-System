<div
    class="modal fade"
    id="addMarksModal"
    tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div
                class="modal-header text-white"
                style="background-color: rgb(6, 6, 68)">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-plus-lg me-2"></i> Create Mark
                    Record
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
            </div>

            <!-- Form actions point straight to your marks table mapping process -->
            <form id="addMarkForm" method="POST">
                @csrf 
                
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Registration Link ID -->
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Registration ID</label>
                            <input
                                type="number"
                                class="form-control"
                                name="registration_id"
                                placeholder="e.g., 101"
                                required />
                        </div>

                        <!-- Absolute Numerical score -->
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Total Mark</label>
                            <input
                                type="number"
                                class="form-control"
                                name="mark"
                                min="0"
                                max="100"
                                placeholder="0 - 100"
                                required />
                        </div>

                        <!-- Textual Grade Reference -->
                        <div class="col-12">
                            <label
                                class="form-label fw-semibold text-secondary small">Grade Letter</label>
                            <select
                                class="form-select"
                                name="grade"
                                required>
                                <option value="" selected disabled>
                                    Select grade letter...
                                </option>
                                <option value="A+">A+</option>
                                <option value="A">A</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="C+">C+</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="F">F</option>
                                <option value="S">S</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button
                        type="button"
                        class="btn btn-secondary btn-sm px-3"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                    <button
                        type="submit"
                        class="btn text-white btn-sm px-4 fw-semibold"
                        style="background-color: rgb(6, 6, 68)">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
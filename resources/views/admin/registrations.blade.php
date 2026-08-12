@extends('layouts.admin')
@section('title','Manage Registrations')
@section('content')
<div class="main-content">
    <div
        class="header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <h4 class="fw-bold m-0 text-dark">
            <i class="bi bi-journal-check me-2"></i> Course
            Registrations
        </h4>
        <button
            type="button"
            class="btn add-student-btn"
            data-bs-toggle="modal"
            data-bs-target="#newRegistrationModal"
            data-url="{{ route('registration.add') }}"
            onclick="openAddRegistrationModal(this)">
            <i class="bi bi-plus-circle-fill"></i> New Registration
        </button>
    </div>
    <!-- 📊 Main Table (Row by Row) -->
    @include('admin.registration-record',['registrations'=>$registrations])
</div>

<!-- Add course registration form-->
@include('admin.add-registration',['academic_years'=>$academic_years])

<!-- 📦 ADDED: Bootstrap 5 Bundle JS (Includes Popper.js for active modals and dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- 💡 JAVASCRIPT ENGINE -->
<script>
    // 1. Correct element IDs matching HTML
    const yearLevelSelected = document.getElementById('yearLevelSelect');
    const semesterSlected = document.getElementById('semesterSelect');
    const subjectSelectorContainer = document.getElementById('subjectSelectorContainer'); // Fixed spelling
    const subjectDropdown = document.getElementById('subjectDropdown'); // Fixed casing
    const addSubjectBtn = document.getElementById('addSubjectBtn');
    const subjectCounterBadge = document.getElementById('subjectCounterBadge');
    const selectedSubjectsTableBody = document.getElementById('selectedSubjectsTableBody');
    const emptyRowPlaceholder = document.getElementById('emptyRowPlaceholder'); // Fixed casing

    let selectedSubjectsList = []; // Consistent plural variable name

    // 2. Dynamic Change Event Listeners
    yearLevelSelected.addEventListener('change', function() {
        if (this.value) {
            semesterSlected.removeAttribute('disabled');
            loadSubjectsIntoDropDown();
        }
    });

    semesterSlected.addEventListener('change', loadSubjectsIntoDropDown);

    // 3. Fetch Function
    function loadSubjectsIntoDropDown() {
        const selectedYear = yearLevelSelected.value;
        const selectedSemester = semesterSlected.value;

        if (!selectedSemester || !selectedYear) return;

        subjectDropdown.innerHTML = '<option value="" selected disabled>Loading Subjects...</option>';
        subjectSelectorContainer.style.display = "block";

        const endpoint = `{{ route('academic-plans.subjects') }}?year_level=${selectedYear}&semester=${selectedSemester}`;

        fetch(endpoint)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error loading subjects');
                }
                return response.json(); // Fixed return statement
            })
            .then(subjects => {
                subjectDropdown.innerHTML = '<option value="" selected disabled>Choose a subject to add...</option>';

                if (subjects && subjects.length > 0) {
                    subjects.forEach(subject => {
                        const opt = document.createElement("option");
                        opt.value = subject.subject_id ?? subject.id;
                        opt.textContent = `${subject.subject_code} - ${subject.subject_name}`;
                        opt.setAttribute("data-code", subject.subject_code);
                        opt.setAttribute("data-name", subject.subject_name);
                        opt.setAttribute("data-credit", subject.credit);
                        subjectDropdown.appendChild(opt);
                    });
                } else {
                    subjectDropdown.innerHTML = '<option value="" selected disabled>No subjects found for this plan</option>';
                }
            })
            .catch(error => {
                console.error("Fatal error:", error);
                subjectDropdown.innerHTML = '<option value="" selected disabled>Failed to load subjects</option>';
            });
    }

    // 4. Add Subject Button Handler (Moved OUTSIDE loadSubjectsIntoDropDown)
    addSubjectBtn.addEventListener("click", function() {
        const selectedOption = subjectDropdown.options[subjectDropdown.selectedIndex];
        const val = subjectDropdown.value;

        if (!val) return;

        if (selectedSubjectsList.some(item => item.id === val)) {
            alert("This subject is already added!");
            return;
        }

        selectedSubjectsList.push({
            id: val,
            code: selectedOption.getAttribute("data-code"),
            name: selectedOption.getAttribute("data-name"),
            credit: selectedOption.getAttribute("data-credit"),
            type: "Regular"
        });

        renderSubjectsTable();
        subjectDropdown.selectedIndex = 0;
    });

    // 5. Render Table Queue Function
    function renderSubjectsTable() {
        if (emptyRowPlaceholder) {
            emptyRowPlaceholder.style.display = selectedSubjectsList.length > 0 ? "none" : "table-row";
        }

        const existingRows = selectedSubjectsTableBody.querySelectorAll(".subject-data-row");
        existingRows.forEach(row => row.remove());

        selectedSubjectsList.forEach(subject => {
            const tr = document.createElement("tr");
            tr.className = "subject-data-row";
            tr.innerHTML = `
                <td>
                    <span class="badge bg-secondary-subtle text-dark border">${subject.code}</span>
                    <input type="hidden" name="subject_ids[]" value="${subject.id}">
                </td>
                <td class="small fw-semibold">${subject.name}</td>
                <td class="small">${subject.credit}</td>
                <td>
                    <select class="form-select form-select-sm" name="reg_types[${subject.id}]" onchange="updateSubjectType('${subject.id}', this.value)">
                        <option value="Regular" ${subject.type === 'Regular' ? 'selected' : ''}>Regular</option>
                        <option value="Re-take" ${subject.type === 'Re-take' ? 'selected' : ''}>Re-take</option>
                        
                    </select>
                </td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeSubjectFromList('${subject.id}')">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </td>
            `;
            selectedSubjectsTableBody.appendChild(tr);
        });

        subjectCounterBadge.textContent = `${selectedSubjectsList.length} Added`;
    }

    // Global Functions for Inline Onclick Handlers
    window.updateSubjectType = function(id, val) {
        const item = selectedSubjectsList.find(i => i.id === id);
        if (item) item.type = val;
    };

    window.removeSubjectFromList = function(id) {
        selectedSubjectsList = selectedSubjectsList.filter(item => item.id !== id);
        renderSubjectsTable();
    };

    window.openAddRegistrationModal = function(button) {
        const url = button.getAttribute('data-url');
        const form = document.getElementById('addRegistrationForm');
        if (form && url) {
            form.action = url;
        }
        
        // Reset list state when opening modal
        selectedSubjectsList = [];
        renderSubjectsTable();
    };
</script>
@endsection
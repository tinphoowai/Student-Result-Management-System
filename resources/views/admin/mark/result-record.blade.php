<div class="card border-0 shadow-sm rounded">
    <div
        class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <div>
            <h6 class="m-0 fw-bold text-primary">
                <i class="bi bi-file-earmark-person-fill me-2"></i>
                2. Core History View (For Student Requests)
            </h6>
            <span class="text-muted small">Compiled transcript view using relational schema
                joins</span>
        </div>
        <!-- Mock Search Field to simulate history filtering -->
        <div style="max-width: 250px" class="w-100">
            <input
                type="text"
                class="form-control form-control-sm"
                placeholder="Search Student Code..." />
        </div>
    </div>
    <div class="table-responsive">
        <table
            class="table table-hover align-middle m-0 border-top">
            <thead
                class="table-light text-secondary small text-uppercase">
                <tr>
                    <th>Student Code</th>
                    <th>Student Name</th>
                    <th>Academic Year</th>
                    <th>Year Level</th>
                    <th>Semester</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Mark</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                <tr>
                    <td class="fw-bold text-dark">{{ $result->student_code }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->academic_year }}</td>
                    <td>Year {{ $result->year_level }}</td>
                    <td>Semester {{ $result->semester }}</td>
                    <td>
                        <span
                            class="badge bg-secondary-subtle text-dark border">{{ $result->subject_code }}</span>
                    </td>
                    <td>{{ $result->sub_name }}</td>
                    <td class="fw-bold">{{ $result->mark }}</td>
                    <td>{{ $result->grade }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
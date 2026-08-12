<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 fw-bold text-secondary">
            Individual Subject Registration Records
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle m-0">
            <thead
                class="table-dark"
                style="--bs-table-bg: rgb(6, 6, 68)">
                <tr>
                    <th>Record ID</th>
                    <th>Student Code</th>
                    <th>Academic Year</th>
                    <th>Term Level</th>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Type</th>
                    <th style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                <tr>
                    <th scope="row">{{ $registration->id }}</th>
                    <td class="fw-bold text-secondary">
                        {{ $registration->student->student_code }}
                    </td>
                    <td>{{ $registration->academicYear->name }}</td>
                    <td>{{ $registration->year_level}} (Semester-{{ $registration->semester }})</td>
                    <td>
                        <span
                            class="badge bg-secondary-subtle text-dark border">{{ $registration->subject->subject_code }}</span>
                    </td>
                    <td>{{ $registration->subject->subject_name }}</td>
                    <td>
                        <span class="badge bg-success">{{ $registration->type }}</span>
                    </td>
                    <td style="text-align: center">
                        <form action="{{ route('registrations.delete', $registration->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this registration record?');">
                            @csrf
                            @method('DELETE')
                            <button
                                class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
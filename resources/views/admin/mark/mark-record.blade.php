<div class="card border-0 shadow-sm rounded mb-5">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 fw-bold text-dark">
            <i class="bi bi-database me-2 text-secondary"></i> 1.
            Marks
        </h6>
        <span class="text-muted small">Raw data entry view mappings</span>
    </div>
    <div class="table-responsive">
        <table class="table table-striped align-middle m-0">
            <thead
                class="table-dark"
                style="--bs-table-bg: rgb(6, 6, 68)">
                <tr>
                    <th>id</th>
                    <th>registration_id</th>
                    <th>mark</th>
                    <th>grade</th>
                    <th style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marks as $mark)
                <tr>
                    <th scope="row">{{ $mark->id }}</th>
                    <td>{{ $mark->registration_id }}</td>
                    <td class="fw-bold">{{ $mark->mark }}</td>
                    <td><span class="badge bg-success">{{ $mark->grade }}</span></td>
                    <td style="text-align: center">
                        <button
                            class="btn btn-sm btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#editMarksModal"
                            data-url="{{ route('marks.update',$mark->id) }}"
                            data-mark_id="{{ $mark->id }}"
                            data-registration_id="{{ $mark->registration_id }}"
                            data-mark="{{ $mark->mark }}"
                            data-grade="{{ $mark->grade }}"
                            onclick="openEditMarkModal(this)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('marks.delete', $mark->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this registration record?');">
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
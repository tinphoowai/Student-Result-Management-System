    <hr class="my-5" style="border-top: 2px dashed #ced4da" />
    <div class="card border-0 shadow-sm rounded">
        <div
            class="card-header text-white p-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2"
            style="background-color: rgb(20, 20, 90)">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-calendar3 me-2"></i> Academic Curriculum
                Plan Mapping
            </h5>
            <button
                type="button"
                class="btn btn-sm btn-light fw-semibold text-dark"
                data-url="{{ route('subjects.plans.add') }}"
                data-bs-toggle="modal"
                data-bs-target="#assignSubjectModal"
                onclick="addAcademicPlan(this)">
                <i class="bi bi-link-45deg"></i> Assign Subject to Plan
            </button>
        </div>

        <div class="card-body p-4">
            <!-- 📅 Academic Plan Roadmap Section -->
            <div class="mt-3">
               
                <div id="academic-plan-result">
                    <div class="row g-4">

                        @forelse($academic_plans as $year => $specializations)

                        @foreach($specializations as $specialization => $semesters)

                        @foreach($semesters as $semester => $plans)

                        <div class="col-12">

                            <div class="card border-0 shadow-sm rounded">

                                <div class="card-header text-white p-3 fw-bold"
                                    style="background-color: rgb(20,20,90);">

                                    <i class="bi bi-1-circle-fill me-2"></i>

                                    Year {{ $year }} -
                                    {{ $specialization }}
                                    -
                                    Semester {{ $semester }}

                                </div>


                                <div class="card-body p-3">

                                    <div class="table-responsive">

                                        <table class="table table-sm table-striped table-hover">

                                            <thead class="table-light">

                                                <tr>
                                                    <th>Code</th>
                                                    <th>Subject Name</th>
                                                    <th class="text-center">
                                                        Credit
                                                    </th>
                                                </tr>

                                            </thead>


                                            <tbody>

                                                @foreach($plans as $academic_plan)

                                                <tr>
                                                    <td class="fw-bold text-secondary">
                                                        {{ $academic_plan->subject?->subject_code ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $academic_plan->subject?->subject_name ?? 'No Subject Found' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $academic_plan->subject?->credit ?? '-' }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        @empty
                        <div class="alert alert-info">
                            No academic plans found.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.subject.assign-subjects-modal',['subjects'=>$subjects])
    <script>
        function addAcademicPlan(button) {
            const url = button.getAttribute('data-url')
            const form = document.getElementById('addAcademicPlanForm')
            form.action = url
        }
        const yearLevel = document.getElementById('year_level')
        const semester = document.getElementById('semester')
        const specialization = document.getElementById('specialization');

        function searchAcademicPlan() {
            let yearValue = yearLevel.value
            let semesterValue = semester.value
            let specializationValue = specialization.value;

            fetch(`subjects/academic-plans?year_level=${yearValue}&semester=${semesterValue}&specialization=${specializationValue}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('academic-plan-result').innerHTML = data
                })
        }
        yearLevel.addEventListener('change', searchAcademicPlan)
        semester.addEventListener('change', searchAcademicPlan)
        specialization.addEventListener('change', searchAcademicPlan)
    </script>
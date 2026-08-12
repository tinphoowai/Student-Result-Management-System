  <nav
      class="navbar navbar-expand-md navbar-light bg-light sidebar-nav align-items-start">
      <div
          class="container-fluid flex-md-column align-items-md-stretch p-0">
          <div
              class="d-flex justify-content-between align-items-center w-100 px-3 py-2 border-bottom-md">
              <a class="navbar-brand fw-bold fs-4 text-dark" href="{{url('/admin')}}">SRIS</a>

              <button
                  class="navbar-toggler border-0"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#sidebarContent"
                  aria-controls="sidebarContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>

          <div
              class="collapse navbar-collapse w-100 mt-md-3"
              id="sidebarContent">
              <ul class="navbar-nav flex-column w-100 px-2">
                  <li class=" nav-item  mb-1">
                      <a class="nav-link {{request()->routeIs('admin.index') ? 'active' : '' }}" href="{{url('/admin')}}">Dashboard</a>
                  </li>
                  <li class=" nav-item  mb-1">
                      <a class="nav-link {{request()->routeIs('admin.students*') ? 'active' : '' }}" href="{{url('/admin/students')}}">Manage Students</a>
                  </li>
                  <li class=" nav-item  mb-1">
                      <a class="nav-link {{request()->routeIs('admin.subjects*') ? 'active' : '' }}" href="{{url('/admin/subjects')}}">Manage Subjects</a>
                  </li>
                  <li class="nav-item    mb-1">
                      <a class="nav-link {{request()->routeIs('admin.registrations*') ? 'active' : '' }}" href="{{url('/admin/registrations')}}">Course Registrations</a>
                  </li>
                  <li class="nav-item  mb-1">
                      <a class="nav-link {{request()->routeIs('admin.marks*') ? 'active' : '' }}" href="{{url('/admin/marks')}}">Marks & Results</a>
                  </li>
                  <li class="nav-item mb-1">
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf 
                        @method('POST')
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
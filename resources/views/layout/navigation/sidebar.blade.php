<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="d-block text-white">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->role == '1')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('departments.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Departments</p>
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="{{ route('departments.employee') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Employees</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('departments.employee-jobs') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                            <p>Employee Updates</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == '2')
                    <li class="nav-item">
                        <a href="{{ route('department_head.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('department_head.joblist') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                            <p>Employee Updates</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

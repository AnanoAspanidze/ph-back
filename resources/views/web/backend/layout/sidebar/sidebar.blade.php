
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link" style="font-size: 14px;">
        <span class="brand-text font-weight-light">ადმინისტრატორის პანელი</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('topic.index')}}" class="nav-link {{ Request::segment(2) === 'topic' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            თემები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('student_resources.index')}}" class="nav-link {{ Request::segment(2) === 'student_resources' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            მოსწავლის რესურსი
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teacher_resources.index')}}" class="nav-link {{ Request::segment(2) === 'teacher_resources' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            განმანათლებლის რესურსი
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teachers.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            განმანათლებლები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('additional_resources.index')}}" class="nav-link {{ Request::segment(2) === 'additional_resources' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            დამატებითი რესურსები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('language.index')}}" class="nav-link {{ Request::segment(2) === 'language' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ენები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('static_textes.index')}}" class="nav-link {{ Request::segment(2) === 'static_textes' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            საიტის ტექსტები
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about.index')}}" class="nav-link {{ Request::segment(2) === 'about' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ჩვენზე
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
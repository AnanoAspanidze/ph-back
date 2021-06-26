<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                ადმინისტრატორი
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{route('admin')}}" class="dropdown-item">
                    ადმინისტრატორის პანელი
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('profile.edit', \Auth::id())}}" class="dropdown-item">
                    პროფილის რედაქტირება
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" id="logout" class="dropdown-item">
                    გამოსვლა
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
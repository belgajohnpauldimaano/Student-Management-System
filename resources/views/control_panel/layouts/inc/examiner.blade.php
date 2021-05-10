@if (Auth::user()->role == 8)
    <li class="nav-item">
        <a class="nav-link "
        href="">
        <i class="fa fa-home fa-fw fa-lg"></i> <p>Home</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link "
        href="">
        <i class="fa fa-home fa-fw fa-lg"></i> <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link "
        href="">
        <i class="fa fa-info-circle fa-lg"></i> <p>Entrance Exams</p>
        </a>
    </li>
@endif
{{-- <script src="http://localhost:8098"></script> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="{{ asset('css/style.css') }}" rel=" stylesheet" />
    {{-- <link href="{{ asset('css/sb-admin.css') }}" rel=" stylesheet" /> --}}
    {{-- <link href="{{ asset('css/jQuery.dataTables.min.css') }}" rel=" stylesheet" /> --}}
    {{-- <link href="{{ asset('css/font.css') }}s" rel="stylesheet" type="text/css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/fontawesome.min.css"
        integrity="sha512-Rcr1oG0XvqZI1yv1HIg9LgZVDEhf2AHjv+9AuD1JXWGLzlkoKDVvE925qySLcEywpMAYA/rkg296MkvqBF07Yw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jQuery.dataTables.js') }}" crossorigin="anonymou"></script>



</head>

<body class="sb-nav-fixed">
    @if (Auth::check())
        <meta name="user_id" content="{{ Auth::user()->id }}" />
    @endif
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <span class="p-2"><img src="{{ asset('images/NationalEmblem5.png') }}" alt=""></span>
        <a class="navbar-brand ps-3" href="index.html"><b>Correspondence</b> <br> <i>WriterJet</i></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form> --}}
        <!-- Navbar-->
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                {{-- <ul class="d-none form-inline ms-auto me-0 me-md-3 my-2 my-md-0"> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li> --}}
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                {{-- hide for Pending users --}}
                @if (Auth::user()->registration_status == 'Pending')
                    <span class="alert-danger p-2">
                        <p>Menu Disabled</p>
                        <p> Account's Not Activated</p>
                    </span>
                @else

                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">{{ __('Home') }}</div>
                            <a class="nav-link" href="/home">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                {{ __('Dashboard') }}
                            </a>
                            <div class="sb-sidenav-menu-heading">{{ __('Correspondence') }}</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseCompose" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-pen-nib"></i></div>
                                {{ __('Compose') }}
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompose" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/documents/create">
                                        <div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div>
                                        {{ __('Write') }}
                                    </a>
                                    <a class="nav-link" href="/documents-drafts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                        {{ __('Drafts') }}
                                    </a>
                                    <a class="nav-link" href="/templates">
                                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                        {{ __('Templates') }}
                                    </a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseDocuments" aria-expanded="false"
                                aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                {{ __('Documents') }}
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDocuments" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/documents">
                                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                        {{ __('My Documents') }}
                                    </a>
                                    <a class="nav-link" href="/for-secretaries">
                                        <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
                                        {{ __('For Secretary') }}
                                    </a>
                                    <a class="nav-link" href="/documents-archives">
                                        <div class="sb-nav-link-icon"><i class="fas fa-trash-alt"></i></div>
                                        {{ __('Archives') }}
                                    </a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">{{ 'system Administration' }}</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseDocumentComponents" aria-expanded="false"
                                aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-pen-nib"></i></div>
                                {{ __('Document Components') }}
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDocumentComponents" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('categories.index') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div>
                                        {{ __('Categories') }}
                                    </a>
                                    <a class="nav-link" href="{{ route('ministries.index') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                        {{ __('Organisations') }}
                                    </a>
                                </nav>
                            </div>
                            @if (Auth::user()->type == 'Administrator')
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    {{ __('User Management') }}
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                                    data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link" href="/users-list">
                                            {{ __('Users') }}
                                        </a>
                                        <a class="nav-link" href="#">
                                            {{ __('Register') }}
                                        </a>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Public Service Office 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{ asset('js/simple-datatables@latest.js') }}" crossorigin="anonymous"></script> --}}
    {{-- <script src="js/dataTable_simple.js"></script> --}}
</body>

</html>

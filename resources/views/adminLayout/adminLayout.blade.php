<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breeze Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar-logo {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1rem;
        }
        .avatar {
            width: 32px;
            height: 32px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .search-input {
            border-radius: 20px;
            padding-left: 2.5rem;
        }
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                height: 100vh;
                z-index: 999;
                width: 250px;
            }
            .sidebar.active {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky">
                    <a href="{{route('adminDashboard')}}" style="text-decoration: none;">
                        <div class="sidebar-logo d-flex align-items-center">
                            <i class="bi bi-hurricane me-2"></i>
                            <span>Breeze</span>
                        </div>
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('adminDashboard')}}">
                                <i class="bi bi-house-door me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('questionOverview')}}">
                                <i class="bi bi-pencil-square me-2"></i>
                                Section Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu" data-bs-toggle="collapse" aria-expanded="false">
                                <i class="bi bi-folder me-2"></i>
                                Sections
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul class="collapse nav flex-column ms-3" id="submenu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('AddSectionPage')}}">
                                        <i class="bi bi-folder-plus me-2"></i>
                                        Add Section
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{route('SectionPage')}}">
                                        <i class="bi bi-folder-symlink me-2"></i>
                                        Manage Sections
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('AddQuestionPage')}}">
                                <i class="bi bi-plus-circle me-2"></i>
                                Add Test
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('ExamOverview')}}">
                                <i class="bi bi-bar-chart me-2"></i>
                                Exam Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roadsign.overview.page')}}">
                                <i class="bi bi-sign-stop me-2"></i>
                                Road Signs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roadsign.add.page')}}">
                                <i class="bi bi-plus-square me-2"></i>
                                Add Road Sign
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <button class="btn btn-link d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <div class="position-relative w-100 w-md-50">
                        <i class="bi bi-search search-icon text-muted"></i>
                        <input type="text" class="form-control search-input" placeholder="Search...">
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            {{-- <button type="button" class="btn btn-sm btn-outline-secondary position-relative">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary position-relative">
                                <i class="bi bi-envelope"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    7
                                </span>
                            </button> --}}
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle avatar me-2">
                                {{Auth::guard('Admin')->user()->email}}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><h6 class="dropdown-header">$8,753.00</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-credit-card me-2"></i>Billing</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </header>



                @yield('DetailedGraphs'){{-- for graphs --}}
                @yield('content'){{--  --}}
                @yield('contentDashboard'){{--  --}}

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('sidebar');
            var sidebarToggle = document.querySelector('[data-bs-target="#sidebar"]');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside of it on mobile
            document.addEventListener('click', function(event) {
                var isClickInsideSidebar = sidebar.contains(event.target);
                var isClickOnToggle = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>

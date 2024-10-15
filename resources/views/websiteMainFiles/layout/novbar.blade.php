@section('novbar')

<header>
     <!-- Favicon -->
    <link href="{{asset('websiteMainFiles/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('websiteMainFiles/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('websiteMainFiles/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('websiteMainFiles/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('websiteMainFiles/css/style.css')}}" rel="stylesheet">
</header>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="{{route('main')}}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <h2 class="m-0"><i class="fa fa-car text-primary me-2"></i>Drivin</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">

            <a href="{{route('main')}}" class="nav-item nav-link @if (session('member')== 'home') active @endif">нүүр хуудас</a>
            <a href="about.html" class="nav-item nav-link"></a>
            <a href="{{route('main.test')}}" class="nav-item nav-link @if (session('member')== 'tests') active @endif">тестүүд</a>
            <a href="{{route('roadSigns')}}" class="nav-item nav-link @if (session('member')== 'roadSigns') active @endif">Замын тэмдэг</a>

            <a href="{{route('exam.section')}}" class="nav-item nav-link @if (session('member')== 'exams') active @endif">шалгалтууд</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">s</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="feature.html" class="dropdown-item">Features</a>
                    <a href="appointment.html" class="dropdown-item">Appointment</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="{{route('contact')}}" class="nav-item nav-link @if (session('member')== 'contact') active @endif">холбоо барих</a>
        </div>
        @auth('Member')
            <a href="{{ route('MemberDashboard') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                Хяналтын самбар<i class="fa fa-arrow-right ms-3"></i>
            </a>
        @endauth

        @guest('Member')
            <a href="{{ route('registerPage') }}" class="  btn  btn-primary py-4 px-lg-5 d-none d-lg-block">
                Бүртгүүлэх <i class="fa fa-arrow-right ms-3"></i>
            </a>
        @endguest
    </div>
</nav>
@endsection

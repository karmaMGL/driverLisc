<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Drivin - Driving School Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>123 Street, New York, USA</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
@include('websiteMainFiles.layout.novbar')
@yield('novbar')
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            @isset($MatchSection)
                <h1 class="display-4 text-white animated slideInDown mb-4">Тестүүд</h1>
            @endisset
            @isset($exams)
                <h1 class="display-4 text-white animated slideInDown mb-4">шалгалтууд</h1>
            @endisset
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{route('main')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    @isset($MatchSection)
                        <li class="breadcrumb-item text-primary active" aria-current="page">Тестүүд</li>
                    @endisset
                    @isset($exams)
                        <li class="breadcrumb-item text-primary active" aria-current="page">шалгалтууд</li>
                    @endisset
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Courses Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                @isset($MatchSection)
                    <h6 class="text-primary text-uppercase mb-2">Тестүүд</h6>
                @endisset
                @isset($exams)
                    <h6 class="text-primary text-uppercase mb-2">шалгалтууд</h6>
                @endisset
                <h1 class="display-6 mb-4">....</h1>
            </div>
            <div class="row g-4 justify-content-center">
                {{-- 1 cell
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">$99</div>
                            <h5 class="mb-3">Automatic Car Lessons</h5>
                            <p>Tempor erat elitr rebum at clita dolor diam ipsum sit diam amet diam et eos</p>
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Beginner</li>
                                <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>3 Week</li>
                            </ol>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="websiteMainFiles/img/courses-1.jpg" alt="">
                            <div class="courses-overlay">
                                <a class="btn btn-outline-primary border-2" href="">Read More</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @isset($MatchSection)
                    @php
                    $counter =0;
                    @endphp
                    @foreach ($MatchSection as $sec)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                                <div class="text-center p-4 pt-0">
                                    <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">Free</div>

                                    <h5 class="mb-3">{{$sec}}. {{$Title[$counter]}}</h5>
                                    <p>...</p>
                                    <p>Total tests: {{$QuestionCounts[$counter]}}</p>
                                </div>
                                <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="websiteMainFiles/img/courses-1.jpg" alt="">
                                    <div class="courses-overlay">
                                        <a class="btn btn-outline-primary border-2" href="{{route('OpenSection',$sectionID[$counter])}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                @endisset
                @isset($exams)

                    @foreach ($exams as $exam)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                                <div class="text-center p-4 pt-0">
                                    <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">Free</div>

                                    <h5 class="mb-3"> {{$exam->name}}</h5>
                                    <p>...</p>
                                    <p>нийт даалгавар: {{count(json_decode($exam->selectedQuestIDs,true))}}</p>
                                </div>
                                <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="websiteMainFiles/img/courses-1.jpg" alt="">
                                    <div class="courses-overlay">
                                        <a class="btn btn-outline-primary border-2" href="{{route('exam.questions',[$exam->id])}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                @isset($roadSigns)
                    @foreach ($roadSigns as $roadSign)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                                <div class="text-center p-4 pt-0">
                                    <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">Free</div>
                                    <h5 class="mb-3"> {{$roadSign->name}}</h5>
                                    <p>...</p>
                                </div>
                                <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="{{ asset($roadSign->imagePath) }}" alt="{{ $roadSign->name }}" data-bs-toggle="modal" data-bs-target="#roadSignModal{{ $roadSign->id }}">


                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="roadSignModal{{ $roadSign->id }}" tabindex="-1" aria-labelledby="roadSignModalLabel{{ $roadSign->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="{{ asset($roadSign->imagePath) }}" class="img-fluid" alt="{{ $roadSign->name }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset

                {{-- <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">$99</div>
                            <h5 class="mb-3">Automatic Car Lessons</h5>
                            <p>Tempor erat elitr rebum at clita dolor diam ipsum sit diam amet diam et eos</p>
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item small"><i class="fa fa-signal text-primary me-2"></i>Beginner</li>
                                <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i>3 Week</li>
                            </ol>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="websiteMainFiles/img/courses-1.jpg" alt="">
                            <div class="courses-overlay">
                                <a class="btn btn-outline-primary border-2" href="">Read More</a>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Get In Touch</h4>
                    <h2 class="text-primary mb-4"><i class="fa fa-car text-white me-2"></i>Drivin</h2>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Popular Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3 border-0" placeholder="Your Email Address">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-white mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('websiteMainFiles/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('websiteMainFiles/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('websiteMainFiles/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('websiteMainFiles/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('websiteMainFiles/js/main.js')}}"></script>
</body>

</html>

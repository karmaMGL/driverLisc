<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Breeze Admin</title>
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/vendors/mdi/css/materialdesignicons.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/vendors/flag-icon-css/css/flag-icon.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/vendors/css/vendor.bundle.base.css")}} />
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/vendors/font-awesome/css/font-awesome.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboardAssets/assets/css/style.css")}} />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body class>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo" href="{{route('main')}}"><img src="{{asset('dashboardAssets/assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{route('main')}}"><img src="dashboardAssets/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="{{route('adminDashboard')}}" class="nav-link">
              <div class="nav-profile-image">
                <img src="{{asset('dashboardAssets/assets/images/faces/default-profile.jpg')}}" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column pr-3">
                <span class="font-weight-medium mb-2">Henry Klein</span>
                <span class="font-weight-normal">$8,753.00</span>
              </div>
              <span class="badge badge-danger text-white ml-3 rounded">3</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('adminDashboard')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Basic UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                </li>
              </ul>
            </div>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{route('questionOverview')}}">
              <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Edit Tests</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('AddSectionPage')}}">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Add Section</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('AddQuestionPage')}}">
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Add test</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="{{route('ExamOverview')}}">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Exam Overview</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('roadsign.overview.page')}}">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Road Signs</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('roadsign.add.page')}}">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Add Road Sign</span>
            </a>
          </li>


          {{-- <li class="nav-item">
            <span class="nav-link" href="#">
              <span class="menu-title">Docs</span>
            </span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> --}}
          <li class="nav-item sidebar-actions">
            <div class="nav-link">
              <div class="mt-4">
                <div class="border-none">
                  <p class="text-black"></p>
                </div>
                <ul class="mt-4 pl-0">
                  <a href="{{route('logout')}}"><li>Sign Out</li></a>
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles light"></div>
            <div class="tiles dark"></div>
          </div>
        </div>
        <nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
            <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="{{asset('dashboardAssets/assets/images/logo-mini.svg')}}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
              <i class="mdi mdi-menu"></i>
            </button>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                  <span class="count count-varient1">7</span>
                </a>
                <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{asset('dashboardAssets/assets/images/faces/default-profile.jpg')}}" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{asset('dashboardAssets/assets/images/faces/default-profile.jpg')}}" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="{{asset('dashboardAssets/assets/images/faces/default-profile.jpg')}}" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you in his post</span>
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0">View all activities</p>
                </div>
              </li>
              <li class="nav-item dropdown d-none d-sm-flex">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-email-outline"></i>
                  <span class="count count-varient2">5</span>
                </a>
                <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow">
                      <span class="badge badge-pill badge-success">Request</span>
                      <p class="text-small text-muted ellipsis mb-0"> Suport needed for user123 </p>
                    </div>
                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow">
                      <span class="badge badge-pill badge-warning">Invoices</span>
                      <p class="text-small text-muted ellipsis mb-0"> Invoice for order is mailed </p>
                    </div>
                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow">
                      <span class="badge badge-pill badge-danger">Projects</span>
                      <p class="text-small text-muted ellipsis mb-0"> New project will start tomorrow </p>
                    </div>
                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                  </a>
                  <h6 class="p-3 mb-0">See all activity</h6>
                </div>
              </li>
              <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">
                <form class="nav-link form-inline mt-2 mt-md-0">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                  </div>
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right ml-lg-auto">
              <li class="nav-item dropdown d-none d-xl-flex border-0">
                <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-earth"></i> English </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                  <a class="dropdown-item" href="#"> French </a>
                  <a class="dropdown-item" href="#"> Spain </a>
                  <a class="dropdown-item" href="#"> Latin </a>
                  <a class="dropdown-item" href="#"> Japanese </a>
                </div>
              </li>
              <li class="nav-item nav-profile dropdown border-0">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                  <img class="nav-profile-img mr-2" alt="" src="{{asset('dashboardAssets/assets/images/faces/default-profile.jpg')}}" />
                  <span class="profile-name">{{Auth::guard('Admin')->user()->email}}</span>
                </a>
                <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                  <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        @yield('contentDashboard')

        <div class="main-panel">
            @yield('content')

          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
            </div>
          </footer>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src={{asset("dashboardAssets/assets/vendors/js/vendor.bundle.base.js")}}></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src={{asset("dashboardAssets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.resize.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/chart.js/Chart.min.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.categories.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.fillbetween.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.stack.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.pie.js")}}></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{asset("dashboardAssets/assets/js/off-canvas.js")}}></script>
    <script src={{asset("dashboardAssets/assets/js/hoverable-collapse.js")}}></script>
    <script src={{asset("dashboardAssets/assets/js/misc.js")}}></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src={{asset("dashboardAssets/assets/js/dashboard.js")}}></script>
    <!-- End custom js for this page -->
  </body>
</html>

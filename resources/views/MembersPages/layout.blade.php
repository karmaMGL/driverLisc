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
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
          <a class="sidebar-brand brand-logo" href="{{route('main')}}"><img src="{{asset('dashboardAssets/assets/images/logo.svg')}}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{route('main')}}"><img src="dashboardAssets/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="dashboardAssets/assets/images/faces/face1.jpg" alt="profile" />
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
            <a class="nav-link" href="index.html">
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
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Forms</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item">
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
            <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="dashboardAssets/assets/images/logo-mini.svg" alt="logo" /></a>
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
                      <img src="dashboardAssets/assets/images/faces/face4.jpg" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="dashboardAssets/assets/images/faces/face3.jpg" alt="" class="profile-pic" />
                    </div>
                    <div class="preview-item-content">
                      <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                      </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="dashboardAssets/assets/images/faces/face2.jpg" alt="" class="profile-pic" />
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
                  <img class="nav-profile-img mr-2" alt="" src="dashboardAssets/assets/images/faces/face1.jpg" />
                  <span class="profile-name">




                    {{Auth::guard('Member')->user()->name}}</span>
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
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <h3 class="mb-0"> Hi, welcome back! <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Your web analytics dashboard template.</span>
              </h3>
              <div class="d-flex">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                  <i class="mdi mdi-email btn-icon-prepend"></i> Email </button>
                <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                  <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button>
                <button type="button" class="btn btn-sm ml-3 btn-success"> Add User </button>
              </div>
            </div>

              @isset($data)
                  {{$data}}
              @endisset
              <script src="https://d3js.org/d3.v7.min.js"></script>
              <div id="chart" style="position: relative;"></div>

<script>
    // Convert the Laravel data to JSON format
    var data = @json($data);

    // Set dimensions and margins for the chart
    var width = 350, height = 400, margin = 50;

    // Create an SVG container
    var svg = d3.select("#chart")
                .append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", `translate(${margin}, ${margin})`);

    // Set the scale for the X axis
    var x0 = d3.scaleBand()
               .range([0, width - 2 * margin])
               .domain(data.map(d => d.label))  // Test date
               .padding(0.2);

    // Set the scale for the inner X axis (for grouped bars)
    var x1 = d3.scaleBand()
               .domain(['correct', 'incorrect'])  // Two bars for correct and incorrect
               .range([0, x0.bandwidth()])
               .padding(0.1);

    // Set the scale for the Y axis (max value between correct and incorrect)
    var y = d3.scaleLinear()
              .domain([0, d3.max(data, d => Math.max(d.correct, d.incorrect))])
              .nice()
              .range([height - 2 * margin, 0]);

    // Define gradient colors for the bars
    var colors = {
        correct: "url(#correct-gradient)",  // Use gradient for correct answers
        incorrect: "url(#incorrect-gradient)"  // Use gradient for incorrect answers
    };

    // Define the gradients for correct and incorrect bars
    svg.append("defs")
       .append("linearGradient")
       .attr("id", "correct-gradient")
       .attr("x1", "0%").attr("y1", "0%")
       .attr("x2", "0%").attr("y2", "100%")
       .call(g => {
           g.append("stop").attr("offset", "0%").attr("stop-color", "#4CAF50");  // Green
           g.append("stop").attr("offset", "100%").attr("stop-color", "#3E8E41");  // Darker green
       });

    svg.append("defs")
       .append("linearGradient")
       .attr("id", "incorrect-gradient")
       .attr("x1", "0%").attr("y1", "0%")
       .attr("x2", "0%").attr("y2", "100%")
       .call(g => {
           g.append("stop").attr("offset", "0%").attr("stop-color", "#F44336");  // Red
           g.append("stop").attr("offset", "100%").attr("stop-color", "#D32F2F");  // Darker red
       });

    // Add X axis (dates)
    svg.append("g")
       .attr("transform", `translate(0, ${height - 2 * margin})`)
       .call(d3.axisBottom(x0).tickSizeOuter(0));

    // Add Y axis
    svg.append("g")
       .call(d3.axisLeft(y).ticks(5));

    // Create groups for the bars
    // Create groups for the bars
var bars = svg.selectAll(".bars")
    .data(data)
    .enter()
    .append("g")
    .attr("transform", d => `translate(${x0(d.label)}, 0)`);

// Add correct answer bars
bars.selectAll(".bar.correct")
    .data(d => [{key: 'correct', value: d.correct, url: d.correct_url}]) // Add a `url` property for navigation
    .enter()
    .append("a") // Wrap the bar with <a>
    .attr("xlink:href", d => d.url) // Set the link
    .attr("target", "_blank") // Optional: Open in new tab
    .append("rect")
    .attr("class", "bar correct")
    .attr("x", d => x1(d.key))
    .attr("y", y(0))
    .attr("width", x1.bandwidth())
    .attr("height", 0)
    .attr("fill", colors.correct)
    .attr("rx", 10)
    .attr("ry", 10)
    .on("mouseover", function(event, d) {
        showTooltip(event, `Correct: ${d.value}`);
        d3.select(this).style("opacity", 0.8);
    })
    .on("mouseout", function() {
        hideTooltip();
        d3.select(this).style("opacity", 1);
    })
    .transition()
    .duration(1000)
    .attr("y", d => y(d.value))
    .attr("height", d => height - 2 * margin - y(d.value));

// Add incorrect answer bars
bars.selectAll(".bar.incorrect")
    .data(d => [{key: 'incorrect', value: d.incorrect, url: d.incorrect_url}]) // Add a `url` property for navigation
    .enter()
    .append("a") // Wrap the bar with <a>
    .attr("xlink:href", d => d.url) // Set the link
    .attr("target", "_blank") // Optional: Open in new tab
    .append("rect")
    .attr("class", "bar incorrect")
    .attr("x", d => x1(d.key))
    .attr("y", y(0))
    .attr("width", x1.bandwidth())
    .attr("height", 0)
    .attr("fill", colors.incorrect)
    .attr("rx", 10)
    .attr("ry", 10)
    .on("mouseover", function(event, d) {
        showTooltip(event, `Incorrect: ${d.value}`);
        d3.select(this).style("opacity", 0.8);
    })
    .on("mouseout", function() {
        hideTooltip();
        d3.select(this).style("opacity", 1);
    })
    .transition()
    .duration(1000)
    .attr("y", d => y(d.value))
    .attr("height", d => height - 2 * margin - y(d.value));

    // Add a title
    svg.append("text")
       .attr("x", (width - 2 * margin) / 2)
       .attr("y", -20)
       .attr("text-anchor", "middle")
       .attr("font-size", "18px")
       .attr("font-weight", "bold")
       .text("Player Performance: Correct vs. Incorrect");

    // Tooltip functionality
    var tooltip = d3.select("#chart")
                    .append("div")
                    .style("position", "absolute")
                    .style("background", "#fff")
                    .style("border", "1px solid #ccc")
                    .style("padding", "5px 10px")
                    .style("border-radius", "5px")
                    .style("box-shadow", "0 0 5px rgba(0,0,0,0.2)")
                    .style("opacity", 0);

    function showTooltip(event, text) {
        tooltip.style("opacity", 1)
               .html(text)
               .style("left", (event.pageX + 10) + "px")
               .style("top", (event.pageY - 28) + "px");
    }

    function hideTooltip() {
        tooltip.style("opacity", 0);
    }
</script>


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
    <script src={{asset("dashboardAssets/assets/vendors/chart.js/Chart.min.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.resize.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.categories.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.fillbetween.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.stack.js")}}></script>
    <script src={{asset("dashboardAssets/assets/vendors/flot/jquery.flot.pie.js")}}></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src={{asset("dashboardAssets/assets/js/off-canvas.js")}}></script>
    <script src="dashboardAssets/assets/js/hoverable-collapse.js"></script>
    <script src={{asset("dashboardAssets/assets/js/misc.js")}}></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src={{asset("dashboardAssets/assets/js/dashboard.js")}}></script>
    <!-- End custom js for this page -->
  </body>
</html>

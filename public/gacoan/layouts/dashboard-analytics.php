<?php
include 'layouts/session.php';

if (!isset($_SESSION["username"])) {
	header('Location:error-500.php');
	exit;
}

$id_user=$_SESSION["id_user"];
$username=$_SESSION["username"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];



?>
<?php include 'layouts/main.php'; ?>

<head>
    <title>ESS | Employee Self Service</title>
    <?php include 'layouts/title-meta.php'; ?>

    <!-- Plugin css -->
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

    <?php include 'layouts/menu.php';?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <form class="d-flex">
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow border-0" id="dash-daterange">
                                            <span class="input-group-text bg-success border-success text-white">
                                                <i class="ri-calendar-todo-fill fs-13"></i>
                                            </span>
                                        </div>
                                        <a href="javascript: void(0);" class="btn btn-success ms-2 flex-shrink-0">
                                            <i class="ri-refresh-line"></i> Refresh
                                        </a>
                                    </form>
                                </div>
                                <h4 class="page-title">Analytics</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card cta-box overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h3 class="mt-0 fw-normal cta-box-title mb-3">Enhance your <b>Campaign</b> for better outreach</h3>
                                            <a href="#" class="link-success link-offset-3 fw-bold">Go Premium <i class="ri-arrow-right-line"></i></a>
                                        </div>
                                        <img class="ms-3" src="assets/images/svg/email-campaign.svg" width="92" alt="Generic placeholder image">
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="text-uppercase fs-13 mt-0 text-truncate" title="Active Users">Active Users</h5>
                                            <h2 class="my-2 py-1" id="active-users-count">825</h2>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="text-success me-2"><i class="ri-arrow-up-line"></i> 3.27%</span>
                                                <span class="text-nowrap">Since previous week</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <div id="campaign-sent-chart" data-colors="#16a7e9"></div>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="text-uppercase fs-13 mt-0 text-truncate" title="Views per minute">Views per minute</h5>
                                            <h2 class="my-2 py-1" id="active-views-count">589</h2>
                                            <p class="mb-0 text-muted text-truncate">
                                                <span class="text-danger me-2"><i class="ri-arrow-down-line"></i> 2.66%</span>
                                                <span class="text-nowrap">Since previous week</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <div id="new-leads-chart" data-colors="#47ad77"></div>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div> <!-- end card-body -->
                            </div> <!-- end card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Sessions by Browser</h4>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div id="sessions-browser" class="apex-charts" data-colors="#16a7e9"></div>

                                    <div class="mt-1 text-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><img class="ms-3 pe-1" src="assets/images/browsers/chrome.png" height="18" alt="chrome"><span class="align-middle">45.87%</span></li>
                                            <li class="list-inline-item"><img class="ms-3 pe-1" src="assets/images/browsers/firefox.png" height="18" alt="chrome"><span class="align-middle">3.25%</span></li>
                                            <li class="list-inline-item"><img class="ms-3 pe-1" src="assets/images/browsers/safari.png" height="18" alt="chrome"><span class="align-middle">9.68%</span></li>
                                            <li class="list-inline-item"><img class="ms-3 pe-1" src="assets/images/browsers/web.png" height="18" alt="chrome"><span class="align-middle">36.87%</span></li>
                                        </ul>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Sessions by Operating System</h4>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div id="sessions-os" class="apex-charts mt-2" data-colors="#16a7e9,#47ad77,#ffc35a,#f15776"></div>

                                    <div class="row text-center mt-2">
                                        <div class="col-6">
                                            <h4 class="fw-normal">
                                                <span>8,285</span>
                                            </h4>
                                            <p class="text-muted mb-0">Online System</p>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="fw-normal">
                                                <span>3,534</span>
                                            </h4>
                                            <p class="text-muted mb-0">Offline System</p>
                                        </div>
                                    </div>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Views Per Minute</h4>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div id="views-min" class="apex-charts" data-colors="#16a7e9"></div>

                                    <div class="table-responsive mt-3">
                                        <table class="table table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Page</th>
                                                    <th>Views</th>
                                                    <th>Bounce Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">/adminto/dashboard-analytics</a>
                                                    </td>
                                                    <td>25</td>
                                                    <td>87.5%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">/attex/dashboard-crm</a>
                                                    </td>
                                                    <td>15</td>
                                                    <td>21.48%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">/ubold/dashboard</a>
                                                    </td>
                                                    <td>10</td>
                                                    <td>63.59%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                    </div>


                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Sessions by country</h4>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Refresh Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div id="world-map-markers" class="mt-3 mb-3" style="height: 332px">
                                            </div>
                                        </div>
                                        <div class="col-lg-5" dir="ltr">
                                            <div id="country-chart" class="apex-charts" data-colors="#16a7e9"></div>
                                        </div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-xxl-6">
                            <div class="card card-h-100">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Sessions Overview</h4>
                                    <ul class="nav d-none d-lg-flex">
                                        <li class="nav-item">
                                            <a class="nav-link text-muted" href="#">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-muted" href="#">7d</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">15d</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-muted" href="#">1m</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-muted" href="#">1y</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bg-light-subtle border-top border-bottom border-light">
                                        <div class="row text-center">
                                            <div class="col">
                                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Direct</p>
                                                <h3 class="fw-normal mb-3">
                                                    <span>170k</span>
                                                </h3>
                                            </div>
                                            <div class="col">
                                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Organic Search</p>
                                                <h3 class="fw-normal mb-3">
                                                    <span>12M <i class="ri-corner-right-up-fill text-success"></i></span>
                                                </h3>
                                            </div>
                                            <div class="col">
                                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Refferal</p>
                                                <h3 class="fw-normal mb-3">
                                                    <span>8.27%</span>
                                                </h3>
                                            </div>
                                            <div class="col">
                                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Social</p>
                                                <h3 class="fw-normal mb-3">
                                                    <span>69k <i class="ri-corner-right-down-line text-danger"></i></span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div dir="ltr">
                                        <div id="sessions-overview" class="apex-charts" data-colors="#47ad77"></div>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Channels</h4>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i class="ri-download-line ms-1"></i></a>
                                </div>

                                <div class="card-body p-0">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>Channel</th>
                                                    <th>Visits</th>
                                                    <th style="width: 40%;">Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Direct</td>
                                                    <td>2,050</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Organic Search</td>
                                                    <td>1,405</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Refferal</td>
                                                    <td>750</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Social</td>
                                                    <td>540</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Other</td>
                                                    <td>8,965</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Social Media Traffic</h4>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i class="ri-download-line ms-1"></i></a>
                                </div>

                                <div class="card-body p-0">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>Network</th>
                                                    <th>Visits</th>
                                                    <th style="width: 40%;">Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Facebook</td>
                                                    <td>2,250</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Instagram</td>
                                                    <td>1,501</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Twitter</td>
                                                    <td>750</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>LinkedIn</td>
                                                    <td>540</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Other</td>
                                                    <td>13,851</td>
                                                    <td>
                                                        <div class="progress" style="height: 3px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Engagement Overview</h4>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i class="ri-download-line ms-1"></i></a>
                                </div>

                                <div class="card-body p-0">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered table-hover table-borderless mb-0">
                                            <thead class="border-top border-bottom bg-light-subtle border-light">
                                                <tr>
                                                    <th>Duration (Secs)</th>
                                                    <th style="width: 30%;">Sessions</th>
                                                    <th style="width: 30%;">Views</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>0-30</td>
                                                    <td>2,250</td>
                                                    <td>4,250</td>
                                                </tr>
                                                <tr>
                                                    <td>31-60</td>
                                                    <td>1,501</td>
                                                    <td>2,050</td>
                                                </tr>
                                                <tr>
                                                    <td>61-120</td>
                                                    <td>750</td>
                                                    <td>1,600</td>
                                                </tr>
                                                <tr>
                                                    <td>121-240</td>
                                                    <td>540</td>
                                                    <td>1,040</td>
                                                </tr>
                                                <tr>
                                                    <td>141-420</td>
                                                    <td>56</td>
                                                    <td>886</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                    </div>
                    <!-- end row -->

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <?php include 'layouts/footer.php'; ?>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <?php include 'layouts/right-sidebar.php'; ?>

    <?php include 'layouts/footer-scripts.php'; ?>

    <!-- Daterangepicker js -->
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- Charts js -->
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

    <!-- Vector Map js -->
    <script src="assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Analytics Dashboard App js -->
    <script src="assets/js/pages/demo.dashboard-analytics.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
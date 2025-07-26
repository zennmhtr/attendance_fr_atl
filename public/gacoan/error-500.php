<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
    <head>
        <title>ESS | Employee Self Service</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
    </head>

    <body class="authentication-bg">

    <?php include 'layouts/background.php'; ?>

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <!-- Logo -->
                            <div class="card-header py-4 text-center bg-primary">
                                <a href="index.php">
                                    <span><img src="assets/images/logo.png" alt="logo" height="55"></span>
                                </a>
                            </div>
                            
                            <div class="card-body p-4">

                                <div class="text-center">
                                    <img src="assets/images/svg/startman.svg" height="120" alt="File not found Image">

                                    <h1 class="text-error mt-4">404</h1>
                                    <h4 class="text-uppercase text-danger mt-3">Silahkan Anda Login Terlebih Dahulu</h4>
                                    <p class="text-muted mt-3">Jika anda belum terdaftar silahkan menghubungi tim IT dengan menggunkan<a href="" class="text-muted"><b>E-tiket</b></a></p>

                                    <a class="btn btn-info mt-3" href="index.php"><i class="ri-home-4-line me-1"></i>Kembali Ke Awal</a>
                                </div>

                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card-->
                        
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt fw-medium">
			<span class="bg-body"><script>document.write(new Date().getFullYear())</script> © Pesta Pora Abadi - miegacoan.co.id</span>
        </footer>
        <?php include 'layouts/footer-scripts.php'; ?>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>
</html>

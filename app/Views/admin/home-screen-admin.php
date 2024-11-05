<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="multikit" />
    <meta name="keywords" content="multikit" />
    <title>Bakul Sehat ULM</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon/logo.jpg" />
    <link rel="manifest" href="https://themes.pixelstrap.net/multikit/manifest.json" />
    <meta name="theme-color" content="#ff8d2f" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="multikit" />
    <meta name="msapplication-TileImage" content="https://themes.pixelstrap.net/multikit/assets/images/favicon/1.svg" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/bootstrap.css" />

    <!-- Swiper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/swiper/swiper-bundle.min.css" />

    <!-- Remix Icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/remixicon.css" />

    <!-- Style css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css" />

    <!-- Style video -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/video.css" />
</head>

<body class="inter-body learning-color">
    <main class="position-relative">
        <!-- header start -->
        <header class="main-header learning-header">
            <div class="custom-container">
                <div class="top-header">
                    <div class="header-left">
                        <a class="text-white" data-bs-toggle="offcanvas" href="#sideMenu" role="button">
                            <i class="ri-menu-2-fill"></i>
                        </a>
                        <!-- <a href="index-2.html" class="header-logo">
                            <img src="https://themes.pixelstrap.net/multikit/assets/images/logo/1.svg" class="img-fluid" alt="">
                        </a> -->
                    </div>


                </div>

                <div class="header-bottom pb-3">
                    <div class="customer-name">
                        <h2>Halo Admin</h2>
                        <img src="<?= base_url() ?>assets/images/learning/hand.png" alt="" />
                    </div>
                    <h5>Belajar dari Pendidik terbaik!!</h5>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- Mobile Section Start -->
        <div class="mobile-style-1">
            <ul>
                <li class="active">
                    <a href="<?= site_url('admin/dashboard') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-home-5-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Beranda</h5>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('admin/users') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-group-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Pengguna</h5>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('admin/content') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-mac-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Konten</h5>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Mobile Section End -->

        <section class="section-t-space feature-course-section">
            <div class="custom-container">
                <div class="title">
                    <h4>Total Pengguna</h4>
                </div>
                <ul class="feature-course-list">
                    <li>
                        <div class="feature-box bg-web-primary">
                            <h3 class="text-center text-white">Pasien</h3>
                            <h4 class="text-center text-white" id="patientCount">
                                <?= $n_pasien; ?>
                            </h4>
                        </div>
                    </li>
                    <li>
                        <div class="feature-box bg-web-primary">
                            <h3 class="text-center text-white">Tenaga Kesehatan</h3>
                            <h4 class="text-center text-white" id="doctorCount">
                                <?= $n_dokter ?>
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Features Course Section Start -->
        <section class="section-t-space feature-course-section">
            <div class="custom-container">
                <div class="title">
                    <h4>Statistik Pengguna</h4>
                </div>
                <div class="chart-container">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </section>
        <!-- Features Course Section End -->

        <section class="section-t-space feature-course-section">
            <input type="hidden" name="n-done" id="n-done" value="<?= $n_course_done ?>">
            <div class="custom-container">
                <div class="title mb-0">
                    <h4>Statistik Kursus</h4>
                </div>
                <div class="chart-container p-3 pt-0">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </section>

        <!-- space box start -->
        <div class="learning-box"></div>
        <!-- space box end -->

        <!-- Side menu offcanvas start -->
        <div class="offcanvas theme-offcanvas learning-offcanvas offcanvas-start" tabindex="-1" id="sideMenu">
            <div class="offcanvas-header">
                <div class="profile-box">
                    <div class="profile-image">
                        <img src="<?= base_url() ?>assets/images/learning/menu-profile.jpg" class="img-fluid" alt="" />
                    </div>
                    <div class="profile-name">
                        <h4 class="text-white">Admin</h4>
                        <h6 class="content-color">appfarmasi@gmail.com</h6>
                    </div>
                </div>
            </div>
            <div class="offcanvas-body">
                <ul class="menu-setting-list">
                    <li>
                        <a href="<?= site_url('admin/logout') ?>" class="menu-setting-box">
                            <div class="setting-icon">
                                <i class="ri-information-line"></i>
                            </div>
                            <div class="setting-name">
                                <h4>Keluar</h4>
                                <i class="ri-arrow-right-s-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Side menu offcanvas end -->
    </main>

    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>

    <!-- Chart js -->
    <script src="<?= base_url() ?>assets/js/chart.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="multikit" />
    <meta name="keywords" content="multikit" />
    <title>Projek Farmasi</title>
    <link rel="manifest" href="https://themes.pixelstrap.net/multikit/manifest.json" />
    <meta name="theme-color" content="#ff8d2f" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="multikit" />
    <meta name="msapplication-TileImage" content="https://themes.pixelstrap.net/multikit/assets/images/favicon/1.svg" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/x-icon" href="https://themes.pixelstrap.net/multikit/assets/images/favicon/9.svg" />
    <link rel="shortcut icon" href="https://themes.pixelstrap.net/" type="image/x-icon" />

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

                    <div class="header-right">
                        <div class="notification-box">
                            <a class="text-white" href="<?=site_url('pasien/list_chat') ?>">
                                <i class="ri-chat-4-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="header-bottom">
                    <div class="customer-name">
                        <h2>Halo <?= $nama ?></h2>
                        <img src="<?= base_url() ?>assets/images/learning/hand.png" alt="" />
                    </div>
                    <h5>Belajar dari Pendidik terbaik!!</h5>
                </div>

                <div class="search-box index-search">
                    <div class="position-relative">
                        <input type="search" class="form-control" placeholder="Cari" />
                        <i class="ri-search-line"></i>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->

        <!-- Mobile Section Start -->
        <div class="mobile-style-1">
            <ul>
                <li class="active">
                    <a href="<?= site_url('pasien') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-home-5-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Beranda</h5>
                        </div>
                    </a>
                </li>


                <li>
                    <a href="<?= site_url('pasien/consultation') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-contacts-book-2-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Konsultasi</h5>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('pasien/akun') ?>" class="mobile-box">
                        <div class="mobile-icon">
                            <i class="ri-user-3-line"></i>
                        </div>
                        <div class="mobile-name">
                            <h5>Akun</h5>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Mobile Section End -->

        <!-- Progress start -->
        <section class="section-t-space poster-section">
            <div class="custom-container">
                <div class="title">
                    <h4>Kemajuan Anda</h4>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-11">
                        <div class="poster-box">
                            <img src="<?= base_url() ?>assets/images/learning/poster/1.png" class="img-fluid w-100"
                                alt="" />
                            <div class="poster-detail p-center">
                                <div>
                                    <h3 class="text-white">
                                        Selesaikan video untuk melakukan post-test
                                    </h3>
                                    <button class="btn btn-sm btn-white" id="btnPost">
                                        Post-Test
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="progressContainer">
                    <div id="progressBar" class="mb-1">
                        <div id="progressFill"></div>
                    </div>
                    <div id="progressPercentage">0% Selesai</div>
                </div>
            </div>
        </section>
        <!-- Progress end -->

        <!-- Features Course Section Start -->
        <section class="section-t-space feature-course-section">
            <div class="custom-container">
                <div class="title">
                    <h4>Kursus Unggulan</h4>
                </div>
                <div id="videoList"></div>
            </div>
        </section>
        <!-- Features Course Section End -->



        <!-- space box start -->
        <div class="learning-box"></div>
        <!-- space box end -->

        <!-- Side menu offcanvas start -->
        <div class="offcanvas theme-offcanvas learning-offcanvas offcanvas-start" tabindex="-1" id="sideMenu">
            <div class="offcanvas-header">
                <div class="profile-box">
                    <div class="profile-image">
                        <img src="<?= base_url() . $foto ?>" class="img-fluid" alt="" />
                    </div>
                    <div class="profile-name">
                        <h4 class="text-white"><?= $nama ?></h4>
                        <h6 class="content-color"><?= $email ?></h6>
                    </div>
                </div>
            </div>
            <div class="offcanvas-body">
                <div class="title px-15">
                    <h4>Pengaturan Akun</h4>
                </div>
                <ul class="menu-setting-list">
                    <li>
                        <a href="<?= site_url('pasien/setperson') ?>" class="menu-setting-box">
                            <div class="setting-icon">
                                <i class="ri-user-3-line"></i>
                            </div>
                            <div class="setting-name">
                                <h4>Pengaturan Pribadi</h4>
                                <i class="ri-arrow-right-s-line"></i>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="<?= site_url('pasien/set_akun') ?>" class="menu-setting-box">
                            <div class="setting-icon">
                                <i class="ri-lock-line"></i>
                            </div>
                            <div class="setting-name">
                                <h4>Keamanan Akun</h4>
                                <i class="ri-arrow-right-s-line"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('login/logout') ?>" class="menu-setting-box">
                            <div class="setting-icon">
                                <i class="ri-information-line"></i>
                            </div>
                            <div class="setting-name">
                                <h4>Keluar</h4>
                                <i class="ri-arrow-right-s-line"></i>
                            </div>
                        </a>
                    </li>
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
    <script>
        const videoData = <?= !empty($courses) ? json_encode($courses) : '[]' ?>;
    </script>

    <!-- Video js -->
    <script src="<?= base_url() ?>assets/js/video.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
</body>

</html>
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
</head>

<body class="inter-body learning-color">
    <!-- header start -->
    <header class="main-header learning-header h-102">
        <div class="custom-container">
            <div class="top-header">
                <div class="header-left">
                    <a class="text-white" href="javascript:history.back()">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                </div>
            </div>

            <div class="header-bottom header-bottom-2">
                <h2 class="fw-500 text-white">Pengguna</h2>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Mobile Section Start -->
    <div class="mobile-style-1">
        <ul>
            <li>
                <a href="<?= site_url('admin/dashboard') ?>" class="mobile-box">
                    <div class="mobile-icon">
                        <i class="ri-home-5-line"></i>
                    </div>
                    <div class="mobile-name">
                        <h5>Beranda</h5>
                    </div>
                </a>
            </li>

            <li class="active">
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

    <!-- Setting Section Start -->
    <div class="setting-style-1 pt-25">
        <div class="custom-container">
            <div class="title">
                <h4>Pilih Pengguna</h4>
            </div>
            <ul class="menu-setting-list px-0">
                <li>
                    <a href="<?= site_url('admin/dokter_screen') ?>" class="menu-setting-box">
                        <div class="setting-icon">
                            <i class="ri-nurse-fill"></i>
                        </div>
                        <div class="setting-name">
                            <h4>Tenaga Kesehatan</h4>
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="<?= site_url('admin/pasien_screen') ?>" class="menu-setting-box">
                        <div class="setting-icon">
                            <i class="ri-user-5-line"></i>
                        </div>
                        <div class="setting-name">
                            <h4>Pasien</h4>
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Setting Section End -->

    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>
</body>

</html>
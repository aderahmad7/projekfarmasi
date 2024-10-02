<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="multikit" />
    <meta name="keywords" content="multikit" />
    <title>Multikit - Multi-purpose Html Template</title>
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
                    <a class="text-white" href="<?= site_url('dokter') ?>">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                </div>

                <div class="header-right">
                    <div class="notification-box">
                        <a class="text-white" href="<?=site_url('dokter/list_chat') ?>">
                            <i class="ri-chat-4-line"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="header-bottom header-bottom-2">
                <h2 class="fw-500 text-white">Consultation</h2>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Mobile Section Start -->
    <div class="mobile-style-1">
        <ul>
            <li>
                <a href="<?= site_url('dokter') ?>" class="mobile-box">
                    <div class="mobile-icon">
                        <i class="ri-home-5-line"></i>
                    </div>
                    <div class="mobile-name">
                        <h5>Home</h5>
                    </div>
                </a>
            </li>


            <li class="active">
                <a href="<?= site_url('dokter/consultation') ?>" class="mobile-box">
                    <div class="mobile-icon">
                        <i class="ri-contacts-book-2-line"></i>
                    </div>
                    <div class="mobile-name">
                        <h5>Consultation</h5>
                    </div>
                </a>
            </li>

            <li>
                <a href="<?= site_url('dokter/akun') ?>" class="mobile-box">
                    <div class="mobile-icon">
                        <i class="ri-user-3-line"></i>
                    </div>
                    <div class="mobile-name">
                        <h5>Account</h5>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- Mobile Section End -->

    <section
        class="section-t-space feature-course-section d-flex align-items-center justify-content-center text-black-50">
        <h2>Features under development</h1>
    </section>

    <!-- space box start -->
    <div class="learning-box"></div>
    <!-- space box end -->

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
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

    <!-- Custom css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom.css" />
</head>

<body class="inter-body learning-color">
    <!-- header start -->
    <header class="main-header learning-header h-102">
        <div class="custom-container">
            <div class="top-header">
                <div class="header-left">
                    <a class="text-white" href="<?= site_url('pasien') ?>">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                </div>

                <div class="header-right">
                    <div class="notification-box">
                        <a class="text-white" href="<?=site_url('pasien/list_chat') ?>">
                            <i class="ri-chat-4-line"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="header-bottom header-bottom-2">
                <h2 class="fw-500 text-white">Konsultasi</h2>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Mobile Section Start -->
    <div class="mobile-style-1">
        <ul>
            <li>
                <a href="<?= site_url('pasien') ?>" class="mobile-box">
                    <div class="mobile-icon">
                        <i class="ri-home-5-line"></i>
                    </div>
                    <div class="mobile-name">
                        <h5>Beranda</h5>
                    </div>
                </a>
            </li>

            <li class="active">
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



    <section
        class="section-consultation feature-course-section flex-column d-flex justify-content-center text-black-50 m-3 mb-0">
        <div class="consultation-title">
            <h3 class="fw-bold mb-1">Rekomendasi tenaga kesehatan</h3>
            <p class="fw-500">Konsultasi online dengan tenaga kesehatan siaga kami</p>
        </div>
        <div class="mb-3">
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
            <div class="doctor-card card h-100 d-flex flex-row gap-3 border-top-0 border-start-0 border-end-0 p-3"
                style="cursor: pointer;">
                <div class="doctor-img-container">
                    <img src="<?= base_url($foto) ?>" class="img-fluid doctor-img" alt="" width="100" />
                </div>
                <div class="doctor-detail-container d-flex flex-column justify-content-between">
                    <div class="doctor-detail-content d-flex flex-column gap-2">
                        <h5 class="fw-bold">Dr. Henry Manik</h5>
                        <h6 class="fw-500 mb-1">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <a href="<?= site_url('pasien/chat') ?>"
                        class="doctor-chat-btn btn-gradient w-100 mb-1 p-2 text-center">Chat</a>
                </div>
            </div>
        </div>
        <div id="pagination" class="pagination mb-0"></div>
    </section>

    <!-- doctor info Modal -->
    <div class="modal fade" id="doctorInfoModal" tabindex="-1" aria-labelledby="doctorInfoLabel" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center h-75">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctorInfoLabel">Informasi Tenaga Kesehatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="card p-2 border-top-0 border-start-0 border-end-0">
                        <div class="doctor-img-container d-flex justify-content-center">
                            <img src="<?= base_url($foto) ?>" class="img-fluid doctor-info-img" alt="" width="100" />
                        </div>
                    </div>
                    <div class="card p-2 border-start-0 border-end-0 border-top-0">
                        <h4 class="fw-bold mb-1">Dr. Henry Manik</h4>
                        <h6 class="fw-500 mb-2">Dokter Umum</h6>
                        <div class="experience-container d-flex align-items-center gap-1 justify-content-center w-75">
                            <i class="ri-briefcase-fill"></i>
                            <p class="mb-0">15 Tahun</p>
                        </div>
                    </div>
                    <div class="card border-0 pt-2">
                        <a href="<?= site_url('pasien/chat') ?>" class="btn-gradient modal-btn p-2 w-100 text-center">Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Consultation js-->
    <script src="<?= base_url() ?>assets/js/consultation.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>
</body>

</html>
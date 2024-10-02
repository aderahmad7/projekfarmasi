<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="multikit">
    <meta name="keywords" content="multikit">
    <title>Projek Farmasi</title>
    <link rel="manifest" href="https://themes.pixelstrap.net/multikit/manifest.json">
    <meta name="theme-color" content="#ff8d2f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="multikit">
    <meta name="msapplication-TileImage" content="https://themes.pixelstrap.net/multikit/assets/images/favicon/1.svg">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="https://themes.pixelstrap.net/multikit/assets/images/favicon/9.svg">
    <link rel="shortcut icon" href="https://themes.pixelstrap.net/" type="image/x-icon">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/bootstrap.css">

    <!-- Swiper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/swiper/swiper-bundle.min.css">

    <!-- Remix Icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/remixicon.css">

    <!-- Style css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
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
                        <a class="text-white" href="#">
                            <i class="ri-chat-4-line"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="header-bottom header-bottom-2">
                <h2 class="fw-500 text-white">Keamanan Akun</h2>
            </div>
        </div>
    </header>
    <!-- header end -->
    <!-- Menampilkan pesan kesalahan -->
    <?php if (session()->has('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Menampilkan pesan error atau sukses -->
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session('error')) ?>
        </div>
    <?php endif; ?>

    <!-- Menampilkan pesan sukses -->
    <?php if (session()->has('success')): ?>
        <script>
            alert("<?= esc(session('success')) ?>");
        </script>
    <?php endif; ?>

    <!-- Account Security Section Start -->
    <section class="section-t-space account-security-section">
        <div class="custom-container">
            <form class="account-email-box form-style-1">
                <div class="learning-theme-form">
                    <label for="email" class="form-label">Email :</label>
                    <div class="email-box with-icon">
                        <input type="email" class="form-control" placeholder="Enter Your Email Address"
                            value="<?= $email ?>" id="email" readonly>
                        <!-- <button class="btn email-button" data-bs-toggle="offcanvas" type="button"
                            data-bs-target="#changeEmail">
                            <i class="ri-pencil-fill"></i>
                        </button> -->
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Account Security Section End -->

    <!-- Change email address offcanvas start -->
    <div class="offcanvas apply-coupon-offcanvas theme-bottom-offcanvas offcanvas-bottom" tabindex="-1"
        id="changeEmail">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Change your email</h5>
        </div>
        <div class="offcanvas-body">
            <form class="form-style-1">
                <div class="learning-theme-form mb-3">
                    <label for="email1" class="form-label">Email Anda</label>
                    <input type="email" class="form-control" value="testing@gmail.com"
                        placeholder="Your email address is testing@gmail.com" id="email1">
                </div>

                <div class="learning-theme-form mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Your Password" id="pass">
                </div>
            </form>
            <p class="content-modal-name">For your security, if you change your email address your saved credit
                card information will be deleted.</p>
            <button class="btn btn-theme text-white" data-bs-dismiss="modal">Save</button>
        </div>
    </div>
    <!-- Change email address offcanvas end -->

    <!-- Divider Setting Start -->
    <section class="section-t-space section-b-space">
        <div class="divider"></div>
    </section>
    <!-- Divider Setting End -->

    <!-- change password section start -->
    <section class="change-password-section">
        <div class="custom-container">
            <form method="post" action="<?= site_url('pasien/ubah_sandi') ?>" class="form-style-1">
                <div class="mb-3">
                    <label for="email" class="form-label">Kata Sandi :</label>
                    <input type="password" class="form-control mb-3" name="curr-pass" placeholder="Kata Sandi Saat Ini"
                        id="pass1">
                    <input type="password" class="form-control mb-3" name="new-pass" placeholder="Kata Sandi Baru"
                        id="pass2">
                    <input type="password" class="form-control mb-3" name="re-new-pass"
                        placeholder="Ketik Ulang Kata Sandi Baru" id="pass3">

                    <input type="submit" class="btn btn-gradient mt-2" value="Kirim">
                </div>
            </form>
        </div>
    </section>
    <!-- change password section end -->

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
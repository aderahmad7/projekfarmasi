<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bakul Sehat ULM</title>
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon/logo.jpg" />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/slick.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styleSecond.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/media-query.css" />
</head>

<body>
    <div class="site-content">
        <!-- Header start -->
        <header id="top-header">
            <div class="container">
                <div class="top-header-full">
                    <div class="back-btn">
                        <a href="<?= site_url('login') ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_330_7385" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="24" height="24">
                                    <rect width="24" height="24" fill="black" />
                                </mask>
                                <g mask="url(#mask0_330_7385)">
                                    <path d="M15 18L9 12L15 6" stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="header-title">
                        <p>Lupa Kata Sandi</p>
                    </div>
                </div>
            </div>
            <div class="navbar-boder"></div>
        </header>
        <!-- Header end -->
        <!-- Forget password screen start -->
        <section id="forget-password-screen-content">
            <div class="container">
                <h1 class="d-none">Forget Password</h1>
                <h2 class="d-none">Hidden</h2>
                <div class="forget-password-screen-wrap">
                    <div class="forget-password-screen-top mt-32">
                        <p class="title-sec">
                            Masukkan alamat email akun Anda dan kami akan mengirimkan email berisi petunjuk untuk
                            mengatur ulang kata sandi Anda.
                        </p>
                    </div>
                    <!-- Menampilkan pesan error -->
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= esc(session('error')) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Menampilkan pesan sukses -->
                    <?php if (session()->has('success')): ?>
                        <div class="alert alert-success">
                            <p><?= esc(session('success')) ?></p>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('resetsandi/sendemail') ?>"
                        class="forget-password-screen-form mt-32">
                        <div class="form-details-sign-in">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_330_7186" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_330_7186)">
                                        <path
                                            d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M3 7L12 13L21 7" stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </span>
                            <input type="email" name="email" id="Email" placeholder="Email"
                                class="sign-in-custom-input" />
                        </div>
                        <div class="send-instruction-btn mt-32">
                            <input type="submit" name="submit" value="Kirim">
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Forget password screen end -->
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Projek Farmasi</title>
    <link rel="icon" href="assets/images/favicon/icon.png" />
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
    <div class="site-content mt-5 p-2">
        <!-- Sign in screen start -->
        <section id="sign-in-screen-content" class="d-flex flex-column gap-4">
            <div class="container">
                <div class="sign-in-login">
                    <h1 class="login-txt">Masuk ke Akun Anda</h1>
                </div>
                <!-- Menampilkan pesan error -->
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
                <div class="sign-in-login-form mt-24">
                    <form method="post" action="<?= site_url('login/validasi') ?>">
                        <div class="form-details-sign-in">
                            <span>
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_330_7186" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_330_7186)">
                                        <path
                                            d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </span>
                            <input type="text" id="Username" name="username" placeholder="Nama Pengguna"
                                class="sign-in-custom-input" />
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_330_7136" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_330_7136)">
                                        <path
                                            d="M17 11H7C5.89543 11 5 11.8954 5 13V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V13C19 11.8954 18.1046 11 17 11Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8 11V7C8 5.93913 8.42143 4.92172 9.17157 4.17157C9.92172 3.42143 10.9391 3 12 3C13.0609 3 14.0783 3.42143 14.8284 4.17157C15.5786 4.92172 16 5.93913 16 7V11"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" placeholder="Kata Sandi"
                                class="sign-in-custom-input" />
                            <i class="fas fa-eye-slash" id="eye"></i>
                        </div>
                        <div class="remember-section">
                            <div class="footer-checkbox-sec">
                                <input class="footer-checkbox-input" name="remember-me" id="footer-checkbox"
                                    type="checkbox" />
                                <label for="footer-checkbox" class="footer-chec-txt">Ingat Saya</label>
                            </div>
                            <div class="forget-btn">
                                <a href="<?= base_url('login/lupa_password') ?>">Lupa Kata Sandi?</a>
                            </div>
                        </div>
                        <div class="sign-in-btn mt-32">
                            <input type="submit" name="submit" value="Masuk">
                        </div>
                    </form>
                </div>
            </div>
            <div class="block-footer">
                <p>
                    Tidak punya akun?
                    <a href="<?= base_url('register') ?>">Daftar</a>
                </p>
            </div>
        </section>
        <!-- Sign in screen end -->
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>
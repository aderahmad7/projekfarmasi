<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Guruji - Online Learning & Educational Courses</title>

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
                    <div class="header-title">
                        <p>Reset Password</p>
                    </div>
                </div>
            </div>
            <div class="navbar-boder"></div>
        </header>
        <!-- Header end -->
        <!-- Reset password screen start -->
        <section id="reset-password-screen-content">
            <div class="container">
                <h1 class="d-none">Reset Passwork</h1>
                <h2 class="d-none">Hidden</h2>
                <div class="forget-password-screen-wrap">
                    <div class="forget-password-screen-top mt-32">
                        <p class="title-sec">
                            Enter new password and confirm.
                        </p>
                    </div>


                    <!-- Menampilkan pesan error -->
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session('error') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Menampilkan pesan sukses -->
                    <?php if (session()->has('success')): ?>
                        <div class="alert alert-success">
                            <?php foreach (session('success') as $success): ?>
                                <p><?= esc($success) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= site_url('resetsandi/ubah/' . $reset_token) ?>"
                        class="forget-password-screen-form mt-32">
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                        height="24">
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
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="sign-in-custom-input" />
                            <i class="fas fa-eye-slash" id="eye"></i>
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                        height="24">
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
                            <input type="password" name="re-password" id="confirm-password"
                                placeholder="Confirm Password" class="sign-in-custom-input" />
                            <i class="fas fa-eye-slash" id="eye1"></i>
                        </div>
                        <div class="send-instruction-btn mt-32">
                            <input type="submit" name="submit" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Reset password screen end -->
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>
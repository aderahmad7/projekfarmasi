<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bakul Sehat ULM</title>
    <link rel="icon" href="assets/images/favicon/logo.jpg" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        #pass-require {
            color: black;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="site-content p-2 pt-0 mb-4">
        <!-- Sign in screen start -->
        <section id="sign-in-screen-content" class="d-flex flex-column gap-4">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-content-start">
                    <img src="<?= base_url() ?>assets/images/favicon/logo-bakul-sehat.png" alt="" width="250px">
                    <h1 class="login-txt">Buat Akun Anda</h1>
                </div>
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

                <div class="sign-in-login-form mt-24">
                    <form method="post" action="<?= site_url('register/daftar_pasien') ?>">
                        <div class="form-details-sign-in">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </span>
                            <input type="text" name="name" id="name" placeholder="Nama" class="sign-in-custom-input" />
                        </div>
                        <div class="sign-in-login-form mt-12 position-relative">
                            <span class="position-absolute top-50 translate-middle-y ps-sm-2 ms-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="black">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="black" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M15.0491 8.53666L18.5858 5H14V3H22V11H20V6.41421L16.4633 9.95088C17.4274 11.2127 18 12.7895 18 14.5C18 18.6421 14.6421 22 10.5 22C6.35786 22 3 18.6421 3 14.5C3 10.3579 6.35786 7 10.5 7C12.2105 7 13.7873 7.57264 15.0491 8.53666ZM10.5 20C13.5376 20 16 17.5376 16 14.5C16 11.4624 13.5376 9 10.5 9C7.46243 9 5 11.4624 5 14.5C5 17.5376 7.46243 20 10.5 20Z"
                                            stroke="black" stroke-width="0" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </g>
                                </svg>
                            </span>
                            <select name="gender"
                                class="form-details-sign-in w-100 ps-5 border-top-0 border-start-0 border-end-0">
                                <option disabled selected>Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="5" width="18" height="16" rx="2" stroke="black" stroke-width="2" />
                                    <line x1="3" y1="9" x2="21" y2="9" stroke="black" stroke-width="2" />
                                    <line x1="7" y1="3" x2="7" y2="7" stroke="black" stroke-width="2"
                                        stroke-linecap="round" />
                                    <line x1="17" y1="3" x2="17" y2="7" stroke="black" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>

                            </span>
                            <input type="text" id="tanggal-lahir" name="tanggal-lahir" placeholder="Tanggal Lahir"
                                class="sign-in-custom-input date-input" />
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="black">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M7 5V2C7 1.44772 7.44772 1 8 1H16C16.5523 1 17 1.44772 17 2V5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7ZM4 16V19H20V16H4ZM4 14H20V7H4V14ZM9 3V5H15V3H9ZM11 11H13V13H11V11Z"
                                            stroke="black" stroke-width="0" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </g>
                                </svg>
                            </span>
                            <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan"
                                class="sign-in-custom-input" />
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="black">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="black" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12H4C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.25022 4 6.82447 5.38734 5.38451 7.50024L8 7.5V9.5H2V3.5H4L3.99989 5.99918C5.82434 3.57075 8.72873 2 12 2ZM13 7L12.9998 11.585L16.2426 14.8284L14.8284 16.2426L10.9998 12.413L11 7H13Z"
                                            stroke="black" stroke-width="0" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </g>
                                </svg>
                            </span>
                            <input type="text" name="riwayat" id="riwayat" placeholder="Riwayat Penyakit"
                                class="sign-in-custom-input" />
                        </div>

                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="black"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_330_7186" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_330_7186)">
                                        <path
                                            d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z"
                                            stroke="black" stroke-width="0" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </g>
                                </svg>
                            </span>
                            <input type="number" name="no-hp" id="Nomor Handphone" placeholder="Nomor Handphone"
                                class="sign-in-custom-input" />
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="black">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"
                                            stroke="black" stroke-width="0" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                    </g>
                                </svg>
                            </span>
                            <input type="email" name="email" id="Email" placeholder="Email"
                                class="sign-in-custom-input" />
                        </div>
                        <div class="form-details-sign-in mt-12">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <mask id="mask0_204_148" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_204_148)">
                                        <path
                                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21"
                                            stroke="black" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </span>
                            <input type="text" name="username" id="username" placeholder="Nama Pengguna"
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
                            <input type="password" name="password" id="password" placeholder="Kata Sandi"
                                class="sign-in-custom-input" />
                            <i class="fas fa-eye-slash" id="eye"></i>
                        </div>
                        <span id="pass-require">Password minimal terdiri dari 8 karakter, serta harus terdapat minimal 1
                            huruf kapital dan
                            1 angka</span>
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
                            <input type="password" name="re-password" id="confirm" placeholder="Konfirmasi Kata Sandi"
                                class="sign-in-custom-input" />
                            <i class="fas fa-eye-slash" id="eye"></i>
                        </div>
                        <div class="sign-in-btn mt-32">
                            <input type="submit" name="submit" value="Daftar">
                        </div>
                    </form>
                </div>
            </div>
            <div class="block-footer">
                <p>
                    Sudah punya akun?
                    <a href="<?= base_url('login') ?>">Masuk</a>
                </p>
            </div>
        </section>
        <!-- Sign in screen end -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url() ?>assets/js/umur.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>
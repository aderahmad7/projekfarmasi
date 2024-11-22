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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body class="inter-body learning-color">

    <!-- header start -->
    <header class="main-header learning-header h-102">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header">
                        <div class="header-left">
                            <a class="text-white" href="javascript:history.back()">
                                <i class="ri-arrow-left-line"></i>
                            </a>
                        </div>

                        <div class="header-right">
                            <div class="notification-box">
                                <a class="text-white" href="<?= site_url('pasien/list_chat') ?>">
                                    <i class="ri-chat-4-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="header-bottom header-bottom-2">
                        <h2 class="fw-500 text-white">Edit Profil</h2>
                    </div>
                </div>
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

    <!-- Edit Profile Section Start -->
    <!-- Edit Profile Section End -->

    <!-- account name section start -->
    <section class="section-t-space account-name-section">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="acount-form-box">
                        <form method="post" action="<?= site_url('pasien/ubah_profil') ?>" enctype="multipart/form-data"
                            class="form-style-1">
                            <?= csrf_field() ?>
                            <section class="section-t-space edit-profile-section">
                                <div class="custom-container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="edit-image">
                                                <div class="profile-pic">
                                                    <input id="file" name="foto" type="file" onchange="loadFile(event)">
                                                    <img src="<?= base_url($foto) ?>" id="output" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" value="<?= $nama ?>" class="form-control"
                                    placeholder="Masukkan nama Anda" id="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option disabled>Pilih Gender</option>
                                    <option <?= $gender === 'Laki-laki' ? 'selected' : '' ?> value="Laki-laki">Laki-laki
                                    </option>
                                    <option <?= $gender === 'Perempuan' ? 'selected' : '' ?> value="Perempuan">Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column">
                                <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                                <input type="text" value="<?= $tgl_lahir ?>" id="tanggal-lahir" name="tanggal-lahir"
                                    placeholder="Tanggal Lahir" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="no-hp" class="form-label">Nomor Handphone</label>
                                <input type="text" name="no-hp" class="form-control" min="0"
                                    placeholder="Masukkan nomor handphone Anda" id="no-hp" value="<?= $no_hp ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="riwayat" class="form-label">Riwayat Kesehatan</label>
                                <input type="text" name="riwayat" class="form-control" min="0"
                                    placeholder="Masukkan riwayat kesehatan Anda" id="riwayat" value="<?= $riwayat ?>"
                                    required>
                            </div>
                            <div class="mb-5">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control"
                                    placeholder="Masukkan pekerjaan Anda" id="pekerjaan" value="<?= $pekerjaan ?>"
                                    required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-gradient mb-4" value="Simpan Pengaturan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account name section end -->

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= base_url() ?>assets/js/umur.js"></script>
    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- image change js -->
    <script src="<?= base_url() ?>assets/js/image-change.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>
</body>

</html>
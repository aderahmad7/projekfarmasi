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
                                <a class="text-white" href="<?= site_url('dokter/list_chat') ?>">
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
    <!-- Edit Profile Section End -->
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
    <!-- account name section start -->
    <section class="section-t-space account-name-section">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="acount-form-box">
                        <form method="post" action="<?= site_url('dokter/ubah_profil') ?>" class="form-style-1"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <section class="section-t-space edit-profile-section">
                                <div class="custom-container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="edit-image">
                                                <div class="profile-pic">
                                                    <input name="foto" id="file" type="file" onchange="loadFile(event)">
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
                                <input type="text" name="nama" class="form-control" placeholder="Enter your name"
                                    id="nama" value="<?= $nama ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option disabled>Select Gender</option>
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
                                    placeholder="Enter your phone number" id="no-hp" value="<?= $no_hp ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="spesialis" class="form-label">Jenis Tenaga Kesehatan</label>
                                <input type="text" name="spesialis" class="form-control" min="0"
                                    placeholder="Enter your specialist" id="spesialis" value="<?= $spesialis ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="exp-years" class="form-label">Tahun Pengalaman</label>
                                <input type="number" min="0" name="exp-years" class="form-control" min="0"
                                    placeholder="Enter your experience years" id="exp-years" value="<?= $exp_years ?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="hari-mulai" class="form-label">Hari Mulai</label>
                                <select name="hari-mulai" class="form-select">
                                    <option disabled>Pilih Hari Mulai</option>
                                    <option <?= $hari_mulai === "Senin" ? 'selected' : '' ?> value="Senin">Senin</option>
                                    <option <?= $hari_mulai === "Selasa" ? 'selected' : '' ?> value="Selasa">Selasa
                                    </option>
                                    <option <?= $hari_mulai === "Rabu" ? 'selected' : '' ?> value="Rabu">Rabu</option>
                                    <option <?= $hari_mulai === "Kamis" ? 'selected' : '' ?> value="Kamis">Kamis</option>
                                    <option <?= $hari_mulai === "Jumat" ? 'selected' : '' ?> value="Jumat">Jumat</option>
                                    <option <?= $hari_mulai === "Sabtu" ? 'selected' : '' ?> value="Sabtu">Sabtu</option>
                                    <option <?= $hari_mulai === "Minggu" ? 'selected' : '' ?> value="Minggu">Minggu
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hari-selesai" class="form-label">Hari Selesai</label>
                                <select name="hari-selesai" class="form-select">
                                    <option disabled>Pilih Hari Selesai</option>
                                    <option <?= $hari_selesai === "Senin" ? 'selected' : '' ?> value="Senin">Senin</option>
                                    <option <?= $hari_selesai === "Selasa" ? 'selected' : '' ?> value="Selasa">Selasa
                                    </option>
                                    <option <?= $hari_selesai === "Rabu" ? 'selected' : '' ?> value="Rabu">Rabu</option>
                                    <option <?= $hari_selesai === "Kamis" ? 'selected' : '' ?> value="Kamis">Kamis</option>
                                    <option <?= $hari_selesai === "Jumat" ? 'selected' : '' ?> value="Jumat">Jumat</option>
                                    <option <?= $hari_selesai === "Sabtu" ? 'selected' : '' ?> value="Sabtu">Sabtu</option>
                                    <option <?= $hari_selesai === "Minggu" ? 'selected' : '' ?> value="Minggu">Minggu
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jam-mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="jam-mulai" class="form-control"
                                    placeholder="Enter your start time" id="jam-mulai" value="<?= $jam_mulai ?>"
                                    required>
                            </div>
                            <div class="mb-5">
                                <label for="jam-selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="jam-selesai" class="form-control"
                                    placeholder="Enter your end time" id="jam-selesai" value="<?= $jam_selesai ?>"
                                    required>
                            </div>
                            <input type="submit" class="btn btn-gradient mb-4" value="Simpan Pengaturan">
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
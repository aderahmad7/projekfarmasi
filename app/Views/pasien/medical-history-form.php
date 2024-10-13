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
                <h2 class="fw-500 text-white">Formulir Riwayat Kesehatan</h2>
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

    <!-- medical history form Section Start -->
    <section class="section-t-space">
        <div class="custom-container">
            <form class="form-style-1 pb-4" action="<?= base_url('pasien/add_riwayat/' . $id_pasien) ?>" method="post">
                <div class="learning-theme-form">
                    <!-- Input Keluhan Start -->
                    <label for="keluhan" class="form-label">Keluhan :</label>
                    <textarea class="form-control mb-3" name="keluhan" id="keluhan"></textarea>
                    <!-- Input Keluhan End -->

                    <!-- Divider Setting Start -->
                    <section class="section-t-space section-b-space">
                        <div class="divider"></div>
                    </section>
                    <!-- Divider Setting End -->

                    <!-- Input Gula Darah Start -->
                    <label for="gula-darah-puasa" class="form-label">Gula Darah :</label>
                    <input type="text" class="form-control mb-3" name="gula-darah-puasa" placeholder="Gula Darah Puasa"
                        id="gula-darah-puasa">
                    <input type="text" class="form-control mb-3" name="gula-darah-sewaktu"
                        placeholder="Gula Darah Sewaktu" id="gula-darah-sewaktu">
                    <input type="text" class="form-control mb-3" name="gula-darah-setelah-makan"
                        placeholder="Gula Darah 2 Jam Setelah Makan" id="gula-darah-setelah-makan">
                    <!-- Input Gula Darah End -->

                    <!-- Divider Setting Start -->
                    <section class="section-t-space section-b-space">
                        <div class="divider"></div>
                    </section>
                    <!-- Divider Setting End -->

                    <!-- Input Obat Start -->
                    <div id="obat-container">
                        <div class="obat-title d-flex justify-content-between align-items-center mb-3">
                            <label for="nama-obat" class="form-label mb-0">Obat :</label>
                            <button type="button" class="add-obat-container bg-transparent border-0 d-flex gap-2"
                                id="add-obat-btn">
                                <i class="ri-add-circle-line form-label mb-0"></i>
                                <p class="form-label mb-0">Tambah Obat</p>
                            </button>
                        </div>
                        <input type="text" class="form-control mb-3" name="nama-obat[]" placeholder="Nama Obat"
                            id="nama-obat">
                        <input type="text" class="form-control mb-3" name="aturan-pakai[]" placeholder="Aturan Pakai"
                            id="aturan-pakai">
                    </div>
                    <!-- Input Obat End -->

                    <!-- Template Input Obat Start -->
                    <template id="obat-template">
                        <div class="obat-item">
                            <div class="obat-title d-flex justify-content-end align-items-center mb-3">
                                <button type="button"
                                    class="add-obat-container bg-transparent border-0 d-flex gap-2 remove-obat">
                                    <i class="ri-indeterminate-circle-line form-label mb-0 text-danger remove-obat"></i>
                                    <p class="form-label mb-0 text-danger remove-obat">Hapus Obat</p>
                                </button>
                            </div>
                            <input type="text" class="form-control mb-3" name="nama-obat[]" placeholder="Nama Obat"
                                id="nama-obat">
                            <input type="text" class="form-control mb-3" name="aturan-pakai[]"
                                placeholder="Aturan Pakai" id="aturan-pakai">
                        </div>
                    </template>
                    <!-- Template Input Obat End -->

                    <!-- Divider Setting Start -->
                    <section class="section-t-space section-b-space">
                        <div class="divider"></div>
                    </section>
                    <!-- Divider Setting End -->

                    <input type="submit" class="btn btn-gradient mt-2" value="Kirim">
                </div>
            </form>
        </div>
    </section>
    <!-- medical history form Section End -->


    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>

    <!-- Medical History Form js-->
    <script src="<?= base_url() ?>assets/js/medical-history-form.js"></script>
</body>

</html>
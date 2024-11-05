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

    <!-- Custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
                        <a class="text-white" href="<?=site_url('dokter/list_chat') ?>">
                            <i class="ri-chat-4-line"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="header-bottom header-bottom-2">
                <h2 class="fw-500 text-white">Data Riwayat Kesehatan</h2>
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

    <!-- medical history data Section Start -->
    <section class="section-t-space">
        <div class="custom-container">
            <div class="date-container mb-3 d-flex align-items-center justify-content-evenly">
                <i class="ri-calendar-2-line date-icon"></i>
                <input type="text" id="startDate" name="start-date" placeholder="Tanggal Awal"
                    class="sign-in-custom-input date-input" />
                <span>-</span>
                <input type="text" id="endDate" name="start-date" placeholder="Tanggal Akhir"
                    class="sign-in-custom-input" />
            </div>
            <!-- Memilih pasien -->
            <form action="" method="post" class="mb-4">
                <label for="dropdown" class="custom-label">Pilih Pasien</label>
                <select id="dropdown" name="user-medical-history" class="form-select custom-dropdown"
                    aria-label="Default select example">
                    <option value="#" disabled selected>Pilih disini</option>
                    <?php foreach ($dataPasienWithDetails as $detail): ?>
                        <option value="<?= $detail['id'] ?>"><?= $detail['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
            <!-- Tabel medical history -->
            <div class="medical-history-data-container d-flex flex-column gap-3 mb-3">
            </div>
            <div id="pagination" class="pagination"></div>
        </div>
    </section>
    <!-- medical history data Section End -->

    <script>
        var pasienData = <?= json_encode($dataPasienWithDetails) ?>;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Medical History Data js-->
    <script src="<?= base_url() ?>assets/js/medical-history-doctor.js"></script>

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
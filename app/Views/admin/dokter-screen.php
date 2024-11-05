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
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/bootstrap.css" />

    <!-- Swiper css -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/swiper/swiper-bundle.min.css" /> -->

    <!-- Remix Icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/remixicon.css" />

    <!-- Style css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
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


                    </div>

                    <div class="header-bottom header-bottom-2">
                        <h2 class="fw-500 text-white">Data Tenaga Kesehatan</h2>
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

    <section class="data-dokter-section pt-25 d-flex justify-content-center flex-column m-3 mt-0 gap-3">
        <div class="custom-container table-responsive">
            <button class="btn bg-web-primary text-white mb-3 w-auto" onclick="showForm()">Tambah Tenaga
                Kesehatan</button>
            <?php
            $no = 0;
            foreach ($doctors as $doctor): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title"><?= $doctor['name'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>Gender:</strong> <?= $doctor['gender'] ?></p>
                        <p class="card-text"><strong>Umur:</strong> <?= $doctor['usia'] ?></p>
                        <p class="card-text"><strong>Jenis Tenaga Kesehatan:</strong> <?= $doctor['specialty'] ?></p>
                        <p class="card-text"><strong>Total Tahun Pengalaman:</strong> <?= $doctor['tahunPengalaman'] ?></p>
                        <p class="card-text"><strong>Nomor Handphone:</strong> <?= $doctor['nomorHandphone'] ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= $doctor['email'] ?></p>
                        <p class="card-text"><strong>Nama Pengguna:</strong> <?= $doctor['username'] ?></p>
                        <div class="d-flex justify-content-between mt-3 gap-5">
                            <button class="btn btn-warning" onclick="showForm(<?= $no++ ?>)">Edit</button>
                            <a href="<?= base_url('admin/delete_dokter/' . $doctor['id_user']) ?>" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus tenaga kesehatan ini?')">Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div id="pagination" class="pagination mb-0"></div>
            <table class="table table-bordered table-striped d-none" id="doctor-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Jenis Tenaga Kesehatan</th>
                        <th>Total Tahun Pengalaman</th>
                        <th>Nomor Handphone</th>
                        <th>Email</th>
                        <th>Nama Pengguna</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="doctor-table-body" data-dokter='<?= json_encode($doctors) ?>'></tbody>
            </table>
            <!-- <nav>
                <ul class="pagination mb-5" id="pagination"></ul>
            </nav> -->
        </div>

        <!-- Card 1 -->

    </section>

    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title">
                        Modal title
                    </h5>
                    <button type="button" class="close bg-white border-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="doctor-form" onsubmit="saveDoctor(event)">
                        <input type="hidden" id="doctor-id" />
                        <div class="form-group">
                            <label for="doctor-name">Nama:</label>
                            <input type="text" name="name" class="form-control" id="doctor-name" required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-name">Gender:</label>
                            <select name="gender" id="doctor-gender" class="form-select">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="doctor-usia">Usia:</label>
                            <input type="number" name="usia" class="form-control" id="doctor-usia" required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-tahun-pengalaman">Total Tahun Pengalaman:</label>
                            <input type="number" name="exp-years" class="form-control" id="doctor-tahun-pengalaman"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-nomor-handphone">Nomor Handphone:</label>
                            <input type="number" name="no-hp" class="form-control" id="doctor-nomor-handphone"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-email">Email:</label>
                            <input type="email" name="email" class="form-control" id="doctor-email" required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-username">Nama Pengguna:</label>
                            <input type="text" name="username" class="form-control" id="doctor-username" required />
                        </div>
                        <div class="form-group">
                            <label for="doctor-password">Kata Sandi:</label>
                            <input type="text" name="password" class="form-control" id="doctor-password" />
                        </div>
                        <div class="form-group mb-4">
                            <label for="doctor-specialty">Jenis Tenaga Kesehatan:</label>
                            <input type="text" name="spesialis" class="form-control" id="doctor-specialty" required />
                        </div>
                        <button type="button" class="btn btn-secondary mb-1" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" name="submit" class="btn btn-primary">
                            Simpan perubahan
                        </button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- image change js -->
    <script src="<?= base_url() ?>assets/js/image-change.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>

    <!-- Dokter js -->
    <script src="<?= base_url() ?>assets/js/dokter.js"></script>
</body>

</html>
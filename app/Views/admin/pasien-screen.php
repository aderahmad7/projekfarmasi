<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="X-CSRF-TOKEN" content="<?= csrf_hash() ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="multikit" />
    <meta name="keywords" content="multikit" />
    <title>Multikit - Multi-purpose Html Template</title>
    <link rel="manifest" href="https://themes.pixelstrap.net/multikit/manifest.json" />
    <meta name="theme-color" content="#ff8d2f" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="multikit" />
    <meta name="msapplication-TileImage" content="https://themes.pixelstrap.net/multikit/assets/images/favicon/1.svg" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/x-icon" href="https://themes.pixelstrap.net/multikit/assets/images/favicon/9.svg" />
    <link rel="shortcut icon" href="https://themes.pixelstrap.net/" type="image/x-icon" />

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />

    <!-- Bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/bootstrap.css" />

    <!-- Swiper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/swiper/swiper-bundle.min.css" />

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
                            <a class="text-white" href="<?= site_url('admin/users') ?>">
                                <i class="ri-arrow-left-line"></i>
                            </a>
                        </div>
                    </div>

                    <div class="header-bottom header-bottom-2">
                        <h2 class="fw-500 text-white">Patient Data</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <section class="data-dokter-section pt-25 pe-3">
        <div class="custom-container table-responsive">
            <button class="btn bg-web-primary text-white mb-3 w-auto" onclick="showForm()">Add Patient</button>
            <table class="table table-bordered table-striped" id="patient-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Medical History</th>
                        <th>Job</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="patient-table-body" data-pasien='<?= json_encode($pasiens) ?>'></tbody>></tbody>
            </table>
            <nav>
                <ul class="pagination mb-5" id="pagination"></ul>
            </nav>
        </div>
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
                    <form id="patient-form" onsubmit="savePatient(event)">
                        <input type="hidden" id="patient-id" />
                        <div class="form-group">
                            <label for="patient-name">Name:</label>
                            <input type="text" name="name" class="form-control" id="patient-name" required />
                        </div>
                        <div class="form-group">
                            <label for="patient-gender">Gender:</label>
                            <select name="gender" id="patient-gender" class="form-select">
                                <option disabled selected></option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="patient-usia">Age:</label>
                            <input name="usia" type="number" class="form-control" id="patient-usia" required />
                        </div>
                        <div class="form-group">
                            <label for="patient-job">Job:</label>
                            <input name="pekerjaan" type="text" class="form-control" id="patient-job" required />
                        </div>
                        <div class="form-group">
                            <label for="patient-history">Medical History:</label>
                            <input name="riwayat" type="text" class="form-control" id="patient-history" required />
                        </div>
                        <div class="form-group">
                            <label for="patient-nomor-handphone">Phone Number:</label>
                            <input name="no-hp" type="number" class="form-control" id="patient-nomor-handphone"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="patient-email">Email:</label>
                            <input name="email" type="text" class="form-control" id="patient-email" required />
                        </div>
                        <div class="form-group">
                            <label for="patient-username">Username:</label>
                            <input name="username" type="text" class="form-control" id="patient-username" required />
                        </div>
                        <div class="form-group mb-4">
                            <label for="patient-password">Password:</label>
                            <input name="password" type="text" class="form-control" id="patient-password" />
                        </div>

                        <button type="button" class="btn btn-secondary mb-1" data-dismiss="modal">
                            Close
                        </button>
                        <button name="submit" type="submit" class="btn btn-primary">
                            Save changes
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

    <!-- Pasien js -->
    <script src="<?= base_url() ?>assets/js/pasien.js"></script>
</body>

</html>
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
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/vendors/swiper/swiper-bundle.min.css" />

    <!-- Remix Icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/remixicon.css" />

    <!-- Style css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css" />
    <!-- Questions css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css" />
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
                        <h2 class="fw-500 text-white">Data Post-Test</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <section class="pre-test-section pt-25">
        <div class="custom-container">
            <div class="mb-3">

                <form method="post" action="<?= site_url('posttest/add_question') ?>">
                    <input type="text" name="text" id="questionText" class="form-control"
                        placeholder="Input Question" />
                    <button name="submit" class="btn bg-web-primary text-white mt-2">
                        Tambah Pertanyaan
                    </button>
                </form>
            </div>
            <div id="questionList">
                <?php if (isset($questions) && is_array($questions) && count($questions) > 0): ?>
                    <?php foreach ($questions as $qIndex => $question): ?>
                        <div class="question">
                            <h3 class="question-text mb-3"><?= $qIndex + 1 ?>. <?= esc($question['pertanyaan']) ?></h3>
                            <div class="question-buttons mb-2 d-flex gap-2">
                                <button
                                    onclick="editQuestion(<?= $question['id'] ?>, '<?= addslashes(esc($question['pertanyaan'])) ?>')"
                                    class="btn btn-sm btn-primary rounded-3">Edit
                                    Pertanyaan</button>
                                <a href="<?= base_url('posttest/delete_question/' . $question['id']) ?>"
                                    onclick="return confirm('Are you sure you want to delete this question?');"
                                    class="btn btn-sm btn-danger rounded-3">Hapus Pertanyaan</a>
                                <button onclick="addOption(<?= $question['id'] ?>)" class="btn btn-sm btn-success rounded-3">Tambah Pilihan</button>
                            </div>
                            <div class="options">
                                <?php if (isset($question['options']) && is_array($question['options']) && count($question['options']) > 0): ?>
                                    <?php foreach ($question['options'] as $oIndex => $option): ?>
                                        <div class="option">
                                            <div class="option-text">
                                                <?= chr(97 + $oIndex) ?>. <?= esc($option['teks_pilihan']) ?>
                                                <?php if ($option['id'] === $question['id_jawaban']): ?>
                                                    <span class="text-success">(Jawaban yang benar)</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="option-buttons">
                                                <button
                                                    onclick="editOption(<?= $question['id'] ?>, <?= $question['id_jawaban'] ?>, <?= $option['id'] ?>, '<?= addslashes(esc($option['teks_pilihan'])) ?>')"
                                                    class="btn btn-sm btn-outline-primary w-auto">Edit</button>
                                                <a href="<?= base_url('posttest/delete_option/' . $option['id']) ?>"
                                                    onclick="return confirm('Are you sure you want to delete this option?');"
                                                    class="btn btn-sm btn-outline-danger w-auto">Hapus</a>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada pertanyaan yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="modal fade" id="customModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?= site_url() ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <input type="hidden" name="id_pertanyaan" id="questionId">
                    <input type="hidden" name="id_jawaban" id="ansId">
                    <input type="hidden" name="id_pilihan" id="optionId">
                    <div class="modal-body">
                        <p id="modalMessage"></p>
                        <input name="options" type="text" id="modalInput" class="form-control" />
                    </div>
                    <div class="form-check ms-3">
                        <input class="form-check-input" type="checkbox" id="correctOptionCheck" name="is_correct">
                        <label class="form-check-label" for="correctOptionCheck">
                            Tandai jika ini pilihan yang benar
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" name="submit" type="button" class="btn btn-primary" id="modalConfirm">
                            OK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap js-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <!-- swiper js -->
    <script src="<?= base_url() ?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_swiper.js"></script>

    <!-- image change js -->
    <script src="<?= base_url() ?>assets/js/image-change.js"></script>

    <!-- Theme js-->
    <script src="<?= base_url() ?>assets/js/script.js"></script>

    <!-- Theme Settings js-->
    <script src="<?= base_url() ?>assets/js/theme-setting.js"></script>

    <!-- Pre-test js -->
    <script src="<?= base_url() ?>assets/js/post-test.js"></script>
</body>

</html>
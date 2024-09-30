<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Guruji - Online Learning & Educational Courses</title>
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
        <header id="top-navbar" class="top-navbar">
            <div class="container">
                <div class="top-navbar_full d-flex align-items-center justify-content-center">
                    <div class="top-navbar-title">
                        <p>Post-Test</p>
                    </div>
                </div>
            </div>
            <div class="navbar-boder"></div>
        </header>
        <!-- Header end -->
        <!-- Primary goal start -->
        <section id="primary_goal">
            <div class="container">
                <h1 class="d-none">Goal</h1>
                <h2 class="d-none">Hidden</h2>
                <div class="primary_goal-wrap mt-32">
                    <?php
                    $totalBenar = 0; // Inisialisasi counter untuk jawaban benar
                    $jumlahSoal = count($pertanyaan); // Total jumlah soal
                    
                    foreach ($pertanyaan as $p): ?>
                        <div class="goal-title">
                            <p><?= $p['pertanyaan'] ?></p>
                        </div>
                        <div class="primary-goal-content mt-32">
                            <?php foreach ($pilihan[$p['id']] as $pil): ?>
                                <div class="form-check select-goal mt-12">
                                    <?php
                                    // Periksa apakah jawaban yang dipilih user adalah kunci jawaban
                                    $jawabanUser = $selectedOptions[$p['id']]; // Jawaban yang dipilih user
                                    $isCorrect = ($jawabanUser == $p['id_jawaban']); // Apakah jawaban user benar
                            
                                    if ($pil['id'] == $jawabanUser): ?>
                                        <label class="form-check-label custom-lable-goal"
                                            style="font-weight: bold; color: <?= $isCorrect ? 'green' : 'red' ?>;">
                                            <?= $pil['teks_pilihan'] ?>
                                            <?= $isCorrect ? '(Benar)' : '(Salah)' ?>
                                        </label>
                                        <?php if ($isCorrect)
                                            $totalBenar++; // Jika benar, tambah counter ?>
                                    <?php else: ?>
                                        <label class="form-check-label custom-lable-goal">
                                            <?= $pil['teks_pilihan'] ?>
                                        </label>
                                    <?php endif; ?>
                                    <br>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <br><br>
                    <?php endforeach; ?>

                    <div class="result-summary">
                        <p>Total jawaban benar: <?= $totalBenar ?> dari <?= $jumlahSoal ?> soal</p>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="<?= base_url('posttest') ?>" class="btn btn-danger mt-32 w-100">Kerjakan Ulang</a>
                        </div>
                        <div class="col"><a href="<?= base_url('posttest/done') ?>"
                                class="btn btn-primary mt-32 w-100">Selesai</a></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Primary goal end -->
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>
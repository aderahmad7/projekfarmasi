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
    <style>
        .error {
            color: red;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="site-content">
        <!-- Header start -->
        <header id="top-navbar" class="top-navbar">
            <div class="container">
                <div class="top-navbar_full d-flex align-items-center justify-content-center">
                    <div class="top-navbar-title">
                        <p>Pre-Test</p>
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
                    <form id="quiz-form" class="primary-form" method="POST" action="<?= base_url('pretest/submit') ?>">
                        <?php
                        $i = 0;
                        $idQuestion = [];
                        foreach ($pertanyaan as $p): ?>
                            <?php $idQuestion[] = $p['id']; ?>
                            <?php if ($i > 0): ?>
                                <br><br>
                            <?php endif; ?>
                            <div class="goal-title">
                                <p><?= $p['pertanyaan'] ?></p>
                            </div>
                            <div class="primary-goal-content mt-32">
                                <?php foreach ($pilihan[$p['id']] as $pil): ?>
                                    <div class="form-check select-goal mt-12">
                                        <input class="form-check-input custom-input-goal" name="pilihan[<?= $p['id'] ?>]"
                                            type="radio" id="language<?= $pil['id'] ?>" value="<?= $pil['id'] ?>" />
                                        <label class="form-check-label custom-lable-goal" for="language<?= $pil['id'] ?>">
                                            <?= $pil['teks_pilihan'] ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        <button class="btn btn-primary mt-32 w-100" name="submit" type="submit">Submit</button>
                    </form>
                    <p class="error" id="errorMessage"></p>
                </div>
            </div>
        </section>
        <!-- Primary goal end -->
    </div>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/slick.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
    <script>
        const quizForm = document.getElementById('quiz-form');
        const errorMessage = document.getElementById('errorMessage');

        // Mengambil array id pertanyaan yang di-generate oleh PHP
        const idQuestion = <?= json_encode($idQuestion) ?>;

        quizForm.addEventListener('submit', function (event) {
            let unanswered = false;

            // Loop untuk memeriksa semua pertanyaan
            for (let i = 0; i < idQuestion.length; i++) {
                let questionName = 'pilihan[' + idQuestion[i] + ']'; // Nama input berdasarkan id pertanyaan
                let answered = quizForm.querySelector(`input[name="${questionName}"]:checked`); // Cek apakah ada yang dipilih

                // Jika tidak ada jawaban yang dipilih untuk pertanyaan ini
                if (!answered) {
                    unanswered = true;
                    break; // Hentikan loop jika ada yang tidak dijawab
                }
            }

            // Jika ada pertanyaan yang belum dijawab, tampilkan pesan error dan cegah submit
            if (unanswered) {
                event.preventDefault(); // Cegah submit form
                errorMessage.textContent = 'Harap jawab semua pertanyaan!'; // Tampilkan pesan error
            } else {
                errorMessage.textContent = ''; // Jika semua pertanyaan dijawab, kosongkan pesan error
            }
        });
    </script>
</body>

</html>
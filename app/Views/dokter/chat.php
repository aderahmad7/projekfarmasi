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

    <!-- Custom css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom.css">
</head>

<body class="inter-body learning-color">

    <!-- header start -->
    <header class="main-header main-header-chat learning-header">
        <div class="custom-container">
            <div class="top-header">
                <div class="header-left">
                    <a class="text-white" href="<?= site_url('dokter') ?>">
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

            <div class="profile-container d-flex gap-2 align-items-center">
                <img src="<?= base_url($foto) ?>" class="img-fluid chat-img-profile" alt="" />
                <div class="profile-info">
                    <h2 class="fw-500 text-white chat-name">Dr. Henry Manik</h2>
                    <p class="text-light mb-0">Dokter Umum</p>
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

    <!-- chat Section Start -->
    <section
        class="section-chat section-t-space d-flex flex-column justify-content-between position-relative w-100 p-1">
        <div class="chat-container m-3 pb-4 mb-5">
            <div class="message-container d-flex flex-column gap-4">
                <div class="message-receive">
                    <p class="text-message mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                        repellendus tempora temporibus minus recusandae consequatur necessitatibus ipsam, quo error
                        dolor hic natus nemo, obcaecati nam officia. Ad minus quidem rerum.</p>
                </div>
                <div class="message-sent align-self-end">
                    <p class="text-message sent mb-0 btn-gradient">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Perspiciatis,
                        repellendus tempora temporibus minus recusandae consequatur necessitatibus ipsam, quo error
                        dolor hic natus nemo, obcaecati nam officia. Ad minus quidem rerum.</p>
                </div>
                <div class="message-receive">
                    <img src="<?= base_url($foto) ?>" alt="" class="message-img">
                </div>
                <div class="message-receive">
                    <p class="text-message mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis,
                        repellendus tempora temporibus minus recusandae consequatur necessitatibus ipsam, quo error
                        dolor hic natus nemo, obcaecati nam officia. Ad minus quidem rerum.</p>
                </div>
                <div class="message-sent align-self-end">
                    <p class="text-message sent mb-0 btn-gradient">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Perspiciatis,
                        repellendus tempora temporibus minus recusandae consequatur necessitatibus ipsam, quo error
                        dolor hic natus nemo, obcaecati nam officia. Ad minus quidem rerum.</p>
                </div>
                <div class="message-sent  align-self-end">
                    <img src="<?= base_url($foto) ?>" alt="" class="message-img">
                </div>
            </div>
        </div>
        <div class="chat-card">
            <form action="" method="post" class="d-flex gap-1 p-2 bg-white pt-1">
                <input type="text" placeholder="Ketik pesan..." class="chat-input">
                <label for="file-upload" class="border-0 btn-gradient btn-chat p-2 text-center"><svg class="w-50"
                        viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 3H15L17 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7L9 3ZM12 19C15.3137 19 18 16.3137 18 13C18 9.68629 15.3137 7 12 7C8.68629 7 6 9.68629 6 13C6 16.3137 8.68629 19 12 19ZM12 17C9.79086 17 8 15.2091 8 13C8 10.7909 9.79086 9 12 9C14.2091 9 16 10.7909 16 13C16 15.2091 14.2091 17 12 17Z" />
                    </svg></label>
                <input id="file-upload" type="file" name="upload-image">
                <input type="submit" value="Kirim" class="border-0 btn-gradient p-1 btn-chat">
            </form>
        </div>
    </section>
    <!-- chat Section End -->

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
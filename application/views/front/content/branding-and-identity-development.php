<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="RMW">
    <title><?= $Submenu[0]['meta_title'] ?></title>
    <meta name="description" content="<?= $Submenu[0]['meta_description'] ?>">
    <meta name="keyword" content="<?= $Submenu[0]['meta_keywords'] ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1491326822260603');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1491326822260603&ev=PageView&noscript=1" />
    </noscript>
    <?php $this->load->view("Element/front/header_common.php"); ?>
</head>
<style>
    body{
        font-family: "Lexend", serif !important;
    }
</style>
<body>

    <?php $this->load->view("Element/front/header.php"); ?>
    <!--start about-us section1-->

    <section class="aboutus-section1">
        <div class="container">
            <div class="row row1">
                <div class="col-lg-6">
                    <div class="about-left">
                        <h1><?= $Submenu[0]['top_heading'] ?></h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $Submenu[0]['top_heading'] ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--end of about-us section1-->
    <div class="container">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <?php
        $this->db->select('*');
        $this->db->from('bh_submenu_content');
        $this->db->where('submenu_id', $id);
        $submenu_desc_data = $this->db->get()->result_array();

        ?>
        <div class="container mt-5">
            <div class="row my-5 ">
                <div class="col-1"></div>
                <div class="col-10 mt-5">
                    <p><?= $Submenu[0]['head_text'] ?></p>
                </div>
            </div>
            <div class="row my-5">
                <h2 class="text-center" style="color : #b07f22 !important;"><?= $Submenu[0]['main_heading'] ?></h2>
                <div class="col-1"></div>
                <div class="col-10">
                    <p><?= $Submenu[0]['main_head_desc'] ?></p>
                </div>
            </div>
            <?php for ($i = 0; $i < count($submenu_desc_data); $i++) { ?>
                <div class="row my-5">
                    <?php if ($i % 2 == 1) { ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <img class="w-100"
                                    src="<?php echo BASE_URL . '/webroot/images/submenu/' . $submenu_desc_data[$i]['img'] ?>"
                                    alt="<?php echo $submenu_desc_data[$i]['img'] ?>">
                            </div>
                            <div class="col-md-4">
                                <h2 style="color : #b07f22 !important;"><?= $submenu_desc_data[$i]['heading'] ?></h2>
                                <p class="text-left"><?= $submenu_desc_data[$i]['head_desc'] ?></p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                        <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <h2 style="color : #b07f22 !important;"><?= $submenu_desc_data[$i]['heading'] ?></h2>
                                <p class="text-left"><?= $submenu_desc_data[$i]['head_desc'] ?></p>
                            </div>
                            <div class="col-md-4">
                                <img class="w-100" src="<?php echo BASE_URL . '/webroot/images/submenu/' . $submenu_desc_data[$i]['img'] ?>"
                                    alt=" " width="400px" height="250px">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="row my-5">
                <div class="col-1"></div>
                <div class="col-10 mt-5">
                    <p><?= $Submenu[0]['last_desc'] ?></p>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>


    <?php $this->load->view("Element/front/footer.php"); ?>
    <?php $this->load->view("Element/front/footer_common.php"); ?>
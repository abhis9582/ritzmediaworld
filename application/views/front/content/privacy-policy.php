<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Bhalaai">
    <title><?= $Content[0]['meta_title'] ?></title>
    <meta name="description" content="<?= $Content[0]['meta_description'] ?>">
    <meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
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
    <style>
        .mypolicystyle{
            font-size: 16px;
        }
    </style>
    <?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
    <?php $this->load->view("Element/front/header.php"); ?>


    <!--start about-us section1-->

    <section class="aboutus-section1">
        <div class="container">
            <div class="row row1">
                <div class="col-lg-6">
                    <div class="about-left">
                        <h1><?= $Content[0]['page_heading'] ?></h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $Content[0]['page_title'] ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contactus-section">
        <div class="container">
            <div class="row row1">
                <div class="col-lg-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="container">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-9">
                                        <?= $Content[0]['page_description']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $this->load->view("Element/front/footer.php"); ?>
    <?php $this->load->view("Element/front/footer_common.php"); ?>
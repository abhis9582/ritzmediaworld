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
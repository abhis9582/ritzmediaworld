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
        <?php
        $this->db->select('*');
        $this->db->from('bh_submenu_content');
        $this->db->where('submenu_id', $id);
        $submenu_desc_data = $this->db->get()->result_array();

        ?>
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
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
                                <img class="w-100"
                                    src="<?php echo BASE_URL . '/webroot/images/submenu/' . $submenu_desc_data[$i]['img'] ?>"
                                    alt=" " width="400px" height="250px">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="row my-5 d-flex justify-content-center">
                <div
                    class="wpb_text_column wpb_content_element wpb_animate_when_almost_visible wpb_appear appear free-report seo-beat-ur-competitors wpb_start_animation animated second_div">
                    <div class="wpb_wrapper">
                        <h3 class="free-report-head blue-col">BEAT YOUR COMPETITORS! <span
                                class="seo-orange fw-600 txt-caps"> To know How</span></h3>
                        <p class="mb-0"><a class="beat-your-customer" id="open-form-popup" href="#"> <img decoding="async"
                                    src="<?php echo BASE_URL ?>webroot/images/seo-beat-ur-compet-Click-Icon.png"
                                    alt="click-icon" loading="lazy" />
                                CLICK HERE </a></p>

                    </div>
                </div>
                <div class="col-10 mt-5">
                    <p><?= $Submenu[0]['last_desc'] ?></p>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>


    <?php $this->load->view("Element/front/footer.php"); ?>
    <?php $this->load->view("Element/front/footer_common.php"); ?>
    <script>
        var button = document.getElementById("open-form-popup");
        var closeBtn = document.getElementById("closeFormBtn");
        button.addEventListener("click", function () {
            contactForm.classList.toggle("active");
        });
        closeBtn.addEventListener("click", function () {
            contactForm.classList.remove("active");
        });

        // Close the popup form when clicking outside the form container
        window.addEventListener("click", function (event) {
            if (event.target === contactForm) {
                contactForm.classList.remove("active");
            }
        });
    </script>
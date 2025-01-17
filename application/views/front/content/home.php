<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title><?php echo $Content[0]['meta_title'] ?></title>
    <meta name="description" content="<?php echo $Content[0]['meta_description'] ?>">
    <meta name="keyword" content="<?php echo $Content[0]['meta_keywords'] ?>">
    <!-- Open Graph Tags -->
    <meta property="og:title" content="Top Advertising Agency in Delhi NCR, Digital Marketing Noida" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.ritzmediaworld.com" />
    <meta property="og:image" content="https://ritzmediaworld.com/webroot/front/images/nn_logo.jpg" />
    <meta property="og:description"
        content="Top advertising agency in Delhi NCR. Ritz media world offer SEO, radio, creative print ads services in Greater Noida. Most trusted digital marketing company." />
    <meta property="og:site_name" content="Ritz Media World" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image:alt" content="Ritz Media World Logo" />
    <!-- X card tag  -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="https://twitter.com/ritzmediaworld" />
    <meta name="twitter:title" content="Top Advertising Agency in Delhi NCR, Digital Marketing Noida" />
    <meta name="twitter:description"
        content="Top advertising agency in Delhi NCR. Ritz media world offer SEO, radio, creative print ads services in Greater Noida. Most trusted digital marketing company." />
    <meta name="twitter:image" content="https://ritzmediaworld.com/webroot/front/images/nn_logo.jpg" />
    <meta name="twitter:image:alt" content="Ritz Media World Logo" />
    <!-- canonical link  -->
    <link rel="canonical" href="https://ritzmediaworld.com/">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0YHLN54GF7"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-0YHLN54GF7');
    </script>
    <meta name="google-site-verification" content="UJDMaKvPAV5eAGJrDzTOTmxfhqT2OrUPSxwlVnAcgHs" />
    <script type="application/ld+json">
        {
         "@context": "https://schema.org",
         "@type": "LocalBusiness",
         "name": "Ritz Media World",
         "address": {
         "@type": "PostalAddress",
         "streetAddress": "402-404, 4th Floor, Tower - A1, Corporate Park, Sector 142",
         "addressLocality": "Greater Noida",
         "addressRegion": "Uttar Pradesh",
         "postalCode": "201305"
        },
        "image": "https://ritzmediaworld.com/webroot/front/images/nn_logo.jpg",
        "email": "info@ritzmediaworld.com",
        "telePhone": "+917290002168",
        "url": "https://ritzmediaworld.com",
        "paymentAccepted": [
        "cash",
        "check",
        "credit card",
        "invoice"
        ],
        "openingHours": "Mo,Tu,We,Th,Fr 09:30-18:30",
        "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
            ],
            "opens": "09:30",
            "closes": "18:30"
        }
    ],
        "priceRange": "$"
    }
    </script>
    <?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
    <?php $this->load->view("Element/front/header.php"); ?>
    <?php $this->commonmod_model->incrementVistor(); ?>
    <section class="main-header slider-section">
        <div class="owl-carousel home_slider owl-theme">
            <?php $i = 1;
            foreach ($Banner as $BannerData) {
                $src = $this->image->getImageSrc("gallery", $BannerData['image_name'], DEFAULT_HEADER_BANNER);
                ?>
                <div class="item <?php ($i == 1) ? 'active' : '' ?>">
                    <img src="<?php echo $src ?>" class="d-block image_home1" alt="Ritz Media World Banner">
                </div>
                <?php $i++;
            } ?>
        </div>
    </section>

    <section class="service_boxxx">
        <div class="row mt-2 second_div fromLeftToRight">
            <div class="col-md-3 d-flex justify-content-end mobile-img">
                <img class="mt-3" decoding="async" src="<?php echo BASE_URL ?>webroot/images/seo-How-We-Work-Icon.png"
                    alt="how we work" loading="lazy" />
            </div>
            <div class="col-md-7 thats-how">
                <p>That’s How</p>
                <span>OUR DIGITAL MARKETING STRATEGY</span>
            </div>
            <span class="thats-how-text">STRATEGIES FOR DIGITAL MARKETING
                OUR DIGITAL MARKETING STRATEGIES ARE CUSTOMIZED AND RESULT-ORIENTED TO HELP YOU ACHIEVE
                YOUR BUSINESS GOALS!
            </span>
        </div>
        <div class="row second_div from0to100">
            <div class="thats-how-image">
                <img loading="lazy" decoding="async" src="<?php echo BASE_URL ?>webroot/images/dm-H-Process.png"
                    alt="image" />
            </div>
        </div>
        <div
            class="wpb_text_column wpb_content_element wpb_animate_when_almost_visible wpb_appear appear free-report seo-beat-ur-competitors wpb_start_animation animated second_div fromRightToLeft">
            <div class="wpb_wrapper">
                <h3 class="free-report-head blue-col">BEAT YOUR COMPETITORS! <span class="seo-orange fw-600 txt-caps">
                        To know How</span></h3>
                <p class="mb-0"><a class="beat-your-customer" id="click-form" href="#"> <img decoding="async"
                            src="<?php echo BASE_URL ?>webroot/images/seo-beat-ur-compet-Click-Icon.png"
                            alt="click-icon" loading="lazy" />
                        CLICK HERE </a></p>

            </div>
        </div>
    </section>

    <section class="service_boxxx second_div">
        <h1><?= $why_choose[0]['wcu_head']; ?></h1>
        <div class="container">
            <div class="row row2">
                <div class="col-lg-12">
                    <p><?php echo $why_choose[0]['wcu_desc']; ?></p>
                </div>
                <?php
                $src1 = $this->image->getImageSrc("pages", $Content[0]['page_image1'], DEFAULT_HEADER_BANNER);
                $src2 = $this->image->getImageSrc("pages", $Content[0]['page_image2'], DEFAULT_HEADER_BANNER);
                $src3 = $this->image->getImageSrc("pages", $Content[0]['page_image3'], DEFAULT_HEADER_BANNER);
                ?>
            </div>
        </div>
    </section>

    <section class="service_boxxx second_div from0to100">
        <h2><?= $why_choose[0]['why_best_head']; ?></h2>
        <div class="container">
            <div class="row row2">
                <div class="col-lg-12">
                    <p><?php echo $why_choose[0]['why_best_desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <div class="service_boxxx mb-5">
        <h2>Our Services</h2>
        <p><?php echo $head_titles[0]['title2']; ?></p>
        <div class="container">
            <div class="row ml-2 mr-2">
                <?php foreach ($Service as $s_data) {
                    ?>
                    <div class="sd_boxx col-6 col-md-3 col-lg-3 p-2 mb-4 mt-4">
                        <img src="<?php echo BASE_URL . 'webroot/images/services/' . $s_data['service_image']; ?>"
                            alt="Top branding agency in Delhi – Ritz Media World" loading="lazy" />
                        <h2><?php echo $s_data['service_title']; ?></h2>
                        <?php echo $s_data['description']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <section class="service_boxxx second_div fromBottomToTop">
        <h2 class="mt-5"><?= $why_choose[0]['our_vision_head']; ?></h2>
        <div class="container">
            <div class="row row2">
                <div class="col-lg-12">
                    <p><?php echo $why_choose[0]['our_vision_desc']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="service_boxxx second_div">
        <div class="container">
            <h2><?= $why_choose[0]['how_we_work_head']; ?></h2>
            <p>
                As the most reputed and trusted <a href="https://ritzmediaworld.com/contact.html">Digital Marketing
                    Services Delhi NCR</a>, we continue to strive towards
                maintaining excellence, following an approach that allows us to be the best choice among our
                clients.
            </p>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center">
                        <div class="how-we-work-div mx-4 my-3">
                            <img src="<?php echo BASE_URL ?>webroot/front/images/mk-difrnt-customer-oriented-icon.png"
                                alt="image1" loading="lazy" />
                            <p class="text-light"><?php echo explode("-", $why_choose[0]['how_we_work_desc'])[1]; ?></p>
                        </div>
                        <div class="how-we-work-div mx-4 my-3">
                            <img src="<?php echo BASE_URL ?>webroot/front/images/mk-difrnt-High-End-icon.png"
                                alt="image2" loading="lazy" />
                            <p class="text-light"><?php echo explode("-", $why_choose[0]['how_we_work_desc'])[2]; ?></p>
                        </div>
                        <div class="how-we-work-div mx-4 my-3">
                            <img src="<?php echo BASE_URL ?>webroot/front/images/mk-difrnt-skilled-creativeteam-icon.png"
                                alt="image3" loading="lazy" />
                            <p class="text-light"><?php echo explode("-", $why_choose[0]['how_we_work_desc'])[3]; ?></p>
                        </div>
                        <div class="how-we-work-div mx-4 my-3">
                            <img src="<?php echo BASE_URL ?>webroot/front/images/mk-difrnt-Competetive-icon.png"
                                alt="image4" loading="lazy" />
                            <p class="text-light"><?php echo explode("-", $why_choose[0]['how_we_work_desc'])[4]; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="service_boxxx new-section-word">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="new-section-word-inner">
                    <span>Interested to Grow your
                        Business Creatively With Us ?</span>
                </div>
            </div>
            <div class="col-md-6 d-flex new-section-word-button justify-content-center align-items-center">
                <button class="mx-4" id="new-section-button"><i class="fa fa-phone mx-3">
                    </i>Schedule A Discovery Call</button>
            </div>
        </div>
    </section>

    <section class="service_boxxx">
        <h2 class="highlightsss"> Get Free Consultation from our Digital Marketing Experts!</h2>
    </section>

    <div class="stack_boxxx second_div">
        <h2>A Full Stack Solution Provider</h2>
        <p><?php echo $head_titles[0]['title3']; ?></p>
        <p>&nbsp;</p>
        <div class="list_box1">
            <strong>Key Benefits You Get Only With Ritz Media World</strong>
            <ol>
                <li>16 years of advertising expertise</li>
                <li>Delhi NCR’s best marketing agency awarded by The Economic Times</li>
                <li>360 degree marketing solutions</li>
                <li>Strong portfolio of clientele</li>
                <li>Team of seasoned marketing enthusiast </li>
            </ol>
            <div class="list_icon"><img src="<?php echo BASE_URL; ?>webroot/front/images/list_image.jpg"
                    alt="Best Digital Agency for Your Business - Ritz Media World" loading="lazy" /></div>
        </div>

        <div class="list_box2">
            <strong>What Sets Us Apart?</strong>
            <ul>
                <li><b>Strategic Storytelling:</b> A compelling narrative is leveraged to craft unique stories that
                    connect with your customers.</li>
                <li><b>Omnichannel Expertise:</b> A well-crafted campaign utilizes multiple channels to deliver
                    optimized output. </li>
                <li><b>Data-Driven Insight:</b> Leveraging key data metrics in customer behaviour to build effective
                    campaigns.</li>
                <li><b>Measurable Results:</b> A qualitative delivery of strategy and assets that provides quantitative
                    results. </li>
            </ul>
        </div>
    </div>

    <div class="service_boxxx">
        <h2>Our Clients</h2>
        <p><?php echo $head_titles[0]['title4']; ?></p>
    </div>
    <section class="c_logo second_div">
        <?php foreach ($Customer as $c_data) {
            ?>
            <div class="logo col-6">
                <img src="<?php echo BASE_URL . 'webroot/images/customers/' . $c_data['customer_image']; ?>"
                    class="img-fluid" alt="Clients - Ritz Media World" loading="lazy" />
            </div>
        <?php } ?>
    </section>

    <?php if (count($Testimonial) > 0) { ?>
        <section class="testimonial_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about_content">
                            <div class="background_layer"></div>
                            <div class="layer_content">
                                <div class="section_title">
                                    <h2>Naam Hai <strong>Ritz Media World</strong></h2>
                                    <div class="heading_line"><span></span></div>
                                    <p><?php echo $head_titles[0]['title6']; ?>
                                        <br>
                                        <b>Kuch Toh Bolo!</b>
                                    </p>
                                </div>
                                <a href="https://ritzmediaworld.com/contact.html">Contact Us<i
                                        class="icofont-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="testimonial_box">
                            <div id="customers-testimonials" class="owl-carousel">
                                <?php foreach ($Testimonial as $BannerData) {
                                    $src = $this->image->getImageSrc("testimonials", $BannerData['company_logo'], DEFAULT_HEADER_BANNER);
                                    ?>
                                    <!--TESTIMONIAL 1 -->
                                    <div class="item">
                                        <div class="shadow-effect">
                                            <p><?= $BannerData['description'] ?></p>
                                        </div>
                                        <div class="testimonial-name">
                                            <img class="img-circle" src="<?= $src ?>"
                                                alt="Top branding agency in Delhi – Ritz Media World"
                                                loading="lazy" /><b><?= $BannerData['member_name'] ?></b>
                                        </div>
                                        <div class="testimonial-name"><?= $BannerData['position'] ?></div>
                                    </div>
                                    <!--END OF TESTIMONIAL 1 -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php $AllBrands = $this->gallery_model->getALLImageCategoryFront('1000');
    if (count($AllBrands) > 0) {
        ?>
        <!--start Business model-->
        <section class="brands_box">
            <div class="container">
                <div class="row row1">
                    <h2>
                        <span class="text-center">
                            Some noteworthy assets delivered
                        </span>
                    </h2>
                    <p><?php echo $head_titles[0]['title5']; ?></p>
                    <!-- <p>We’ve crafted unforgettable stories that leave a lasting impression. It’s part of our primary ethos that delivers results. </p> -->
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="owl-carousel brand_box owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage div_home">
                                <?php $i = 1;
                                foreach ($Networthy as $n_Data) {
                                    $src = $this->image->getImageSrc("networthy", $n_Data['n_image'], DEFAULT_HEADER_BANNER);
                                    ?>
                                    <div class="owl-item owl_home <?= ($i == 1) ? 'active' : '' ?>">
                                        <div class="item">
                                            <div class="col-text">
                                                <div class="logo">
                                                    <img src="<?= $src; ?>" class="img-fluid" alt="Ritz Media World - Client"
                                                        loading="lazy" />
                                                    <b><?= $n_Data['title'] ?></b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <div class="owl-nav disabled"><button title="submit_button" type="button" role="presentation"
                                class="owl-prev disabled"><span aria-label="Previous">‹</span></button><button
                                title="submit_button" type="button" role="presentation" class="owl-next disabled"><span
                                    aria-label="Next">›</span></button>
                        </div>
                        <div class="owl-dots disabled">
                            <button title="submit_button" role="button" class="owl-dot active"
                                aria-label="Slide 1"><span>d</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    if (count($khm) > 0) {
        ?>
        <section class="brands_box">
            <div class="container">
                <div class="row row1">
                    <h2><span>
                            Kaam Hai Mera Marketing
                        </span></h2>
                </div>
                <div class="row">
                    <div class="owl-carousel brand_box owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage owl_stage_home">
                                <?php $i = 1;
                                foreach ($khm as $khm) {
                                    $src = $this->image->getImageSrc("khm", $khm['khm_image'], DEFAULT_HEADER_BANNER);
                                    ?>
                                    <div class="owl-item owl_home1 <?= ($i == 1) ? 'active' : '' ?>">
                                        <div class="item">
                                            <div class="col-text">
                                                <div class="logo">
                                                    <img src="<?= $src; ?>" class="img-fluid"
                                                        alt="Best Digital Agency - Ritz Media World" loading="lazy" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++;
                                } ?>
                            </div>
                        </div>
                        <div class="owl-nav disabled">
                            <button title="submit_button" type="button" role="presentation" class="owl-prev disabled"><span
                                    aria-label="Previous">‹</span></button>
                            <button title="submit_button" type="button" role="presentation" class="owl-next disabled"><span
                                    aria-label="Next">›</span></button>
                        </div>
                        <div class="owl-dots disabled">
                            <button title="submit_button" role="button" class="owl-dot active"
                                aria-label="Slide 1"><span>d</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    if (count($Blogs) > 0) {
        $i = 1;
        ?>
        <section class="contactus-section brands_box">
            <div class="container">
                <div class="row row1">
                    <h2><span>
                            Blog Section
                        </span>
                    </h2>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="row justify-content-center">
                            <?php
                            $i = 0;
                            foreach ($Blogs as $BlogData) {
                                if ($i < 4) {
                                    $url_title = create_url($BlogData['slug_url']);
                                    $day = date("d", strtotime($BlogData['add_date']));
                                    $month = date("M", strtotime($BlogData['add_date']));
                                    ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card shadow-sm">
                                            <?php
                                            $src = 'webroot/images/blog_not_found.jpg';
                                            $imagename = $BlogData['blog_image1'];
                                            $imgpath = $this->image->GetImageDirectory('blogs', $imagename);
                                            if ($imagename != "" && file_exists($imgpath . "/" . $imagename)) {
                                                $src = $imgpath . '/' . $imagename;
                                            }
                                            ?>
                                            <a href="<?= BASE_URL ?>blog/<?= $url_title; ?>">
                                                <img src="<?= BASE_URL . $src ?>" class="card-img-top"
                                                    alt="Ritz Media World - Blogs" loading="lazy" />
                                            </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title"><?= htmlspecialchars($BlogData['title']) ?></h5>
                                                <p class="card-text">
                                                    <?= htmlspecialchars(substr(strip_tags($BlogData['description']), 0, 200)) ?>
                                                </p>
                                                <a href="<?= BASE_URL ?>blog/<?= $url_title; ?>" class="btn btn-primary">Read more
                                                    about</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p><a href="<?= BASE_URL ?>blogs">[View All Blogs]</a></p>
                </div>
            </div>
        </section>
    <?php } ?>
    <script>
        window.addEventListener('scroll', doAnime);
        function doAnime() {
            var scrolls = document.querySelectorAll('.second_div');
            for (var i = 0; i < scrolls.length; i++) {
                var windowHeight = window.innerHeight;
                var revealTop = scrolls[i].getBoundingClientRect().top;
                var revealPoint = 50;
                if (revealTop < windowHeight - revealPoint) {
                    scrolls[i].classList.add('doAnimation');
                }
                else {
                    scrolls[i].classList.remove('doAnimation');
                }
            }
        }
    </script>
    <script>
        var button1 = document.getElementById("new-section-button");
        var button = document.getElementById("click-form");
        var closeBtn = document.getElementById("closeFormBtn");
        button.addEventListener("click", function () {
            contactForm.classList.toggle("active");
        });
        button1.addEventListener("click", function () {
            contactForm.classList.toggle("active");
        });
        closeBtn.addEventListener("click", function () {
            contactForm.classList.remove("active");
        });

        window.addEventListener("click", function (event) {
            if (event.target === contactForm) {
                contactForm.classList.remove("active");
            }
        });
    </script>
    <script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>
    <script src="<?= FRONT_DIR ?>js/popper.min.js"></script>
    <script src="<?= FRONT_DIR ?>js/owl.carousel.min.js"></script>
    <?php $this->load->view("Element/front/footer_home.php"); ?>


</body>

</html>
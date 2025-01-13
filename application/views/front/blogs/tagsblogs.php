<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title><?= $Content[0]['meta_title'] ?></title>
    <meta name="description" content="<?= $Content[0]['meta_description'] ?>">
    <meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Lexend", serif !important;
        }
    </style>
    <?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
    <?php $this->load->view("Element/front/header.php"); ?>
    <div class="clearfix"></div>
    <?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], ""); ?>
    <section class="aboutus-section1" style="background: url(<?= $src ?>);">
        <div class="container">
            <div class="row row1">
                <div class="col-lg-6">
                    <div class="about-left contact-left">
                        <h1>BLOGS</h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>blogs">Blogs</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
    <section class="contactus-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-11">
                    <div class="row mt-3">
                        <?php
                        foreach ($Blogs as $BlogData) {
                            $url_title = create_url($BlogData['slug_url']) . '/';
                            $day = date("d", strtotime($BlogData['add_date']));
                            $month = date("M", strtotime($BlogData['add_date']));
                            ?>
                            <div class="col-md-4 col-lg-4">
                                <div class="left-col">
                                    <div class="projects events-list">
                                        <ul class="media-list">
                                            <li class="media animated out" data-animation="fadeInLeft" data-delay="0">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <?php $src = 'webroot/images/blog_not_found.jpg';
                                                    $imagename = $BlogData['blog_image1'];
                                                    $imgpath = $this->image->GetImageDirectory('blogs', $imagename);
                                                    if ($imagename != "" && file_exists($imgpath . "/" . $imagename) == true) {
                                                        $src = ($imagename) ? $imgpath . '/' . $imagename : "webroot/images/rap_temp.jpg";
                                                    }
                                                    ?>
                                                    <a href="<?= BASE_URL ?>blog/<?= $url_title; ?>">
                                                        <img src="<?= BASE_URL . $src ?>" class="media-object" alt="image"
                                                            style="max-width:100%;max-height:100%;">
                                                    </a>
                                                    <div class="media-body">
                                                        <header class="post-heading">
                                                            <div class="date-tag"><span><?= $day ?> </span><?= $month ?>
                                                            </div>
                                                            <h4 class="media-heading headingfont"><a
                                                                    href="<?= BASE_URL ?>blog/<?= $url_title; ?>"><?= $BlogData['title'] ?></a>
                                                            </h4>
                                                        </header>
                                                        <div class="clearfix"></div>
                                                        <p>
                                                            <?= substr(strip_tags($BlogData['description']), 0, 200) ?>
                                                            <a class="blog_read"
                                                                href="<?= BASE_URL ?>blog/<?= $url_title; ?>">[Read
                                                                More]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Pagination Links -->
                    <div class="pagination-container">
                        <?php if ($pagination_links): ?>
                            <ul class="pagination">
                                <?php echo $pagination_links; ?>
                            </ul>
                        <?php else: ?>
                            <!-- <p>No blogs to display</p> -->
                        <?php endif; ?>
                    </div>
                </div>

                <!-- <div class="col-md-3">
                    <form action="<?= BASE_URL ?>blogs/search" method="post">
                        <input type="text" name="search_key" placeholder="Search" class="col-md-12 blog_search"
                            value="<?= @$searckkey ?>">

                        <script>
                            function changeUrl(searchval) {
                                window.location.href = '<?= BASE_URL ?>blogs/archive/' + searchval;
                            }
                        </script>
                        <button class="btn btn-danger btn-md pull-right col-md-12" name="submit">Search</button>
                    </form>

                    <div class="widget widget_categories animated fadeInUp in" data-animation="fadeInUp" data-delay="0">
                        <header class="heading headingfont">
                            <h4 class="blog_head">Archives</h4>
                        </header>
                        <ul>
                            <?php
                            foreach ($this->blog_model->getALLMonthBlogs() as $Allmonth) {
                                ?>
                                <li class="new_list4"><a
                                        href="<?= BASE_URL ?>blogs/archive/<?= $Allmonth['year'] ?>/<?= $Allmonth['month'] ?>"><?= $this->commonmod_model->getMonthName($Allmonth['month']); ?>
                                        <?= $Allmonth['year'] ?></a></li>
                            <?php } ?>
                        </ul>

                    </div>
                    <div class="widget widget_categories animated fadeInUp in" data-animation="fadeInUp" data-delay="0">
                        <header class="heading headingfont">
                            <h4 class="blog_head">Categories</h4>
                        </header>
                        <ul>
                            <?php
                            foreach ($Category_list as $BlogCatData) {
                                $cat_url_title = create_url($BlogCatData['category_name']);
                                ?>
                                <li>
                                    <a href="<?php if ($BlogCatData['id'] == "") {
                                        echo '#';
                                    } else {
                                        BASE_URL ?>category/<?= $cat_url_title;
                                    } ?>"><?= $BlogCatData['category_name'] ?></a>
                                    (<?= $this->commonmod_model->GetCountBlogBycategory($BlogCatData['id']); ?>)
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div> -->

            </div>
        </div>
    </section>
    <?php $this->load->view("Element/front/footer.php"); ?>
    <?php $this->load->view("Element/front/footer_common.php"); ?>
</body>

</html>
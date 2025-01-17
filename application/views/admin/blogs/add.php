<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add New Blog</title>
    <?php $this->load->view("Element/admin/header_common.php"); ?>

</head>

<body>
    <!-- container section start -->
    <section id="container" class="">


        <?php $this->load->view("Element/admin/header.php"); ?>

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <!--overview start-->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Add Blog</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="<?= BASE_URL ?>admin/dashboard">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Add New Blog</li>
                        </ol>
                    </div>
                </div>




                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Add New Blog<br>
                                <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns"
                                    href="<?= BASE_URL ?>admin/blogs" title="Back">Back</a>
                            </header>
                            <div class="panel-body">
                                <?php
                                if (validation_errors())
                                    echo '<div class="error" id="FLASH" name="FLASH">' . validation_errors() . '</div>';
                                if ($this->session->flashdata("error")) {
                                    echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata("error") . '</div>';
                                } else if ($this->session->flashdata("success")) {
                                    echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata("success") . '</div>';
                                }
                                if (isset($_SESSION['error'])) {
                                    unset($_SESSION['error']);
                                } else if (isset($_SESSION['success'])) {
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <form class="form-horizontal" action="<?= BASE_URL . 'admin/blogs/add' ?>" method="post"
                                    enctype="multipart/form-data">
                                    <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Blog Category</label>
                                        <div class="col-sm-6">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option>Please Select</option>
                                                <?php
                                                $allblogs = $this->blog_model->getALLBlogCategories();
                                                //print_r($allcountry);
                                                foreach ($allblogs as $singleData) {
                                                    //$url = $this->create_url($singleData['Title']);
                                                    if ($_POST['category_id'] == $singleData['id']) {
                                                        $class = 'selected';
                                                    } else {
                                                        $class = '';
                                                    } ?>
                                                    <option value="<?= $singleData['id']; ?>" <?= $class; ?>>
                                                        <?= $singleData['category_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Blog Title</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" id="title"
                                                value="<?= (isset($_POST['title']) != '') ? $_POST['title'] : '' ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Blog URL</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="slug_url" id="slug_url" value=""
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Youtube Url</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="youtube_video" id="title"
                                                value="<?= (isset($_POST['youtube_video']) != '') ? $_POST['youtube_video'] : '' ?>"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Youtube Width</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="y1_width" id="y1_width" class="form-control"
                                                min="0">
                                        </div>
                                        <label class="col-sm-2 control-label">Youtube Height</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="y1_height" id="y1_height" class="form-control"
                                                min="0">
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                      <label class="col-sm-2 control-label">Custom Video Link</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="custom_video" id="title" value="<?= (isset($_POST['custom_video']) != '') ? $_POST['custom_video'] : '' ?>" class="form-control">
                                      </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Meta Title</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="meta_title" id="meta_title"
                                                value="<?= (isset($_POST['meta_title']) != '') ? $_POST['meta_title'] : '' ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Meta Description</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="meta_description" id="meta_description"
                                                value="<?= (isset($_POST['meta_description']) != '') ? $_POST['meta_description'] : '' ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Meta Keyword</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="meta_keywords" id="meta_keywords"
                                                value="<?= (isset($_POST['meta_keywords']) != '') ? $_POST['meta_keywords'] : '' ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Blog Image </label>
                                        <div class="col-sm-6">
                                            <input type="file" name="blog_image1" id="blog_image1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Blog Description</label>
                                        <div class="col-sm-6">
                                            <textarea name="description" id="description" value=""
                                                class="form-control ckeditor"><?= (isset($_POST['description']) != '') ? stripslashes($_POST['description']) : '' ?></textarea>
                                        </div>
                                    </div>
                                    <div id="new_chq"></div>
                                    <input type="hidden" value="1" id="total_chq">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-6">
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">In-active</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                            <button class="btn btn-primary admin-buttns2" name="submitForm"
                                                type="submit">Submit</button>
                                            <button class="btn btn-default"
                                                onclick="window.location.href='<?= BASE_URL ?>admin/blogs'"
                                                type="button">Cancel</button>
                                        </div>
                                    </div>

                                </form>
                                <!-- <button onclick="add()">Add</button>
                                <button onclick="remove()">remove</button> -->
                            </div>
                        </section>
                    </div>
                </div>


                <!-- project team & activity end -->

            </section>
            <?php $this->load->view("Element/admin/footer_common.php"); ?>
        </section>
        <!--main content end-->
    </section>
    <!-- container section start -->

    <?php $this->load->view("Element/admin/footer.php"); ?>

    <script>
        $(window).load(function () {
            show_state('101');
        });
        function show_state(country) {
            if (country == "") { $("#state").prop("disabled", true); } else { $("#state").prop("disabled", false); }

            $.ajax({
                url: "<?php echo base_url('admin/user/show_state'); ?>",
                type: "POST",
                data: { 'countryval': country },
                dataType: 'json',
                success: function (data2) {
                    $("#state").html(data2);
                },
                error: function () {
                    alert("there is error");
                }
            });

        }

        function show_city(state) {
            if (state == "") { $("#city").prop("disabled", true); } else { $("#city").prop("disabled", false); }
            $.ajax({
                url: "<?php echo base_url('admin/user/show_city'); ?>",
                type: "POST",
                data: { 'state': state },
                dataType: 'json',
                success: function (data) {
                    $("#city").html(data);
                },
                error: function () {
                    alert("there is error");
                }
            });

        }

    </script>
    <script type="text/javascript" src="<?= ADMIN_DIR ?>assets/ckeditor/ckeditor.js"></script>
</body>

</html>
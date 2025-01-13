<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Manage Blogs</title>
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
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Manage Blogs</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="<?= BASE_URL ?>admin/dashboard">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Manage Blogs</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
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
                            <header class="panel-heading">
                                Manage Blogs
                                <br>
                                <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                                <div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;">
                                    <select name="agent_id" id="agent_id" class="form-control"
                                        ONCHANGE="redirect(this.value)">
                                        <option value="<?= BASE_URL ?>admin/blogs">Select Category</option>
                                        <?php
                                        $allAgent = $this->blog_model->getALLBlogCategories();
                                        //print_r($allcountry);
                                        foreach ($allAgent as $AgentData) {
                                            //$url = $this->create_url($singleData['Title']);
                                            if (@$category_id == $AgentData['id']) {
                                                $class = 'selected';
                                            } else {
                                                $class = '';
                                            } ?>
                                            <option value="<?= BASE_URL ?>admin/blogs/category/<?= $AgentData['id']; ?>"
                                                <?= $class; ?>><?= ucwords($AgentData['category_name']); ?></option>
                                        <?php } ?>
                                        <option value="<?= BASE_URL ?>admin/blogs">All Category</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns "
                                        href="<?= BASE_URL ?>admin/blogs/add" title="Add New Blog">Add Blog </a>
                                </div>
                            </header>
                            <table id="myTable" class="table table-striped table-advance table-hover" id="example"
                                class="display">
                                <?php if (count($Blogs) > 0) { ?>
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Blog URL</th>
                                            <!-- <th>Description</th> -->
                                            <th>Category</th>
                                            <th>Add Date</th>
                                            <th> Status</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Blog URL</th>
                                            <!-- <th>Description</th> -->
                                            <th>Category</th>
                                            <th>Add Date</th>
                                            <th> Status</th>
                                            <th> Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($Blogs as $BlogsData) { ?>
                                            <tr>
                                                <td><?php $src = $this->image->getImageSrc("blogs", $BlogsData['blog_image1'], ""); ?>
                                                    <img src="<?= $src ?>" style="width:110px;" />
                                                </td>
                                                <td><?= Ucfirst($BlogsData['title']); ?> </td>
                                                <td><?= Ucfirst($BlogsData['slug_url']); ?> </td>
                                                <!-- <td> </td> -->
                                                <td><?php $blogCat = $this->blog_model->GetBlogCategoryNameByID($BlogsData['category_id']);
                                                echo @$blogCat['category_name']; ?> </td>
                                                <td><?= date("d M,Y", strtotime($BlogsData['add_date'])); ?> </td>
                                                <td><?= ($BlogsData['status'] == 1) ? 'Active' : 'In-Active'; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <?php if ($BlogsData['set_home'] == '0') { ?>
                                                        <?php } ?>
                                                        <a class="btn" style="padding:2px;"
                                                            href="<?= BASE_URL . 'admin/blogs/view/' . $BlogsData['id'] ?>"
                                                            onclick="return confirm('Are You Sure to View ?');"
                                                            title="View"><img
                                                                src="<?php echo BASE_URL; ?>webroot/admin/fonts/eye-solid2.svg"
                                                                style="color:blue;width:30px"></img></a>
                                                        <a class="btn btn-success"
                                                            href="<?= BASE_URL . 'admin/blogs/edit/' . $BlogsData['id'] ?>"
                                                            onclick="return confirm('Are You Sure to Edit ?');"><i
                                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        <a class="btn btn-danger"
                                                            href="<?= BASE_URL . 'admin/blogs/delete/' . $BlogsData['id'] ?>"
                                                            onclick="return confirm('Are You Sure to Delete ?');"><i
                                                                class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else { ?>
                                    <tbody>
                                        <tr class="odd">
                                            <td valign="top" colspan="6" class="dataTables_empty">No records found</td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
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
    <script>
        function redirect(url) {
            window.location.href = url;

        }
    </script>
    <?php $this->load->view("Element/admin/footer.php"); ?>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        })
    </script>
</body>

</html>
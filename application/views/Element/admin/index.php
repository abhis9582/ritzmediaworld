<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Manage How It Works</title>
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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Manage How It Works</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="<?= BASE_URL ?>admin">Home</a></li>
              <li><i class="fa fa-laptop"></i>Manage How It Works</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Manage How It Works
                <br>
                <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                <div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;">
                  <select name="agent_id" id="agent_id" class="form-control" ONCHANGE="redirect(this.value)">
                    <option value="<?= BASE_URL ?>admin/howitworks">Select Category</option>
                    <option value="1" <?php if (@$category_id == '1') { ?> selected <?php } ?>>How It Works</option>
                    <option value="2" <?php if (@$category_id == '2') { ?> selected <?php } ?>>FAQ</option>
                    <option value="<?= BASE_URL ?>admin/howitworks">All Category</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns "
                    href="<?= BASE_URL ?>admin/howitworks/add" title="Add New Blog">Add How It Works </a>
                </div>
              </header>
              <?php

              if (validation_errors())
                echo '<div class="error" id="FLASH" name="FLASH">' . validation_errors() . '</div>';
              if ($this->session->flashdata("error"))
                echo '<div class="normal" id="FLASH" name="FLASH">' . $this->session->flashdata("error") . '</div>';
              ?>
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <?php if (count($Blogs) > 0) { ?>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Add Date</th>


                      <th> Status</th>
                      <th> Action</th>
                    </tr>
                    <?php foreach ($Blogs as $BlogsData) { ?>
                      <tr>
                        <td><?= Ucfirst($BlogsData['title']); ?> </td>
                        <td><?= substr($BlogsData['description'], 0, 80); ?> </td>
                        <td>
                          <?php echo $blogCat = $this->howitworks_model->GetHowItworksCategoryNameByID($BlogsData['category_id']); ?>
                        </td>
                        <td><?= date("d M,Y", strtotime($BlogsData['add_date'])); ?> </td>

                        <td><?= ($BlogsData['status'] == 1) ? 'Active' : 'Archive'; ?></td>

                        <td>
                          <div class="btn-group">
                            <a class="btn btn-info" href="<?= BASE_URL . 'admin/howitworks/edit/' . $BlogsData['id'] ?>"
                              onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o"
                                aria-hidden="true"></i></a>

                            <a class="btn btn-danger" href="<?= BASE_URL . 'admin/howitworks/delete/' . $BlogsData['id'] ?>"
                              onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o"
                                aria-hidden="true"></i></a>
                          </div>
                        </td>
                      </tr>
                    <?php } ?> <?php } ?>
                </tbody>
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

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Ritz Media World - Best Advertising and Marketing Agency</title>
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
                <class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Web Story</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="<?= BASE_URL ?>admin/dashboard">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Web Story</li>
                        </ol>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading p-3">
                                    <div class="col-md-6 p-3">
                                        Manage Web Stories
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-primary admin-buttns" data-toggle="modal"
                                            data-target="#exampleModalCenter" title="Add New Story">Add Story </a>
                                    </div>
                                </header>
                                <table id="myTable" class="table table-striped table-advance table-hover" id="example"
                                    class="display">
                                    <thead>
                                        <tr>
                                            <th>Image/Video</th>
                                            <th>Heading</th>
                                            <th>Description</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($webStory) > 0) {
                                            foreach ($webStory as $web) { ?>
                                                <tr>
                                                    <td>
                                                        <div style="width: 200px">
                                                            <img src="<?php echo BASE_URL; ?>webroot/images/webstory/<?php echo
                                                                   $web['file_url'] ?>" width="100%">
                                                        </div>
                                                    </td>
                                                    <td><?php echo $web['heading'] ?></td>
                                                    <td><?php echo $web['heading'] ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <i class="fa fa-pencil"></i>
                                                            <i class="fa fa-trash-o"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }

                                        } else { ?>
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="dataTables_empty">No records found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </section>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Web Story Content</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="modalForm">
                                        <!-- File Input for Image/Video -->
                                        <div class="form-group">
                                            <label for="mediaInput">Image/Video</label>
                                            <input type="file" class="form-control" id="mediaInput" name="mediaInput"
                                                accept="image/*,video/*">
                                        </div>

                                        <!-- Text Input for Heading -->
                                        <div class="form-group">
                                            <label for="headingInput">Heading</label>
                                            <input type="text" class="form-control" id="headingInput"
                                                name="headingInput" placeholder="Enter heading" required>
                                        </div>

                                        <!-- Textarea for Description -->
                                        <div class="form-group">
                                            <label for="descriptionInput">Description</label>
                                            <textarea class="form-control" id="descriptionInput" name="descriptionInput"
                                                rows="3" placeholder="Enter description" required></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save
                                        Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function saveChanges() {
                            // Collect form data
                            const media = document.getElementById('mediaInput').files[0];
                            const heading = document.getElementById('headingInput').value;
                            const description = document.getElementById('descriptionInput').value;
                            // validating fields
                            if (!media || !heading || !description) {
                                alert("Please fill in all fields.");
                                return;
                            }
                            // Prepare FormData to send the data
                            const formData = new FormData();
                            formData.append('media', media);
                            formData.append('heading', heading);
                            formData.append('description', description);
                            console.log();

                            // Make the AJAX call
                            $.ajax({
                                url: "<?php echo base_url('admin/admin/saveWebStory') ?>", // The PHP script that will handle the request
                                type: 'POST',
                                data: formData,
                                processData: false, // Don't process the data
                                contentType: false, // Don't set content-type header (for file upload)
                                success: function (response) {
                                    alert("Data saved successfully:");
                                    // Close the modal (if needed)
                                    $('#exampleModalCenter').modal('hide');
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error saving data:", error);
                                    alert("An error occurred while saving the data.");
                                }
                            });

                            // Close modal (if needed)
                            $('#exampleModalCenter').modal('hide');
                        }
                    </script>

                    <!-- project team & activity end -->
            </section>
        </section>
        <!--main content end-->
    </section>
    <!-- container section start -->

    <?php $this->load->view("Element/admin/footer.php"); ?>

</body>

</html>
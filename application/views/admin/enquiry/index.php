<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Enquiry</title>
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
                        <h3 class="page-header"><i class="fa fa-laptop"></i> Contact Enquiry</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="<?= BASE_URL ?>admin/dashboard">Home</a></li>
                            <li><i class="fa fa-laptop"></i>Manage Enquiry</li>
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
                                Manage Enquiry
                                <button onclick="exportToExcel('myTable')" style="float:right;border-radius:10px;">Export to Excel</button>
                                <br>
                                <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                                <div class="col-md-12"></div>
                            </header>
                            <table id="myTable" class="table table-striped table-advance table-hover">
                                <?php if (count($Gallery) > 0) { ?>
                                    <thead>
                                        <tr>
                                            <th>Etype</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Message</th>
                                            <th>Send Date</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Etype</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Message</th>
                                            <th>Send Date</th>
                                            <th> Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($Gallery as $GalleryData) { ?>
                                            <tr>
                                                <td><?= $GalleryData['etype']; ?> </td>
                                                <td><?= $GalleryData['name']; ?> </td>
                                                <td><?= $GalleryData['email']; ?> </td>
                                                <td><?= $GalleryData['contact_number']; ?> </td>
                                                <td><?= $GalleryData['message']; ?> </td>
                                                <td><?= date("d M, Y", strtotime($GalleryData['add_date'])); ?> </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-danger"
                                                            href="<?= BASE_URL . 'admin/enquiry/delete/' . $GalleryData['id'] ?>"
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
                                            <td valign="top" colspan="4" class="dataTables_empty">No records found</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        })

        function exportToExcel(tableID){
            // Get the DataTable instance
            var table = $('#myTable').DataTable();
            
            // Temporarily disable pagination and redraw the table
            table.page.len(-1).draw();

            // Get the table element (with all data visible)
            var tableElement = document.getElementById(tableID);
            var workbook = XLSX.utils.table_to_book(tableElement, { sheet: "Sheet 1" });

            // Create the Excel file and trigger download
            XLSX.writeFile(workbook, 'enquiry_data.xlsx');

            // Restore the pagination and redraw the table
            table.page.len(10).draw();
        }
    </script>
</body>

</html>
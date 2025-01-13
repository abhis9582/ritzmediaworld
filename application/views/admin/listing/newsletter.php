<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
<meta name="author" content="GeeksLabs">
<meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
<link rel="shortcut icon" href="img/favicon.png">
<title>Manage Newsletter</title>
<?php $this->load->view("Element/admin/header_common.php");?>
</head>

<body>
<!-- container section start -->
<section id="container" class="">
  <?php $this->load->view("Element/admin/header.php");?>
  
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper"> 
      <!--overview start-->
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i> Manage Newsletter</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
            <li><i class="fa fa-laptop"></i>Manage Newsletter</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
  ?>
            <header class="panel-heading"> Manage Newsletter <br>
              <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
              <div class="col-md-10"> </div>
              
            </header>
            <table id="myTable" class="table table-striped table-advance table-hover">
              <?php if(count($NewsLetter) > 0) { ?>
              <thead>
                <tr>
                  <th>Email</th> 
                  <th>Add Date</th>
				   <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Email</th> 
                  <th>Add Date</th>
                  <th>Action</th>
				  
                </tr>
              </tfoot>
              <tbody>
                <?php  foreach($NewsLetter as $ContentData) { 
							  ?>
                <tr>
                  <td><?=$ContentData['email'];?></td>
                  <td><?=date("d/ m/ Y",strtotime($ContentData['date_added']));?></td> 
				  <td><div class="btn-group">
				
				<a class="btn btn-danger" onclick="return confirm('Are You Sure to Delete ?');" href="<?=BASE_URL.'admin/listing/delete_email/'.$ContentData['id']?>" ><i class="icon_check_alt2"></i></a> 
				</div></td>
                </tr>
                <?php } ?>
                <?php } else{  ?>
              <tbody>
                <tr class="odd">
                  <td valign="top" colspan="6" class="dataTables_empty">No records found</td>
                </tr>
              </tbody>
              <?php } ?>
                </tbody>
              
            </table>
          </section>
        </div>
      </div>
      
      <!-- project team & activity end --> 
      
    </section>
    <?php $this->load->view("Element/admin/footer_common.php");?>
  </section>
  <!--main content end--> 
</section>
<!-- container section start -->

<?php $this->load->view("Element/admin/footer.php");?>
<script>
function redirect(url){
window.location.href= url ;

}
</script> 
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Client</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Client</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Client</li>						  	
					</ol>
				</div>
			</div>
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                      <?php
  if(validation_errors())
  echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
  if($this->session->flashdata("error")){ 
      echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata("error").'</div>';}
  else if($this->session->flashdata("success")){ 
      echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata("success").'</div>';}
  if(isset($_SESSION['error'])){
      unset($_SESSION['error']);
  }
  else if(isset($_SESSION['success'])){
      unset($_SESSION['success']);
  }
  ?>
  <header class="panel-heading">
                            Manage Client 
						<br>
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
							<div class="col-md-12">		
								<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns " href="<?=BASE_URL?>admin/client/add" title="Add client">Add client </a>
								
                            </div>
                          </header>
                         
                          <table id="myTable" class="table table-striped table-advance table-hover">
                        
						   <?php if(count($Client) > 0) { ?>
                              <thead>  <tr>
                                 <th>Image Name</th>
                                 <th>Client Name </th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
						  <tr>
                                 <th>Image Name</th>
                                 <th>Client Name </th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>   
                              <?php foreach($Client as $GalleryData) { ?>
                              <tr>
                                 <td><?php  $src = $this->image->getImageSrc("gallery",$GalleryData['image_name'],"");?>
                                           <img src="<?=$src?>" style="width:110px;"/> </td>
                                 <td><?=substr($GalleryData['image_tittle'],0,80);?> </td>

                                 <td><?=($GalleryData['status']==1)?'Active':'Archive';?></td>
                                 <td>
                                  <div class="btn-group">
								  
                                      <a class="btn btn-info" href="<?=BASE_URL.'admin/client/edit/'.$GalleryData['id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								  
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/client/delete/'.$GalleryData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								  
                                 </div>
                                  </td>
                              </tr>  
								 <?php } ?>							  
						  						  
						     </tbody>
							 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No records found</td></tr></tbody>
						   <?php } ?>	
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
<script>
function redirect(url){
window.location.href= url ;

}
</script>
 <?php $this->load->view("Element/admin/footer.php");?>
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
  </body>
</html>

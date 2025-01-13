<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Categories</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Categories</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Categories</li>						  	
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
                            Manage Categories  
							<br>
							  <?php if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'6','13')){ ?>
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary" href="<?=BASE_URL?>admin/othercategories/add" title="Add New Category">Add New Category </a>
							  <?php } ?>
                          </header>
                          
                          <table id="myTable" class="table table-striped table-advance table-hover">
                        
						   <?php if(count($Blog_Categories) > 0) { ?>
                               <thead>  <tr>
                                 <th>Category Name</th>
                                 <th>Category Description</th>
                                
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
							  <tr>
                                 <th>Category Name</th>
                                 <th>Category Description</th>
                               
								
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>  
                              <?php  foreach($Blog_Categories as $BlogCatData) { ?>
                              <tr>
                                 <td><?=Ucfirst($BlogCatData['category_name']);?> </td>
                                 <td><?=substr($BlogCatData['category_description'],0,250);?> </td>
                               
                              
                                 <td><?=($BlogCatData['status']==1)?'Active':'Archive';?></td>
                               
                                 <td>
                                  <div class="btn-group">
								    <?php if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'6','15')){ ?>
                                      <a class="btn btn-success" href="<?=BASE_URL.'admin/othercategories/edit/'.$BlogCatData['id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="icon_check_alt2"></i></a>
									<?php }  if($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'),'6','14')){ ?>
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/othercategory/delete/'.$BlogCatData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="icon_close_alt2"></i></a>
									<?php } ?>
                                  </div>
                                  </td>
                              </tr>  
							  <?php } ?>							  
						  						  
						     </tbody>
							 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No records found</td></tr></tbody>
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

 <?php $this->load->view("Element/admin/footer.php");?>
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
  </body>
</html>

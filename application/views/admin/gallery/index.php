<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Image</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Image</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Image</li>						  	
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
                            Manage Image  
						<br>
								<?php
								$this->db->select("*");
								$this->db->from('bh_support_listings');	

								$this->db->order_by("status","1");
								$this->db->order_by("listing_title","asc");

								$query=$this->db->get();
								$all_data =  $query->result_array(); 

								
								?>
                                     
<script>
function changecat(id){
	window.location.href='<?=BASE_URL?>admin/gallery/category/'+id;
}
</script>
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
							<div class="col-md-6">		
							Category
							<select name="category_id" id="category_id" onchange="changecat(this.value);" class=" col-md-6 form-control">
										  <option value="1000" <?=('1000'==$category_id)?'selected':''?>>Home Page Middle Image</option>
										  
										  <option value="1001" <?=('1001'==$category_id)?'selected':''?>>Brand Image</option>
										  <option value="1002" <?=('1002'==$category_id)?'selected':''?>>What We Offer</option>
										  <option value="1003" <?=('1003'==$category_id)?'selected':''?> >Wedding Page</option>
										  <option value="1004" <?=('1004'==$category_id)?'selected':''?> >Event Page</option>
										  
										  </select>
								<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns " href="<?=BASE_URL?>admin/gallery/add" title="Add New Image">Add Image </a>
							
                            </div>
                          </header>
                         
                          <table id="myTable" class="table table-striped table-advance table-hover">
                        
						   <?php if(count($Gallery) > 0) { ?>
                              <thead>  <tr>
                                 <th>Image Name</th>
                                 <th>Image Title </th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
							       </thead>
							   <tfoot>
						  <tr>
                                 <th>Image Name</th>
                                 <th>Image Title </th>
                                 <th> Status</th>
                                 <th> Action</th>
                              </tr>
								</tfoot>
								<tbody>   
                              <?php  foreach($Gallery as $GalleryData) { ?>
                              <tr>
                                 <td><?php  $src = $this->image->getImageSrc("gallery",$GalleryData['image_name'],"");?>
                                           <img src="<?=$src?>" style="width:110px;"/> </td>
                                 <td><?=substr($GalleryData['image_tittle'],0,80);?> </td>

                                 <td><?=($GalleryData['status']==1)?'Active':'Archive';?></td>
                                 <td>
                                  <div class="btn-group">
								   
                                      <a class="btn btn-info" href="<?=BASE_URL.'admin/gallery/edit/'.$GalleryData['id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								
                                      <a class="btn btn-danger" href="<?=BASE_URL.'admin/gallery/delete/'.$GalleryData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								  
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit FAQ</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit FAQ</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/howitworks">FAQ</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($BlogsData[0]['title'])!='')?$BlogsData[0]['title']:''?></li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit FAQ
                          </header>
                          <div class="panel-body">
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/howitworks/edit/'.$BlogsData[0]['id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$BlogsData[0]['id']?>" />
							  <input id="id" name="category_id" type="hidden" value="2" />
                                  
								   <div class="form-group">
                                      <label class="col-sm-2 control-label"> Title</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="title" id="title" value="<?=(isset($BlogsData[0]['title'])!='')?$BlogsData[0]['title']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group" style="display:none;">
                                      <label class="col-sm-2 control-label">Image </label>
                                      <div class="col-sm-6">
                                          <input type="file" name="howitworks_image1" id="howitworks_image1" class="form-control"> 
										  <br>
										   <span> Max Image Size: 250 * 250 px </span>
										  <br>
										   <?php   $imagename=$BlogsData[0]['howitworks_image1'];
	      $imgpath=$this->image->GetImageDirectory('blogs',$imagename);
		 if($imagename!="" && file_exists($imgpath."/".$imagename)==true){ ?>
			 <img src="<?=BASE_URL?><?=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg"?>" style="width:110px;"/>   
		<?php 
		} 
		?>
                                      </div>
                                  </div>
								  
								    <div class="form-group" style="display:none;">
                                      <label class="col-sm-2 control-label">Youtube Video Url</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="youtube_video" id="youtube_video" value="<?=(isset($BlogsData[0]['youtube_video'])!='')?$BlogsData[0]['youtube_video']:''?>" class="form-control">
                                      </div>
                                  </div>
								  
								<div class="form-group">
                                      <label class="col-sm-2 control-label">Description</label>
                                      <div class="col-sm-6">
                                          <textarea name="description" id="description" value="" class="form-control ckeditor"><?=(isset($BlogsData[0]['description'])!='')?stripslashes($BlogsData[0]['description']):''?></textarea>
                                      </div>
                                  </div>
								 
								 
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1" <?=($BlogsData[0]['status']==1)?'selected="selected"':''?> >Active</option>
									 <option value="0" <?=($BlogsData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  
								  
								  <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4" >
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Update</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
                                          </div>
                                      </div>
								  
                              </form>
                          </div>
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
 
  <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
  </body>
</html>

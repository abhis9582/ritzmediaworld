<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Our Team</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Our Team</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/ourteam">Our Team</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($ClientsData[0]['image_tittle'])!='')?$ClientsData[0]['image_tittle']:''?></li>						  	
					</ol>
				</div>
			</div>
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Our Team
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/ourteam/edit/'.$ClientsData[0]['id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$ClientsData[0]['id']?>" />
                                  
								  
								 
								     <div class="form-group">
                                      <label class="col-sm-2 control-label">Category</label>
                                      <div class="col-sm-6">
                                         <select name="category_id">
										 <option value="1" <?=($ClientsData[0]['category_id']==1)?'selected':'';?>>Board Of Director</option>
										 <option value="2" <?=($ClientsData[0]['category_id']==2)?'selected':'';?>>Advisory Panel</option>
										 <option value="3" <?=($ClientsData[0]['category_id']==3)?'selected':'';?>>Operations Team</option>
										 </select>
										 </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Name</label>
                                      <div class="col-sm-6">
                                          <input type="text" name="image_tittle" id="image_tittle" value="<?=(isset($ClientsData[0]['image_tittle'])!='')?$ClientsData[0]['image_tittle']:''?>" class="form-control">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Image</label>
                                      <div class="col-sm-6">
                                          <input type="file" name="image_name" id="image_name" class="form-control"> <br>
										   <?php  $src = $this->image->getImageSrc("gallery",$ClientsData[0]['image_name'],"");?>
                                           <img src="<?=$src?>" style="width:110px;"/> 
                                      </div>
                                  </div>
                                  
                                  <div class="form-group" style="">
                                      <label class="col-sm-2 control-label">Position</label>
                                      <div class="col-sm-6">
                                      <input type="text" class="form-control" name="banner_description" id="image_tittle" value="
                                      <?=(isset($ClientsData[0]['banner_description'])!='')?trim($ClientsData[0]['banner_description']):''?>">
                                      
                                          
                                      </div>
                                  </div>
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1" <?=($ClientsData[0]['status']==1)?'selected="selected"':''?> >Active</option>
									 <option value="0" <?=($ClientsData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									
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
 
 <script>
 $(window).load(function (){
	 show_state(<?=$BlogCatData[0]['country'];?>,<?=$BlogCatData[0]['state'];?>);
	 show_city(<?=$BlogCatData[0]['state'];?>,<?=$BlogCatData[0]['city'];?>);
 });
      function show_state(country,current_id){ 
       
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country ,'current_id':current_id },
		  dataType: 'json',
           success: function(data2){
           
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state,current_id) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('admin/user/show_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id },
		  dataType: 'json',
           success: function(data){
           
           $("#city").html(data);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
    
 </script>
  <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
  </body>
</html>

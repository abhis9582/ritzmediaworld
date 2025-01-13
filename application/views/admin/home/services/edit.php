<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Service</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Service</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/services">Services</a></li>						  	
					</ol>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Service<br>
                            <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/home/services" title="Back">Back</a>
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
                <form class="form-horizontal" action="<?=BASE_URL.'admin/home/edit_service/'.$ServiceData[0]['id'];?>" method="post" enctype="multipart/form-data">
                <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                <input id="id" name="id" type="hidden" value="<?=$ServiceData[0]['id']?>" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Service Title</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" id="title" value="<?=(isset($ServiceData[0]['service_title'])!='')?$ServiceData[0]['service_title']:''?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Service Image </label>
                        <div class="col-sm-6">
                            <input type="file" name="service_image1" id="service_image1" class="form-control"> <br>
                            <?php 
                            $imagename=$ServiceData[0]['service_image'];
                            $imgpath=$this->image->GetImageDirectory('services',$imagename);
                            if($imagename!="" && file_exists($imgpath."/".$imagename)==true){ ?>
                            <img src="<?=BASE_URL?><?=($imagename)?$imgpath.'/'.$imagename:"webroot/images/rap_temp.jpg"?>" style="width:110px;"/>   
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Service Description</label>
                        <div class="col-sm-6">
                            <textarea name="description" id="description" value="" class="form-control ckeditor"><?=(isset($ServiceData[0]['description'])!='')?stripslashes($ServiceData[0]['description']):''?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4" >
                            <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Update</button>
                            <button onclick="window.location.href='<?=BASE_URL?>admin/home'" class="btn btn-default" type="button">Cancel</button>
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

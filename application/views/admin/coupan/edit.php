<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Coupan</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Coupan</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i> <a href="<?=BASE_URL?>admin/coupan">Coupan</a></li>						  	
						<li><i class="fa fa-laptop"></i> <?=(isset($GalleryData[0]['coupan_code'])!='')?$GalleryData[0]['coupan_code']:''?></li>						  	
					</ol>
				</div>
			</div>
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Coupan Code
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
                              <form class="form-horizontal" action="<?=BASE_URL.'admin/coupan/edit/'.$GalleryData[0]['coupan_id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="coupan_id" type="hidden" value="<?=$GalleryData[0]['coupan_id']?>" />
                                  
								      </div>
                                  </div>
								 
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Coupan Code </label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="coupon_code" size="40" value="<?php echo set_value('coupon_code',$GalleryData[0]['coupon_code']);?>"> 
                                      </div>
                                  </div>
								  
								  
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Coupan Type</label>
                                      <div class="col-sm-6">
                                          <select class="form-control" name="coupon_type">

        <option value="">Coupon Type</option>

        <option value="p" <?php echo set_value('coupon_type',$GalleryData[0]['coupon_type']) ==='p' ? 'selected="selected"' : '';?>>Percentage</option>

        <option value="a" <?php echo set_value('coupon_type',$GalleryData[0]['coupon_type']) ==='a' ? 'selected="selected"' : '';?>>Amount</option>

       </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Coupan Discount </label>
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control" name="coupon_discount" size="40" value="<?php echo set_value('coupon_discount',$GalleryData[0]['coupon_discount']);?>"> <br>[Ex : Percentage: 5, Amount: 120.00 ]
                                      </div>
                                  </div>
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Minimum order amount </label>
                                      <div class="col-sm-6">
                                         <input type="text" name="minimum_order_amount" class="form-control" value="<?php echo set_value('minimum_order_amount',$GalleryData[0]['minimum_order_amount']);?>" /> <br>[Ex : Amount: 1520.00 ]
                                      </div>
                                  </div>
								  
								  
								    <div class="form-group" style="display:none;">
                                      <label class="col-sm-2 control-label">Coupan Usage </label>
                                      <div class="col-sm-6">
                                          <input type="radio" name="coupon_usage" value="single" <?php if($GalleryData[0]['coupon_usage'] == "single"){?> checked="checked" <?php }?> /> Single &nbsp;

        <input type="radio" name="coupon_usage" value="multiple" <?php if($GalleryData[0]['coupon_usage'] == "multiple"){?> checked="checked" <?php }?> /> Multiple
                                      </div>
                                  </div>
								  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Start Date </label>
                                      <div class="col-sm-6">
                                         <input name="start_date"  type="text" class="form-control datepicker" value="<?php echo set_value('start_date',$GalleryData[0]['coupon_discount']);?>">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-2 control-label">End Date </label>
                                      <div class="col-sm-6">
                                         <input name="end_date"  type="text" class="form-control datepicker" value="<?php echo set_value('end_date',$GalleryData[0]['end_date']);?>">
                                      </div>
                                  </div>
                                  
                                  
								    <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-6" >
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="1" <?=($GalleryData[0]['status']==1)?'selected="selected"':''?> >Active</option>
									 <option value="0" <?=($GalleryData[0]['status']==0)?'selected="selected"':''?>>In-active</option>
									
									 </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4" >
                                              <button class="btn btn-primary" name="submitForm" type="submit">Update</button>
                                              <button class="btn btn-default"  onclick="window.location.href='<?=BASE_URL?>admin/gallery'" type="button">Cancel</button>
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Edit Hotel Pay</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Hotel Pay</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Edit Hotel Pay</li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                       Edit Hotel Pay
							<br>
							<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/listing_hotel_pay/<?=$listing_id?>" title="Back">Back</a>
                          </header>
                          <div class="panel-body">
				     
					 <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 
		  

 
  <div class="col-lg-6">
		
				
			<form method="post" action="<?=BASE_URL.'admin/listing/edit_hotel_pay/'.$id.'/'.$listing_id?>" class="form-horizontal" role="form" enctype="multipart/form-data">
			<input id="SaveStatus" name="submitF" type="hidden" value="1" />
				
			
			
			 
			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Start Date</label>
			<div class="col-md-9">
			<input class="form-control datepicker"  autocomplete="off" value="<?=(isset($listingpay[0]['start_date'])!='')?$listingpay[0]['start_date']:''?>" name="start_date" value="" placeholder="Start Date">
			</div>
			</div>

			<div class="form-group">
			<label for="icode" class="col-md-3 control-label">End Date</label>
			<div class="col-md-9">
			<input class="form-control datepicker"  autocomplete="off"  value="<?=(isset($listingpay[0]['end_date'])!='')?$listingpay[0]['end_date']:''?>" name="end_date" value="" placeholder="End Date">
			</div>
			</div>	

<div class="form-group">
			<label for="icode" class="col-md-3 control-label">Status</label>
			<div class="col-md-9">
			<select name="status" class="form-control">
			<option value="1" <?=($listingpay[0]['status']=='1')?'selected':''?>>Active</option>
			<option value="0" <?=($listingpay[0]['status']=='0')?'selected':''?>>In-Active</option>
			</select>
			</div>
			</div>				
								
								
			
			 <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 text-center controls">
                                        <button type="submit" class="btn btn-default2">Submit</button>
                                    </div>
                                </div>
			</form>
			
		
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
	 show_state(<?=$SupportData[0]['country'];?>,<?=$SupportData[0]['state'];?>);
	 show_city(<?=$SupportData[0]['state'];?>,<?=$SupportData[0]['city'];?>);
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

  </body>
</html>

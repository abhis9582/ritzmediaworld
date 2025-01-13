<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Bhalaai">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>

<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>Edit Properties</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / Edit Properties</p>
</div>

</div>
</div><!--second-head-->












<div class="padding20px_leftright">
        
<div class="col-md-3">
  <br>
  <br>
  <?php $this->load->view("Element/front/myaccount-left.php");?>
  
</div> 
 
<div class="col-md-9">
  
  
  <div class="col-md-12 col-sm-12 col-xs-12">
  
  
  <!------------body--------->
				            
     
				<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>
				<div class="black_color_p">
                     <h3 class="mainHeadText padding10px_table"> Edit Properties </h3>
				<br>
                </div>
				
				
				
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                         
				<div class="col-sm-12 main-content" style="margin-top:20px; margin-bottom:20px;">
                
                <div class="panel panel-info">
                       

                    <div class="panel-body">
                   <?php
						   //print_r($BlogsData);
						   $listingData = $this->commonmod_model->GetSupportListingDetails($Bookingdata[0]['listing_id']);
						
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

 ?> 
                              <form class="form-horizontal" action="<?=BASE_URL.'user/booking_edit/'.$Bookingdata[0]['id'];?>" method="post" enctype="multipart/form-data">
							  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
							  <input id="id" name="id" type="hidden" value="<?=$Bookingdata[0]['id']?>" />
                                  
								  <div class="form-group">
                                      <b>&nbsp;&nbsp;&nbsp;Properties &nbsp; <?=$listingData[0]['listing_title']?></b>
                                  </div>
								  <div class="form-group">
                                     <hr>
                                  </div>
								 <div class="form-group">
                                   <label for="sel1" class="col-sm-12">Property Type</label>
                                  <div class="col-sm-12">
								 
								 
								
									  <select name="category_id" class="form-control">
									<?php 
									
									$allOthercat = $this->commonmod_model->getALLOthersChildCategories(); 
									if(count($allOthercat) > 0){
									
$all_supoort_ids = $this->commonmod_model->StringtoArray($listingData[0]['category_id']); ?>
									<option value="">Please Select</option>
                                           <?
									foreach($allOthercat as $allOthercatData){
										if(in_array($allOthercatData['id'],$all_supoort_ids)){
									?>
									
									<option value="<?=$allOthercatData['id']?>" <?php if(in_array($allOthercatData['id'],$all_supoort_ids)){ echo "selected"; } ?>><?=$allOthercatData['category_name']?> </option>
									<?php } }  } ?>
								
									</select>

                                     
                                </div>
                                </div>
                             
								 
								<div class="form-group">
                                      <label class="col-sm-12">Email Id</label>
                                      <div class="col-sm-12">
                                          <input type="text" name="email_id" id="email_id" value="<?=(isset($Bookingdata[0]['email_id'])!='')?$Bookingdata[0]['email_id']:''?>" class="form-control">
                                      </div>
                                  </div>
						
								  
								    <div class="form-group">
                                      <label class="col-sm-12">Contact Number</label>
                                      <div class="col-sm-12">
                                          <input type="text" name="mobile_number" id="mobile_number" value="<?=(isset($Bookingdata[0]['mobile_number'])!='')?$Bookingdata[0]['mobile_number']:''?>" class="form-control">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-12">Booking Date From</label>
                                      <div class="col-sm-12">
                                          <input type="text" name="booking_date_from" id="booking_date_from" value="<?=(isset($Bookingdata[0]['booking_date_from'])!='')?$Bookingdata[0]['booking_date_from']:''?>" class="form-control datepicker">
                                      </div>
                                  </div>
								   <div class="form-group">
                                      <label class="col-sm-12">Booking Date To</label>
                                      <div class="col-sm-12">
                                          <input type="text" name="booking_date_to" id="booking_date_to" value="<?=(isset($Bookingdata[0]['booking_date_to'])!='')?$Bookingdata[0]['booking_date_to']:''?>" class="form-control datepicker">
                                      </div>
                                  </div>
								  
								<div class="form-group">
                                      <label class="col-sm-12">Message</label>
                                      <div class="col-sm-12">
                                          <textarea name="comment" id="comment" value="" class="form-control ckeditor"><?=(isset($Bookingdata[0]['comment'])!='')?stripslashes($Bookingdata[0]['comment']):''?></textarea>
                                      </div>
                                  </div>
								 
								 
								    <div class="form-group">
                                      <label class="col-sm-12">Status</label>
                                      <div class="col-sm-12">
                                     <select name="status" class="form-control">
									 <option value="">Select Status</option>
									 <option value="Booked" <?=($Bookingdata[0]['status']=='Booked')?'selected="selected"':''?> >Booked</option>
									 <option value="Not Booked" <?=($Bookingdata[0]['status']=='Not Booked')?'selected="selected"':''?>>Not Booked</option>
									 <option value="Pending" <?=($Bookingdata[0]['status']=='Pending')?'selected="selected"':''?>>Pending</option>
									  <option value="Cancelled" <?=($Bookingdata[0]['status']=='Cancelled')?'selected="selected"':''?>>Cancelled</option>
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
                    </div>
                </div>	
 					  
                
			</div>
		
	 
  
  <!-------------close body------>
  
  </div>
  
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:100px;"></div> </div> 
</div>  
  
  
  
  
  
</div>






	
<?php $this->load->view("Element/front/footer.php");?>

 <script>
 $(window).load(function (){
	
	  show_state('<?=$listing[0]['country'];?>','<?=$listing[0]['state'];?>'); 
	
	 show_city('<?=$listing[0]['state'];?>','<?=$listing[0]['city'];?>');
 });
      function show_state(country,current_id2){ 
    
         if(country==""){ $("#state").prop("disabled",true); }else{ $("#state").prop("disabled",false); }
		 
        $.ajax({
			 url : "<?php echo base_url('user/show_state'); ?>",
          type: "POST",
          data: {'countryval': country ,'current_id':current_id2 },
		  dataType: 'json',
           success: function(data2){
         
           $("#state").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	    function show_city(state,current_id2) {
      
        if(state==""){ $("#city").prop("disabled",true); }else{ $("#city").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('user/show_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id2 },
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

<?php $this->load->view("Element/front/footer.php");?>
  <script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
<?php $this->load->view("Element/front/footer_common.php");?>

 
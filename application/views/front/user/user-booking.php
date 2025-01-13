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
<p>Property Booking</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / Property Booking</p>
</div>

</div>
</div><!--second-head-->










<div class="padding20px_leftright">
        
<div class="col-md-3 height5001">
  <br>
  <br>
  <?php $this->load->view("Element/front/myaccount-left.php");?>
  
</div> 
 
<div class="col-md-9">
  
  
  <div class="col-md-12 col-sm-12 col-xs-12">
  
  
  <!------------body--------->
				            
				
		<div class="table-responsive fontsize12 ">		
			
			
				<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>
				<div class="black_color_p col-md-8 col-sm-12 col-xs-12">
                     <h3 class="mainHeadText padding10px_table">Property Booking </h3>
				
                </div>
				<div class="col-md-4 col-sm-12 col-xs-12">
                     
					 <select name="agent_id" id="agent_id" class="form-control" ONCHANGE="redirect(this.value)">
								<option value="<?=BASE_URL?>admin/booking">Please Select</option>

								<option value="<?=BASE_URL?>user/booking_status/1" <?php if(@$status=='1'){ ?> selected <?php } ?>>Booked</option>
								
								<option value="<?=BASE_URL?>user/booking_status/3" <?php if(@$status=='3'){ ?> selected <?php } ?>>Pending</option>
								<option value="<?=BASE_URL?>user/booking_status/4" <?php if(@$status=='4'){ ?> selected <?php } ?>>Cancelled</option>


								</select>
					 
                </div>
				<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>	
				
				
              <section class="panel">
                          <?php
						 
						 
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

  
  ?> 
  <header class="panel-heading">
                            
                            <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
                               <div class="col-md-4" style=" margin-top: 8px; margin-bottom: 7px;">
								
									</div>	
						
						
                          </header>
                        
                          <table id="myTable" class="table table-striped table-advance table-hover">
                        
						   <?php if(count($Bookings) > 0) { ?>
                                <thead> <tr>
                                 <th width="20%">Listing</th>
                                 <th width="10%">Booked By</th>
                                 <th width="15%">Email</th>
								  <th width="15%">Contact No.</th>
                                 <th width="10%">Request Date</th>
                                 <th width="10%">Booking Date</th>
								 <th width="10%"> Status</th>
                                 <th width="10%"> Action</th>
                              </tr>
							     </thead>
							  
								<tbody>
                              <?php  foreach($Bookings as $BlogsData) { ?>
                                 <tr>
                                 <td style="width:20%"><?php $listingData = $this->commonmod_model->GetSupportListingDetails($BlogsData['listing_id']);
								 echo  $listingData[0]['listing_title']."<br>"; 
								 $categoryData =  $this->commonmod_model->GetListingCategoryByID($listingData[0]['category_id']);
								 echo  '<span class="">'.$categoryData[0]['category_name'].'</span>';
								 ?> </td>
                                 <td><?=$this->commonmod_model->GetUserName($BlogsData['booked_by']);?> </td>
								   <td><?=$BlogsData['email_id']?> </td>
								   <td><?=$BlogsData['mobile_number']?> </td>
                                 <td><?=date("d M,Y",strtotime($BlogsData['add_date']));?> </td>
                                 <td><?=date("d M,Y",strtotime($BlogsData['booking_date_from']));?> To <?=date("d M,Y",strtotime($BlogsData['booking_date_to']));?> </td>
                                
                                
                               
                                 <td><?=$BlogsData['status'];?></td>
                               
                                 <td>
                                  <div class="btn-group">
								
                                      <a class="btn btn-info" href="<?=BASE_URL.'user/booking_edit/'.$BlogsData['id']?>" onclick="return confirm('Are You Sure to Edit ?');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								 
                                      <?php /*<a class="btn btn-danger" href="<?=BASE_URL.'user/booking_delete/'.$BlogsData['id']?>" onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a> */ ?>
									
                                  </div>
                                  </td>
                              </tr>  
							  <?php } ?>							  
						     </tbody>
							 <?php } else{  ?>
						   <tbody>
								
                                                              
							                               <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No records found</td></tr></tbody>
						   <?php } ?>					
                        </table>
                      </section>
			
			
		</div>
	 
  
  <!-------------body close------>
  
  </div>
  
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:100px;"></div> </div> 
</div>  
  
  
  
  
  
</div>






<?php $this->load->view("Element/front/footer.php");?>
<script>
function redirect(url){
window.location.href= url ;

}
</script>
<?php $this->load->view("Element/front/footer_common.php");?>
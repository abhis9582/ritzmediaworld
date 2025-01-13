<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Bulk Room Upate</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Bulk Room Update</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Hotels</a></li>						  	
											  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                         Bulk Room Update (Hotel - <?=$listing[0]['listing_title']?>)
						<br>
						<a style="float:right;margin-bottom:10px;" class="btn btn-primary" href="<?=BASE_URL?>admin/listing/manage_inventory/<?=$listing_id?>" title="Back">Back</a>
						
                          </header>
                          <div class="panel-body">
						  
						  <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("success"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("success").'</div>';

if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

?> 
						 <form method="post" class="form-horizontal" action="<?=BASE_URL?>admin/listing/bulk_room_update/<?=$listing[0]['id']?>">
						<input type="hidden" name="updinvent" value="UpdInventory">
						
					<div class="col-md-12">
					<div class="form-group">
					<label for="icode" class="col-md-12 ravi_margin">Room Type</label>
					<div class="col-md-12 ravi_margin">

					<select required name="room_id" class="form-control">
					<option value="">Select Room Type</option>
					<?php foreach($Hotel_Category as $HotelCatFata){ ?> 


					<option value="<?=$HotelCatFata['id']?>" <?=($cmonth==$i)?'selected':''?>><?=$HotelCatFata['image_title']?></option>
					<?php } ?>
					</select>
					</div>
					</div>
					</div>
						
						<div class="col-md-12">
						   <div class="form-group">
                  <label for="icode" class="col-md-12 ravi_margin">Start Date</label>
                 <div class="col-md-12 ravi_margin">
						<input type="text" autocomplete="off" name="start_date" class="datepicker form-control">
						</div>
						</div>
						</div>
						<div class="col-md-12">
						   <div class="form-group">
                  <label for="icode" class="col-md-12 ravi_margin">End date</label>
                 <div class="col-md-12 ravi_margin">
						<input type="text" autocomplete="off" name="end_date" class="datepicker form-control">
						</div>
						</div>
						</div>
						<div class="col-md-12">
						   <div class="form-group" style="display:none;">
                  <label for="icode" class="col-md-12 ravi_margin">Total Rooms</label>
                 <div class="col-md-12 ravi_margin">
						<input type="text" name="current_rooms" class="form-control">
						</div>
						</div>
						</div>
						
						<div class="col-md-12">
						   <div class="form-group" style="display:block;">
                  <label for="icode" class="col-md-12 ravi_margin">Status</label>
                 <div class="col-md-12 ravi_margin">
						<select name="status" class="form-control">
						<option value="">Please Select</option>
						<option value="1">Active</option>
						<option value="0">In-active</option>
						</select>
						</div>
						</div>
						</div>
						
						
						
						<div class="col-md-12">
						<input type="submit" class="btn btn-primary" name="submit" value="Update">
						 &nbsp;&nbsp;
						
						
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
 
  </body>
</html>

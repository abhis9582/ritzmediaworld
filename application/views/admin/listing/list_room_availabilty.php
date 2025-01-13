<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>List Price By Date</title>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Inventory</h3>
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
                         Manage Inventory (Hotel - <?=$listing[0]['listing_title']?>)
						
						<form style="margin:10px 0; width:100%; float:left;" method="post" action="<?=BASE_URL?>admin/listing/manage_inventory/<?=$listing[0]['id']?>">
					
						<div class="col-md-2">
						<select name="cmonth" class="form-control">
						<?php for($i=1; $i<= 12; $i++){ 
						
						?>
						<option value="<?=$i?>" <?=($cmonth==$i)?'selected':''?>><?=getMonthName($i)?></option>
						<?php } ?>
						</select>
						</div>
						
						<div class="col-md-2">
						<select name="cyear" class="form-control">
						<?php for($i=2019; $i<= (date("Y")+1); $i++){ ?>
						<option value="<?=$i?>" <?=($cyear==$i)?'selected':''?>><?=$i?></option>
						<?php } ?>
						</select>
						</div>
						
						<div class="col-md-8">
						<input type="submit" class="btn btn-primary" name="submit" value="Search">
						 &nbsp;&nbsp;
						 
						 <a class="btn btn-primary" href="<?=BASE_URL?>admin/listing/bulk_inventory_update/<?=$listing_id?>" title="Back">Bulk Price Update</a>
						 &nbsp;&nbsp;
						  <a class="btn btn-primary" href="<?=BASE_URL?>admin/listing/bulk_room_update/<?=$listing_id?>" title="Back">Bulk Room Update</a>
						  &nbsp;&nbsp;
						<a class="btn btn-primary" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a>
						
						</div>
						</form>
						
                          </header>
                          <div class="panel-body">
						 
				     
					 <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

if($this->session->flashdata("success"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("success").'</div>';

?> 
		  
<?php

$CheckInventoryData = $this->listing_model->checkInventoryTableData($cmonth,$cyear,$listing_id);
if(count($CheckInventoryData)==0){ ?>
	Inventory Data not updated. Please update Inventory data.<a href="#hupdate">Click Here</a>
<?php	
}
?>
 
  <div class="col-lg-12 inventory">
		
	<form name="form1" method="post" action="<?=BASE_URL?>admin/listing/manage_inventory/<?=$listing[0]['id']?>">
			<table border="1" style="width:100%">
			<tr>
			<th>Date</th>
			<?php foreach($Hotel_Category as $HotelCatFata){ ?>
			<th><?=$HotelCatFata['image_title'];?>
			</th>
			<?php } ?>
			
			</tr>
			<?php $i=1;
$total_month_days = cal_days_in_month(CAL_GREGORIAN,$cmonth,$cyear);


			for($k = 1; $k <= $total_month_days;$k++){
				$cmonth2 = ($cmonth < 10)?$cmonth:$cmonth;
				$cday2 = ($k < 10)?'0'.$k:$k;
                $current_date = date($cyear."-".$cmonth2."-".$cday2);
                $current_date_display = date("d M,Y",strtotime($current_date));
				
			?>
			<tr>
			<td><?=$current_date_display?>
			<input type="hidden" name="room_date[<?=$k?>]" value="<?=$current_date?>">
			<input type="hidden" name="hotel_id[<?=$k?>]" value="<?=$listing[0]['id']?>">
			
			</td>
			
			<?php foreach($Hotel_Category as $HotelCatData){ 
			$InventoryData = $this->listing_model->GetInventoryTableData($current_date,$HotelCatData['id'],$HotelCatData['listing_id']);
			
			
			$current_rooms = (is_array($InventoryData))?$InventoryData['current_rooms']:$HotelCatData['total_rooms'];
			$price_sgl = (is_array($InventoryData))?$InventoryData['price1']:$HotelCatData['price1'];
			$price_dbl = (is_array($InventoryData))?$InventoryData['price2']:$HotelCatData['price2'];
			 $status = $InventoryData['status'];
			?>
			
			<td <?php echo ($status==0 || $current_rooms==0)?'style="color:white;background:red;"':''?>>
			
			<input type="hidden" name="room_id[<?=$k?>][<?=$HotelCatData['id']?>]" value="<?=$HotelCatData['id']?>">
			<label style="width:80px;">Rooms:</label><input style="width:100px;" type="text" name="total_rooms[<?=$k?>][<?=$HotelCatData['id']?>]" value="<?=$current_rooms?>"> <br>
			<label style="width:80px;">Price SGL:</label><input type="text" style="width:100px;" name="price_sgl[<?=$k?>][<?=$HotelCatData['id']?>]" value="<?=$price_sgl?>"> <br>
			<label style="width:80px;">Price DBL:</label><input type="text" style="width:100px;" name="price_dbl[<?=$k?>][<?=$HotelCatData['id']?>]" value="<?=$price_dbl?>">
			</td>
			<?php } ?>
			
			
			
			</tr>
		
		<?php $i++; } ?>
		</table>
		<div class="col-md-12" id="hupdate">
		<input type="hidden" value="<?=$cmonth?>" name="cmonth">
		<input type="hidden" value="<?=$cyear?>" name="cyear">
		<input type="hidden" value="UpdInventory" name="updinvent">
		<input type="submit" class="btn btn-primary" value="Update">
		</div>
		
		</form>
		
                           
                          </div>
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

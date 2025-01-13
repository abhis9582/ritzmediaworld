<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
<meta name="author" content="GeeksLabs">
<meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
<link rel="shortcut icon" href="img/favicon.png">
<title>Manage Order</title>
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
          <h3 class="page-header"><i class="fa fa-laptop"></i> Order Information </h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
            <li><i class="fa fa-laptop"></i> Order Information </li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
  ?>
            <header class="panel-heading">Order Information <br>
              <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/order" title="Back">Back</a>
			  
			   <a style="float:right;margin-bottom:10px; display:none;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/orderdetail_edit/<?=$order_id?>" title="Back">Edit Order</a>
			   
              <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
            </header>
            <h2>Order Information</h2>
            <table class="table table-bordered table-hover">
              <thead class="tableHead">
                <tr>
                  <td class="text-left" colspan="2"><b>Order Details</b></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td class="text-left" style="width: 50%;"><b>Order ID:</b>
                    #<?=$order_id?>
                    <br>
                    <b>Date Added:</b>
                    <?=date("d/ m/ Y",strtotime($Oneorder[0]['date_added']));?></td>
                    <td class="text-left" style="width: 50%;">
                    <?=$Oneorder[0]['payment_method']?>
                    <br>
					<b>Name: </b>
                    <?=$Oneorder[0]['firstname'];?>  <br>
                    <b>Email: </b>
                    <?=$Oneorder[0]['email'];?>
                    <br>
                    
                    <b>Mobile: </b>
                    <?=$Oneorder[0]['mobile'];?> <br><br>
					
					 <b>Start Date: </b>
                      <?=date("d M, Y H:i",strtotime($Oneorder[0]['start_date']));?>
                    <br>
					
					 <b>End Date: </b>
                    <?=date("d M, Y H:i",strtotime($Oneorder[0]['end_date']));?>
                    <br>
					
					 <b>Pay By: <?=$Oneorder[0]['pay_by'];?></b> <br>
			 <b>Payment ID: <?=$Oneorder[0]['payment_id'];?></b> <br>
			 <b>Payment Status: <?=$Oneorder[0]['payment_status'];?></b> <br>
			 <b>Payment Request ID: <?=$Oneorder[0]['payment_request_id'];?></b> 
					
					</td>
                  </td>
                </tr>
              </tbody>
            </table>
           
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                 <tr>
                  <td class="text-left"><b>Room</b></td>
                  <td class="text-right"><b>Price</b> <br></td>
                  <td class="text-right"><b>Adults</b></td>
                  <td class="text-right"><b>Children</b></td>
                  <td class="text-right"><b>Infant</b> <br></td>
                   <td class="text-right"><b>Total</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $grand_total = 0; foreach($AllorderproductList as $Allproducts) { 
				
				$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
				?>
             
			   
			   <tr>
                  <td class="text-left"><?=$Allproducts['name']?>
				     Hotel ID:#CTH.100<?=$Allproducts['product_id']?> <br>
				  Hotel Name: <?=$HotelData[0]['listing_title']?><br>
				  Room Type:<?=$Allproducts['name']?> <br>
                    <br></td>
             
                
                  <td class="text-right"><span class="WebRupee">
                    <?=CURRENCY?>
                    &nbsp;</span>
                    <?=number_format($Allproducts['price'],2)?> <br>
					  
					
					</td>
					
					 <td class="text-left"><?=$Allproducts['adults']?></td>
					 <td class="text-left"><?=$Allproducts['children']?></td>
					 <td class="text-left"><?=$Allproducts['infant']?></td>
                 
				  
                  <td class="text-right"><span class="WebRupee">
                    <?=CURRENCY?>
                    &nbsp;</span>
                     <?=number_format((($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']))+($Allproducts['quantity']*($Allproducts['total']-$Allproducts['discount_price']))),2)?>
						</td>
                </tr>
				
				
				<?php for($i=1;$i<=$Allproducts['adults'];$i++){ ?>
        				<tr><td>Guest <?=$i?>: </td><td colspan="5"><?=$Allproducts['adults_name'.$i]?></td></tr>
        				<?php } ?>
						<?php for($i=1;$i<=$Allproducts['children'];$i++){ ?>
        				<tr><td>Children <?=$i?>: </td><td colspan="5"><?=$Allproducts['children_name'.$i]?></td></tr>
        				<?php } ?>
			  
				
				
                <?php $grand_total = $grand_total + ($Allproducts['quantity']*($Allproducts['total']-$Allproducts['discount_price']));?>
                <?php $grand_deposite = $grand_deposite + ($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']));?>
                  
                <!--<tr>
             
              <td class="text-right"><b>Sub-Total</b></td>
              <td class="text-right"><span class="WebRupee"><?=CURRENCY?></span><?=$Allproducts['total']?></td>
              <td></td>
            </tr>-->
                
                <?php  }
				
				?>
              </tbody>
              <tfoot>
			  <tr>
                  <td colspan="4"></td>
                  <td class="text-right"><b>Sub Total</b></td>
                  <td class="text-right"><?=CURRENCY?>
                    <?php echo number_format($Oneorder[0]['sub_total'],2); ?></td>
                </tr>
				 <tr>
                  <td colspan="4"></td>
                  <td class="text-right"><b>Tax</b></td>
                  <td class="text-right"><?=CURRENCY?>
                    <?php echo number_format($Oneorder[0]['tax'],2); ?></td>
                </tr>
				<?php if($Oneorder[0]['coupon_code']!=""){ ?>	
 <tr>
                  <td colspan="4"></td>
                  <td class="text-right"><b>Coupon Applied (<?=$Oneorder[0]['coupon_code']?>):</b></td>
                        
                          <td class="text-right"><?=CURRENCY?>
                            <?php echo number_format($Oneorder[0]['discount_amount'],2); ?></td>
                        </tr>
					<?php } ?>
                <tr>
                  <td colspan="4"></td>
                  <td class="text-right"><b>Total</b></td>
                  <td class="text-right"><?=CURRENCY?>
                    <?php echo number_format($Oneorder[0]['total'],2); ?></td>
                </tr>
              </tfoot>
            </table>
            <h3>Order History</h3>
            <table class="table table-bordered table-hover">
				<thead>
				<tr>
				<td class="text-left"><b>Date Added</b></td>
				<td class="text-left"><b>Comment</b></td>
				<td class="text-left"><b>Attachement</b></td>
				
				</tr>
				</thead>
              <tbody>
              <?php  foreach($AllOrderlist as $Showorder) { 
							  ?>
                <tr>
                  <td class="text-left"><?=date("d/ m/ Y h:i A",strtotime(@$Showorder['date_added']));?> <br>
				  <?=$Showorder['subject']?> 
				 <br> Status: <?=$this->commonmod_model->GetOrderStatusType($Showorder['order_status_id'])?>
				  </td>
                
                  <td class="text-left"> <?=$Showorder['comment']?>  </td>
                  
                  <td class="text-left"> 
				  <?php if($Showorder['image']!="") { 
				  $src = $this->image->getImageSrc("listings",$Showorder['image'],""); ?>
				  <img src="<?=$src;?>" style="width:10%;">
				  <br>
				  <a href="<?=$src;?>" target="_blank">download</a>
				 <?php 
				 }
				  ?>
				  
				  </td>
                </tr>
                
                <?php } ?>
              </tbody>
            </table>
            <?php
						
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';

 ?>
            <fieldset>
              <h3>Add Order History</h3>
              <form class="form-horizontal" action="<?=BASE_URL.'admin/listing/orderdetail/'.$order_id;?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input id="SaveStatus" name="submitF" type="hidden" value="1" />
                  <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
                  <div class="col-sm-10">
                   
                    <select name="order_status_id" id="input-order-status" class="form-control">
                    <option value="">Please Select</option>
                    <?php  foreach($this->commonmod_model->GetAllOrderStatus() as $key=>$value) { ?>
					
					<option value="<?=$key;?>"><?=$value;?></option>
					
					<?php
					}
					?>
                      
                     
                    </select>
                  </div>
                </div>
				
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-notify">Subject</label>
				<div class="col-sm-10">
				<input type="text" name="subject" required value=""  class="form-control" id="subject">
				</div>
				</div>
                
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-notify">Notify Customer</label>
				<div class="col-sm-10">
				<input type="checkbox" name="notify" value="1" id="input-notify">
				</div>
				</div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-comment">Comment</label>
                  <div class="col-sm-10">
                    <textarea name="comment" rows="8" id="input-comment" class="form-control"><?=(isset($_POST['comment'])!='')?$_POST['comment']:''?></textarea>
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-2 control-label" for="input-comment">Attachment</label>
                  <div class="col-sm-10">
                    <input type="file" name="image" rows="8" id="input-image" class="form-control">
                  </div>
                </div>
				
                <div class="form-group">
                  <div class="col-md-offset-4 col-md-4">
                    <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                    <button class="btn btn-default" type="button">Cancel</button>
                  </div>
                </div>
              </form>
            </fieldset>
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
function redirect(url){
window.location.href= url ;

}
</script> 
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>

<section class="aboutus-section1">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1><?=$Content[0]['page_heading']?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Order Information</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactus-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="user_left_area">  
            	    <?php $this->load->view("Element/front/myaccount-left.php");?>
            	</div>
            </div>
            <div class="col-lg-9">
                <div class="user_right_area">
                    <h3 class="right_heading">Order Information
                        <a class="hotel_edit_add" onclick="window.location.href='<?=BASE_URL?>user/order'">Back</a>
                    </h3>
                        <div class="booking_his"> 
                            <table> 
                                <tr>
                                    <td>Order ID:</td>
                                    <td><?=$AllorderproductList[0]['order_id']?></td>
                                </tr>
                                <tr>
                                    <td>Date Added:</td>
                                    <td><?=date("d/ m/ Y",strtotime($Oneorder[0]['date_added']));?></td>
                                </tr>
                             
                                <tr>
                                    <td>Name:</td>
                                    <td><?=$Oneorder[0]['firstname'];?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?=$Oneorder[0]['email'];?></td>
                                </tr>
                                <tr>
                                    <td>Telephone:</td>
                                    <td><?=$Oneorder[0]['telephone'];?></td>
                                </tr>
                                <tr>
                                    <td>Mobile:</td>
                                    <td><?=$Oneorder[0]['mobile'];?></td>
                                </tr>
                                <tr>
                                    <td>Start Date:</td>
                                    <td><?=date("d M, Y H:i",strtotime($Oneorder[0]['start_date']));?></td>
                                </tr>
                                <tr>
                                    <td>End Date:</td>
                                    <td><?=date("d M, Y H:i",strtotime($Oneorder[0]['end_date']));?></td>
                                </tr>
                                <tr>
                                    <td>Pay By:</td>
                                    <td><?=$Oneorder[0]['pay_by'];?></b> <br>
        					<?php if($Oneorder[0]['payment_id']!=0){ ?></td>
                                </tr>
                                <tr>
                                    <td>Payment ID:</td>
                                    <td><?=$Oneorder[0]['payment_id'];?></b> <br>
        					<?php } if($Oneorder[0]['payment_status']!=0){ ?></td>
                                </tr>
                                <tr>
                                    <td>Payment Status:</td>
                                    <td><?=$Oneorder[0]['payment_status'];?></b> <br>
        					<?php } if($Oneorder[0]['payment_request_id']!=0){ ?></td>
                                </tr>
                                <tr>
                                    <td>Payment Request ID:</td>
                                    <td><?=$Oneorder[0]['payment_request_id'];?></b> 
        					<?php } ?></td>
                                </tr>
                            </table>
                        </div>
                    <div class="booking_his">
                        <h3>Order Details</h3>
                     <table> 
                        <tr>
                          <th>ID</th>
                          <th>Hotel Name</th>
                          <th>Room Type</th>
                          <th>Price</th>
                          <th>Adults</th>
                          <th>Children</th>
                          <th>Infant</th>
                          <th>Total</th>
                        </tr> 
                        <?php $grand_total = 0; foreach($AllorderproductList as $Allproducts) {
        					
        					
        					
        					$HotelData = $this->listing_model->GetSupportListingByID($Allproducts['product_id']);
        
        				?>
                     
        			   
        			    <tr>
        			        
        			        <td><?=$Allproducts['product_id']?></td>
        			        <td><?=$HotelData[0]['listing_title']?></td>
        			        <td><?=$Allproducts['name']?></td>
        			        <td><span class="WebRupee"><?=CURRENCY?>&nbsp;</span><?=number_format($Allproducts['price'],2)?></td>
        					<td><?=$Allproducts['adults']?></td>
        					<td><?=$Allproducts['children']?></td>
        					<td><?=$Allproducts['infant']?></td>
        					<td><span class="WebRupee">
                            <?=CURRENCY?>
                            &nbsp;</span>
                             <?=number_format((($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']))+($Allproducts['quantity']*($Allproducts['total']-$Allproducts['discount_price']))),2)?>
        						</td>
                        </tr>
        				
        				<?php for($i=1;$i<=$Allproducts['adults'];$i++){ ?>
        				<tr><td colspan="2">Guest <?=$i?>: </td><td colspan="6"><?=$Allproducts['adults_name'.$i]?></td></tr>
        				<?php } ?>
						<?php for($i=1;$i<=$Allproducts['children'];$i++){ ?>
        				<tr><td colspan="2">Children <?=$i?>: </td><td colspan="6"><?=$Allproducts['children_name'.$i]?></td></tr>
        				<?php } ?>
        				
        			
        				
        				
        			  
        				
        				
                        <?php $grand_total = $grand_total + ($Allproducts['quantity']*($Allproducts['total']-$Allproducts['discount_price']));?>
                        <?php $grand_deposite = $grand_deposite + ($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']));?>
                          
                        
                        
                        <?php  }
        				
        				?>
        				<tr><td colspan="8"></td></tr>
        				 <tr>
                          <th colspan="6"></th>
                          <th>Sub Total</th>
                          <th><?=CURRENCY?>
                            <?php echo number_format($Oneorder[0]['sub_total'],2); ?></th>
                       </tr>
        				 <tr>
        				     <th colspan="6"></th>
                          <th>Tax</th>
                          <th><?=CURRENCY?>
                            <?php echo number_format($Oneorder[0]['tax'],2); ?></th>
                        </tr>
						
					<?php if($Oneorder[0]['coupon_code']!=""){ ?>	
<tr>
        				     <th colspan="6"></th>
                          <th>Coupon Applied (<?=$Oneorder[0]['coupon_code']?>):</th>
                          <th><?=CURRENCY?>
                            <?php echo number_format($Oneorder[0]['discount_amount'],2); ?></th>
                        </tr>
					<?php } ?>
        				 <tr>
        				     <th colspan="6"></th>
                          <th>Total</td>
                          <th><?=CURRENCY?>
                            <?php echo number_format($Oneorder[0]['total'],2); ?></th>
                        </tr>
                    </table>
                    </div> 
                    <div class="booking_his"> 
                        <h3>Order History</h3> 
                        <table>
                			<tr>
                				<th>Date Added</th>
                				<th>Comment</th>
                				<th>Attachement</th>
                				
                				</tr> 
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
                				  <img src="<?=$src;?>" style="width:300px;height:250px;">
                				  <br>
                				  <a href="<?=$src;?>" target="_blank">Download</a>
                				 <?php 
                				 }
                				  ?>
                				  
                				  </td>
                                </tr>
                                
                                <?php } ?> 
              </table>  
                    </div>
      
                    
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>

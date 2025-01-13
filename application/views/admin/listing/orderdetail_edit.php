<!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="MyController as ctrl">
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
            <li><i class="fa fa-laptop"></i> Edit Order Information </li>
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
			   <a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/orderdetail/<?=$order_id?>" title="Back">View Order</a>
			   
              <div class="col-md-6" style="text-align: right; color: #000; line-height: 47px;"> </div>
            </header>
            <h2>Edit Order Information</h2>
		<form method="post" action="<?=BASE_URL.'admin/listing/orderdetail_edit/'.$order_id?>" id="" class="form-horizontal" role="form" enctype="multipart/form-data">

              <input id="SaveStatus" name="submitF" type="hidden" value="1" />

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
                    <b>Telephone: </b>
                    <?=$Oneorder[0]['telephone'];?>
                    <br>
                    <b>Mobile: </b>
                    <?=$Oneorder[0]['mobile'];?> <br><br>
					
					
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="icode" class="col-md-12 ravi_margin">Start Date</label>
                    <div class="col-md-12 ravi_margin">
                      <input type='text' class="form-control datepicker2" value="<?=date("d-m-Y",strtotime($Oneorder[0]['start_date']));?>"  name="start_date" id="start_date2"  
                      placeholder="Select Pick-Up Date and Time" autocomplete="off" />    
                    </div>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="icode" class="col-md-12 ravi_margin">End Date</label>
                    <div class="col-md-12 ravi_margin">
                      <input type='text' class="form-control datepicker2" value="<?=date("d-m-Y",strtotime($Oneorder[0]['end_date']));?>"  name="end_date" id="end_date2" 
                       placeholder="Select Pick-Up Date and Time" autocomplete="off" />     
                    </div>
                  </div>
              </div>
<?php 
					$now = strtotime($Oneorder[0]['end_date']); // or your date as well
					$your_date = strtotime($Oneorder[0]['start_date']);
					$datediff = $now - $your_date;

					$days =  round($datediff / (60 * 60 * 24));
					?>
              <div class="col-md-3 col-sm-3 col-xs-12 admin_ref_btn">
                <button type="button" class="btn_refresh" onclick="updateDate();" > Refresh Date </button>
                <div class="duaration">Duration : <span class="theme_color" id="noOfDays"><?=$days?> Days</span></div>
              </div>
            </div>			
					
			
					<?php if ($days < 0 || $days == 0){ ?>
					<div class="check_avilable"><span style="color:red;font-size: 15px;margin-top:10px;font-weight: normal;" id="err_msg">Please Select Start date. End Date Should be higher than start Date.</span></div>
					<?php } ?>

				
					 
					</td>
                  </td>
                </tr>
              </tbody>
            </table>
           
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left"><b>Room Name</b></td>
                  <td class="text-right"><b>Rent ( Per Room )</b></td>
                
				  
                  <td class="text-right"><b>Total</b></td>
                </tr>
              </thead>
              <tbody>
                <?php $grand_total = 0; $i=1; foreach($AllorderproductList as $Allproducts) { 
				
				
				 
					 
					  
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][id]', $Allproducts['order_product_id']);
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][order_id]', $Allproducts['order_id']);
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][product_id]', $Allproducts['product_id']);
						
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][name]', $Allproducts['name']);
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][price]', $Allproducts['price']);
						//echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
						echo form_hidden('cart['. $Allproducts['order_product_id'] .'][deposite]', $Allproducts['deposite']);
						
				
				
				
				?>
             
			   
			    <tr>
                  <td class="text-left"><?=$Allproducts['name']?>
                    <br></td>
             
               
                  <td class="text-right"><span class="WebRupee">
                    <?=CURRENCY?>
                    &nbsp;</span>
                    <?=number_format($Allproducts['price'],2)?>
					<br>
				  
					</td>
                   <td class="text-right">
				  </td>
				  
				     <td class="text-right">

        							<div class="input-group quantitybtn">
                      </div>
    							</td>
								
                  <td class="text-right">
				  <span class="WebRupee">
                    <?=CURRENCY?>
                    &nbsp;</span>
                    <?=number_format((($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']))+($Allproducts['quantity']*($Allproducts['price']-$Allproducts['discount_price']))),2)?>
						
							
					<a class="btn btn-danger" href="<?=BASE_URL?>admin/listing/removepro/<?=$order_id?>/<?=$Allproducts['order_product_id']?>"
							onclick="return confirm('Are You Sure to Delete ?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					
					</td>
					
				
                </tr>
				
			  
				
				
                <?php $grand_total = $grand_total + ($Allproducts['quantity']*($Allproducts['price']-$Allproducts['discount_price']));?>
                <?php $grand_deposite = $grand_deposite + ($Allproducts['quantity']*($Allproducts['deposite']-$Allproducts['discount_deposite']));?>
                
                <!--<tr>
             
              <td class="text-right"><b>Sub-Total</b></td>
              <td class="text-right"><span class="WebRupee"><?=CURRENCY?></span><?=$Allproducts['total']?></td>
              <td></td>
            </tr>-->
                
                <?php $i++; 
				}
				$gst_tax = $this->commonmod_model->getSystemValue('gst_tax');
										$totalamount = $grand_total;
										$gst = ($gst_tax*$totalamount)/100 ;
				?>
              </tbody>
              <tfoot>
			   
				
                <tr>
                  <td colspan="3"></td>
                  <td class="text-right"><b>Total</b></td>
                  <td class="text-right"><?=CURRENCY?>
                    <?php echo number_format((@$grand_total+$grand_deposite+$gst),2); ?></td>
                </tr>
              </tfoot>
            </table>
         
			 <div class="form-group">
                  <div class="col-md-offset-4 col-md-4">
                    <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                    <button class="btn btn-default" onclick="window.location.href='<?=BASE_URL?>admin/listing/orderdetail/<?=$order_id?>'" type="button">Cancel</button>
                  </div>
                </div>
			</div>
			</form>
           
              
      </div>
      
      <!-- project team & activity end --> 
      
    </section>
    <?php $this->load->view("Element/admin/footer_common.php");?>
  </section>
  <!--main content end--> 
</section>
<!-- container section start -->

<?php $this->load->view("Element/admin/footer.php");?>
<!-- Angular datepicker -->
<script>
function updateDate(){
	start_date = $("#start_date2").val();
	end_date = $("#end_date2").val();
	
	 if(end_date > start_date){
             $("#err_msg").html('');
			 }else {
			  $("#err_msg").html('Please Select Start date. End Date Should be higher than start Date.');
			 }
	
	 $.ajax({
			 url : "<?php echo base_url('admin/cart/update_date'); ?>",
          type: "POST",
          data: {'start_date': start_date, 'end_date': end_date },
		  dataType: 'html',
           success: function(data){
			
             $("#noOfDays").html(data +' Days');
			 	
			
           }
         });
}


function increment(fieldid){
curent_val = $("#"+fieldid).val();
curent_val++;
$("#"+fieldid).val(curent_val);
//updateForm();
}
function decrement(fieldid){
curent_val = $("#"+fieldid).val();
if(curent_val > 1)
curent_val--;
$("#"+fieldid).val(curent_val);
///updateForm();
}

</script>


<script>
$(document).ready(function() {
    $("#start_date").val('<?=date("d-m-Y",strtotime($Oneorder[0]['start_date']))?>');
    $("#end_date").val('<?=date("d-m-Y",strtotime($Oneorder[0]['end_date']))?>');
});
</script>
</body>
</html>

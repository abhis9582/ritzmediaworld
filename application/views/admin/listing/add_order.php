<!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="MyController as ctrl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
<meta name="author" content="GeeksLabs">
<meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
<link rel="shortcut icon" href="img/favicon.png">
<title>Add New Order</title>
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
            <li><i class="fa fa-laptop"></i> Add New Order Information </li>
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
          
<?php $allpro_ids = array();
if (count($this->cart->contents()) > 0){ 
	foreach ($this->cart->contents() as $item):
$allpro_ids[] = $item['id'];
endforeach;
}

?>
<section class="bgwhyrent tariff_section">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-12 col-xs-12">
				<div class="tariff_tabs">
					<ul class="nav nav-tabs t_firsttab">
						<li class="active"><a data-toggle="tab" href="#campingitem">CAMPING ITEMS</a></li>
						<li><a data-toggle="tab" href="#gropro">GO PRO ITEMS</a></li>
					</ul>
					<div class="tab-content">
						
						<div id="campingitem" class="tab-pane fade in active t_moretabs">
						  <ul class="nav nav-pills tariff_pill">
								<?php 
								$i=1;
								$catData = $this->commonmod_model->getALLOthersParentCategories('Camping');
								if(count($catData) > 0)	{
								foreach($catData as $CatDataOne){

								?>
								<li <?=($i==1)?'class="active"':''?>><a data-toggle="pill" href="#<?=create_url($CatDataOne['category_name'])?>"><?=ucwords($CatDataOne['category_name'])?></a></li>
								<?php $i++; } } ?>
								
						  </ul>
						  
						  <div class="tab-content">
						  <?php 
							$i=1;
							$catData = $this->commonmod_model->getALLOthersParentCategories('Camping');
							if(count($catData) > 0)	{
							foreach($catData as $CatDataOne){
							$cat_id = $CatDataOne['id'];
							$catData = $this->commonmod_model->getALLOthersParentCategories();
							$AllProduct = $this->commonmod_model->GetProductListingByTopRated($cat_id);
								?>
							<div id="<?=create_url($CatDataOne['category_name'])?>" class="tab-pane fade <?php if($i==1){ ?>in active <?php } ?>">
								<div class="tarrif_table">
							  <table role="table">
									<thead role="rowgroup">
										<tr role="row">
								      <th role="columnheader">Rental Equipment</th>
								      <th role="columnheader">Rent ( First 3 days )</th>
								      <th role="columnheader">Refundable Deposit</th>
								      <th role="columnheader">Add To Cart</th>
								    </tr>
									</thead>

									<tbody role="rowgroup">
											<?php if(count($AllProduct) > 0) { 
											foreach($AllProduct as $AllProductData){
												$src = $this->image->getImageSrc("listings",$AllProductData['listing_image1'],"./webroot/front/images_not_found.jpg"); 
											?>
								    <tr role="row">
								      <td role="cell">
								      	<ul class="itemtable">
													<li><a href="<?=BASE_URL?><?=$AllProductData['listing_url_title']?>.html" target="_blank"><img src="<?=$src?>"></a></li>
													<li><span class="productname"><a href="<?=BASE_URL?><?=$AllProductData['listing_url_title']?>.html" target="_blank"><?=substr($AllProductData['listing_title'],0,30);?></a></span></li>
												</ul>
								      </td>
								      <td role="cell"><span class="daytext"><span class="theme_color">₹</span> <?=$AllProductData['price']?> Per Day </span></td>
								      <td role="cell"><span class="rd_text"><span class="theme_color">₹</span> <?=$AllProductData['deposite']?></span></td>
								      <td role="cell">
								      	<form action="<?=BASE_URL?>cart/add" method="post" accept-charset="utf-8">

                                     <input type="hidden" name="id" id="id_<?=$AllProductData['id']?>" value="<?=$AllProductData['id']?>">

									<input type="hidden" name="name" id="name_<?=$AllProductData['id']?>" value="<?=create_url($AllProductData['listing_title'])?>">

									<input type="hidden" name="deposite" id="deposite_<?=$AllProductData['id']?>" value="<?=$AllProductData['deposite']?>">
									<input type="hidden" name="price" id="price_<?=$AllProductData['id']?>" value="<?=$AllProductData['price']?>">
									<button type="button" id="btn<?=$AllProductData['id']?>" class="addtocart" onclick="add_ajax('<?=$AllProductData['id']?>');" ><?php if(in_array($AllProductData['id'],$allpro_ids)){ ?> Added <?php } else { ?>Add <?php } ?><i class="fa fa-angle-right" aria-hidden="true"></i></button>
 </form>
								      </td>
								    </tr>
								    <?php } } ?>
								  </tbody>
								  </table>
								</div>
								
							</div>
								<?php $i++; }} ?>
						  </div>
						</div>
						
						
						
						<div id="gropro" class="tab-pane fade go_pro">
					  <ul class="nav nav-pills tariff_pill">
								<?php 
								$i=1;
								$catData = $this->commonmod_model->getALLOthersParentCategories('Go Pro');
								if(count($catData) > 0)	{
								foreach($catData as $CatDataOne){

								?>
								<li <?=($i==1)?'class="active"':''?>><a data-toggle="pill" href="#<?=create_url($CatDataOne['category_name'])?>2"><?=ucwords($CatDataOne['category_name'])?></a></li>
								<?php $i++; } } ?>
								
						  </ul>
						  
						  <div class="tab-content">
						  <?php 
							$i=1;
							$catData = $this->commonmod_model->getALLOthersParentCategories('Go Pro');
							if(count($catData) > 0)	{
							foreach($catData as $CatDataOne){
							$cat_id = $CatDataOne['id'];
							$catData = $this->commonmod_model->getALLOthersParentCategories();
							$AllProduct = $this->commonmod_model->GetProductListingByTopRated($cat_id);
								?>
							<div id="<?=create_url($CatDataOne['category_name'])?>2" class="tab-pane fade <?php if($i==1){ ?>in active <?php } ?>">
								<div class="">
								 <div class="tarrif_table">
								 	<table role="table">
									<thead role="rowgroup">
									<tr role="row">
									<th role="columnheader">Rental Equipment</th>
									<th role="columnheader">Rent ( First 3 days )</th>
									<th role="columnheader">Refundable Deposit</th>
									<th role="columnheader">Add To Cart</th>
									</tr>
									</thead>
									<tbody role="rowgroup">
									<?php if(count($AllProduct) > 0) { 
									foreach($AllProduct as $AllProductData){
										$src = $this->image->getImageSrc("listings",$AllProductData['listing_image1'],"./webroot/front/images_not_found.jpg"); 
									?>
									<tr role="row">
									<td role="cell">
									<ul class="itemtable">
									<li><a href="<?=BASE_URL?><?=$AllProductData['listing_url_title']?>.html" target="_blank"><img src="<?=$src?>"></a></li>
									<li><span class="productname"><a href="<?=BASE_URL?><?=$AllProductData['listing_url_title']?>.html" target="_blank"><?=substr($AllProductData['listing_title'],0,30);?></a></span></li>
									</ul>
									</td>

									<td role="cell"><span class="daytext"><span class="theme_color">₹</span> <?=$AllProductData['price']?> Per Day </span></td>

									<td role="cell"><span class="rd_text"><span class="theme_color">₹</span> <?=$AllProductData['deposite']?></span></td>
									
									<td role="cell">
									<form action="<?=BASE_URL?>cart/add" method="post" accept-charset="utf-8">
							
								

							    <input type="hidden" name="id" id="id_<?=$AllProductData['id']?>" value="<?=$AllProductData['id']?>">

									<input type="hidden" name="name" id="name_<?=$AllProductData['id']?>" value="<?=create_url($AllProductData['listing_title'])?>">

									<input type="hidden" name="deposite" id="deposite_<?=$AllProductData['id']?>" value="<?=$AllProductData['deposite']?>">
									<input type="hidden" name="price" id="price_<?=$AllProductData['id']?>" value="<?=$AllProductData['price']?>">
								<button type="button" id="btn<?=$AllProductData['id']?>" class="addtocart" onclick="add_ajax('<?=$AllProductData['id']?>');" ><?php if(in_array($AllProductData['id'],$allpro_ids)){ ?> Added <?php } else { ?>Add<?php } ?><i class="fa fa-angle-right" aria-hidden="true"></i></button>


								
								</form>
								
									</td>
									</tr>
									<?php } } ?>
								
									</tbody>
								  </table>
								 </div>
								</div>
								
							</div>
								<?php $i++; }} ?>
							
						  </div>	</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-sm-12 col-xs-12">
				<div class="rightwarpper" id="view_cart">
					<div class="tarif_calhead">
						<h1>TARIFF CALCULATOR</h1>
					</div>
					<div class="details_content">
						<div class="col-md-12">
							<div class="row inner_div pickerdate inner_form">
							<form action="<?=BASE_URL?>tariff.html" method="post" id="tarrif1" onsubmit="updateDate()">
								<div class="col-md-9 col-sm-9 col-xs-12 paddingL">
									<div href="#" class="datepickerbtn">
										<div class="dt_heading">
											<input type='text' class="form-control datepicker" autocomplete="off" value="<?=$start_date;?>" id="start_date" name="start_date"  placeholder="Pick-Up Date" />
								
										</div>
									</div>
									<div href="#" class="datepickerbtn">
										<div class="dt_heading">
											
									<input type='text'  value="<?=$end_date?>" autocomplete="off" class="form-control datepicker" id="end_date"  name="end_date" placeholder="Drop Date" />
									
										</div>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12 paddingL">
									<button type="button" class="btn_refresh" onclick="updateDate();" > Submit Date  </button>
								</div>
								
								
										
								</form>
								
							</div>
						</div>
					<?php 
					$now = strtotime($end_date); // or your date as well
					$your_date = strtotime($start_date);
					$datediff = $now - $your_date;

					$days =  round($datediff / (60 * 60 * 24));
					?>
					<?php if ($days < 0 || $days == 0){ ?>
					<div class="check_avilable"><span style="color:red;font-size: 15px;margin-top:10px;font-weight: normal;" id="err_msg">Please Select Start date. End Date Should be higher than start Date.</span></div>
					<?php } else if($days < 1 || $days==1) {  ?>
					<div class="check_avilable"><span style="color:red;font-size: 15px;margin-top:10px;font-weight: normal;" id="err_msg">Minimum Rental duration is 2 days </span></div>
					
					<?php } else if( $days > 15) {  ?>
					<div class="check_avilable"><span style="color:red;font-size: 15px;margin-top:10px;font-weight: normal;" id="err_msg">Kindly Call +91-9821229767 for more than 15 days.</span></div>
					
					<?php } ?>

						<div class="duaration">Duration : <span class="theme_color" id="noOfDays"><?=$days?> Days</span></div>
						<div id="cartDiv">
						
						<?php if (count($this->cart->contents()) > 0){ ?>
				
					<?php
					echo form_open('admin/cart/update_cart_ajax','id="formup"');
					$grand_total = 0; $i = 1;
					$grand_deposite = 0;
					?>
						<div class="qrd_table">
				<?php
					
					foreach ($this->cart->contents() as $item):
					
					 
					  $item['price'] = getProductPriceByDays($item['id'],$days);
					 
					  
						echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
						echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
						echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
						echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
						//echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
						echo form_hidden('cart['. $item['id'] .'][deposite]', $item['deposite']);
						
						
					?>
							<div class="tcal_etails">
							<span class="heading_qrd"><?=$item['name']?> </span>
							<table class="table">
							<td>
							<p>Qty</p>
							<div class="input-group quantitybtn">
							<input type="button" value="-" onclick="return decrement('qty<?=$i?>');" class="button-minus" data-field="quantity">
							<input type="number" step="1" max="" id="qty<?=$i?>" value="<?=$item['qty']?>"  name="cart[<?=$item['id']?>][qty]" class="quantity-field">
							<input type="button" value="+" onclick="return increment('qty<?=$i?>');" class="button-plus" data-field="quantity">
							</div>
							
							</td>
							<td>
							<div class="rentmiddle"><span class="fw600">rent :</span><span class="theme_color"> ₹ </span><?=$item['qty']*$item['price']?>
							<input type="number"  id="discount_price<?=$i?>" value="<?=$item['discount_price']?>"  name="cart[<?=$item['id']?>][discount_price]">
							
							</div>
							</td>
							<td>
							<div class="rentmiddle"><span class="fw600">Deposit  :</span><span class="theme_color"> ₹ </span><?=$item['qty']*$item['deposite']?>
							<input type="number"  id="discount_deposite<?=$i?>" value="<?=$item['discount_deposite']?>"  name="cart[<?=$item['id']?>][discount_deposite]">
							
							</div>
							</td>
							<td>
							<div class="rentmiddle">
							<i onclick="removePro('<?=$item['rowid']?>','<?=$item['id']?>')" class="fa fa-trash-o" aria-hidden="true"></i>
							</div>
							</td>
							</table>
							</div>
							
							
						<?php 
						$i++;
						$grand_total = $grand_total + ($item['qty']*($item['price']-$item['discount_price'])); ?>
						<?php $grand_deposite = $grand_deposite + ($item['qty'] * ($item['deposite']-$item['discount_deposite'])); ?>
						<?php endforeach; ?>
					
							
						</div>
						
						<div class="boxex3_outer">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3 col-sm-6 col-xs-6 row_padding">
									<div class="boxex-right">
										<span class="theme_color font_w ">Rental</span>
										<span class="font_rs theme_color">₹</span>
										<span class="font_w18 "><?php echo number_format(@$grand_total,2); ?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-6 row_padding">
									<div class="boxex-right">
										<span class="theme_color font_w ">GST (<?=$this->commonmod_model->getSystemValue('gst_tax')?>%)</span>
										<span class="font_rs theme_color">₹</span>
										<?php 
										$gst_tax = $this->commonmod_model->getSystemValue('gst_tax');
										$totalamount = $grand_total; ?>
										<span class="font_w18 "><?php  $gst = ($gst_tax*$totalamount)/100 ; ?>
										<?php echo number_format(@$gst,2);?>
										</span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-6 row_padding">
									<div class="boxex-right">
										<span class="theme_color font_w ">Security</span>
										<span class="font_rs theme_color">₹</span>
										<span class="font_w18 ">	<?php echo number_format(@$grand_deposite,2);?></span>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-6 row_padding">
									<div class="boxex-right">
										<span class="theme_color font_w ">Total</span>
										<span class="font_rs theme_color">₹</span>
										<span class="font_w18 "><?=number_format(($grand_total+$grand_deposite+$gst),2)?></span>
									</div>
								</div>
								
							
								
							</div>
							
							
							
							</div>
						</div>
							<?php } ?>
							
							<div class="check_avilable">
								<div class="col-md-12 col-sm-12 col-xs-12 row_padding">
									<div class="boxex-right">
										<span class="theme_color font_w ">User</span>
										<span class="font_rs theme_color"></span>
										<span class="font_w18 ">
										<select name="user_id" id="user_id" required class="form-control">
										<option value="">Please Select</option>
										<?php foreach($this->user_model->getALLUserActive() as $UserData){ 
										$sel = ($this->session->userdata('admin_user_order')==$UserData['user_id'])?'selected':'';
										?>
										<option <?$sel?> value="<?=$UserData['user_id']?>">UserId: #<?=$UserData['user_id'] . " - ". $UserData['first_name']." ".$UserData['last_name']."(".$UserData['mobile'].")"?></option>
										<?php } ?>
										</select>
										
										</span>
									</div>
								</div>
							
						
								<?php echo form_close(); 
								 if($days > 15) { $style = 'display:none;'; }
								 else if($days <= 1) { $style = 'display:none;'; }
								 else { $style = '';}
								?>
								<div class="check_avilable" style="<?=$style?>">
							<?php if ($days < 0 || $days == 0){ ?>
							
							<?php  } else if (count($this->cart->contents()) > 0 && $days > 0){ ?>
						<button type="button" onclick="updateForm();">Update Cart </button>
					<button type="button" onclick="SubmitRequest();">Check Availability </button>
						
						
					<?php } else {  ?> 
				
						
					<ul class="cd-main-nav__list js-signin-modal-trigger tarrif_login"  style="<?=$style?>">
				<!-- inser more links here -->
					
						<li><a data-toggle="modal" data-target="#myModalLogin"> Check Availability</a></li>
					
						</ul>
		
						<?php } ?>
					</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

      
    </section>
    <?php $this->load->view("Element/admin/footer_common.php");?>
  </section>
  <!--main content end--> 
</section>
<!-- container section start -->

<?php $this->load->view("Element/admin/footer.php");?>

<script type="text/javascript" src="<?=FRONT_DIR?>js/jquery.min.js"></script>

<!-- Angular datepicker -->
<script>
function updateDate(){
	start_date = $("#start_date").val();
	end_date = $("#end_date").val();
	
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


</script>





<script>

<?
if(@$_GET['openpopup']=='1'){ 
?>
  $('#myModal').modal('show');
   SubmitRequest();
<?php } ?>
function increment(fieldid){
curent_val = $("#"+fieldid).val();
curent_val++;
$("#"+fieldid).val(curent_val);
updateForm();
}
function decrement(fieldid){
curent_val = $("#"+fieldid).val();
if(curent_val > 1)
curent_val--;
$("#"+fieldid).val(curent_val);
updateForm();
}


function updateDate(){
start_date = $("#start_date").val();
end_date = $("#end_date").val();



 

	
	 $.ajax({
			 url : "<?php echo base_url('admin/cart/update_date'); ?>",
          type: "POST",
          data: {'start_date': start_date, 'end_date': end_date },
		  dataType: 'html',
           success: function(data){
			
             
			  if(data < 0 ){
				  $("#err_msg").html('Minimum Rental duration is 2 days.');
				  $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }if(data < 1 ){
				  $("#err_msg").html('End Date Should be higher than start Date, Minimum Rental duration is 2 days.');
				  $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }else if(data == 1){
				  $("#err_msg").html('Minimum Rental duration is 2 days.');
				   $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }else if(data > 15){
				  $("#err_msg").html('Kindly Call +91-9821229767 for more than 15 days.');
				   $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }else {
			 $("#noOfDays").html(data +' Days');
			 $("#err_msg").html('');
			 }
			 getcart();
				
			
           }
         });
}


function getcart(){

 $.ajax({
			 url : "<?php echo base_url('admin/cart/update_cart_ajax'); ?>",
          type: "POST",
          data: {  },
		  dataType: 'html',
           success: function(data){
			
             $("#cartDiv").html(data);
			
			 	return  countpro(); 
			   
           }
         });
		 
		 
}

function add_ajax(id){
	id = $("#id_"+id).val();
	name = $("#name_"+id).val();
	price = $("#price_"+id).val();
	deposite = $("#deposite_"+id).val();
	
	
	
	 $.ajax({
			 url : "<?php echo base_url('admin/cart/add_ajax'); ?>",
          type: "POST",
          data: {'id': id, 'name': name,'price': price,'deposite': deposite  },
		  dataType: 'html',
           success: function(data){
			$("#btn"+id).html('Added <i class="fa fa-angle-right" aria-hidden="true"></i>');
             $("#cartDiv").html(data);
			
			 	return  countpro(); 
			   
           }
         });
}

function removePro(rowid,id){
	 $.ajax({
			 url : "<?php echo base_url('admin/cart/removepro'); ?>",
          type: "POST",
          data: {'rowid': rowid  },
		  dataType: 'html',
           success: function(data){
			
             $("#cartDiv").html(data);
			 $("#btn"+id).html('Add <i class="fa fa-angle-right" aria-hidden="true"></i>');
			 return countpro(); 
           }
         });
}
function countpro(){
	 $.ajax({
			 url : "<?php echo base_url('admin/cart/countpro'); ?>",
          type: "POST",
          data: {  },
		  dataType: 'html',
           success: function(data){
			
             $("#cartcount").html(data); 
           }
         });
}


 
 
function updateForm(){
	var form=$("#formup");

	$.ajax({
	type:"POST",
	url:form.attr("action"),
	data:form.serialize(),
	success: function(response){

	$("#cartDiv").html(response); 
	}
	});

}

function SubmitRequest(){
	
        $.ajax({
			 url : "<?php echo base_url('admin/listing/submit_request'); ?>",
          type: "POST",
          data: {},
		  dataType: 'html',
           success: function(data){
			
              window.location.replace("<?=BASE_URL?>"+data+"");
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       

}

$(document).ready(function() {
    $("#start_date").val('<?=$start_date?>');
    $("#end_date").val('<?=$end_date?>');
});

function submitCheck(){
window.location.href='<?=BASE_URL?>admin/listing/submit_request';

}
</script>
</body>
</html>

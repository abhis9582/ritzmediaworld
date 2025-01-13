<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="CT Hotel">
<title> Booking - <?php echo $SupportSingleData[0]['listing_title']?></title>
<meta name="description" content="Booking - <?php echo $SupportSingleData[0]['listing_title']?>">
<meta name="keyword" content="Booking - <?php echo $SupportSingleData[0]['listing_title']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>


<?php $src = $this->image->getImageSrc("listings",$SupportSingleData[0]['listing_image1'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url('<?php echo FRONT_DIR?>images/about-section1-bg.jpg');">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1><?php echo $SupportSingleData[0]['listing_title']?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Booking - <?php echo $SupportSingleData[0]['listing_title']?></li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	</section>

<div class="book-form-listing-bg">
<div class="container">
<div class="row">
<div class="book-form_edit">
    <form method="post" autocomplete="off" id="book_hotel_form" style="display:none;" action="<?=BASE_URL?>search-hotel">
		<div class="form-row">
			  <div class="col-md-2">
				   <select name="city" id="city" class="form-control" onchange="return getHotelByCity3(this.value)">
						<option>Select Location</option>
						<?php $AllCity = $this->listing_model->GetALLEnableCity();
						foreach($AllCity as $CityData){ 
						$all_hotel = $this->commonmod_model->getHotelByCity($CityData['id']);
						
						if(count($all_hotel) > 0){
							if($CityData['id']==$SupportSingleData[0]['city']){ $sel = 'selected'; } else{ $sel = '';}
						?>
							<option value="<?=$CityData['id']?>" <?=$sel?> ><?=$CityData['name']?></option>
						<?php } } ?>
					</select>
			  </div>
			  <div class="col-md-2">
				<select class="form-control" autocomplete="off"  name="listing_id" id="listing_id3">
				  <option value="">Select Hotel</option>
				</select>
			  </div>
			  <div class="col-md-2"> 
				<input type="text" class="form-control fromdatepicker" autocomplete="off"  name="start_date"   id="start_date2" placeholder="Arrival Date" value="<?=$start_date?>">
				<span class="data-time-picker-arrow"></span> 
			  </div>
			  <div class="col-md-2"> 
				<input type="text" class="form-control todatepicker" autocomplete="off"   name="end_date" name="end_date2"  value="<?=$end_date?>" placeholder="Departure Date">
				<span class="data-time-picker-arrow"></span>
				 
			  </div>
		      <div class="col-md-2"><input type="submit" class="Ed_btn" name="submit" onclick="checkDate();" value="Search"></div> 
    		  <div class="col-md-2"><input type="button" class="hotel_edit_add"  onclick="closediv('close');" value="Close"></div>
		</div>  
    </form>
    <div id="edit_hotel_form">
    	<input type="button" class="submit-btn hotel_edit_add"  onclick="closediv('open');" value="Edit Hotel">
    </div>
				
				
				<script> 
				$(window).load(function() {
     getHotelByCity3('<?=$SupportSingleData[0]['city']?>','<?=$SupportSingleData[0]['id']?>');
});
				
				function closediv(type){
					if(type=='close'){ $("#book_hotel_form").hide(); $("#edit_hotel_form").show(); }
					if(type=='open'){ $("#book_hotel_form").show(); $("#edit_hotel_form").hide(); }
					
				}
				function checkDate(){
					var startDate = new Date($('#start_date').val());
var endDate = new Date($('#end_date').val());

if (startDate > endDate){
$("#end_date").focus();
alert("Arrival Date can not after Departure Date ");
return false;
}
return true;
				}
				</script>
				</div>
				</div>
				</div>
				</div>

<section class="sariska-rate-carousel" style="display:none;">
	<div class="container">
		<div class="row row1">
			<div class="owl-carousel rate-carousel owl-theme">
			
			<div class="item">
				<div class="rate-col">
					<p>24 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>25 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>26 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>27 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>28 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>29 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>30 Jun 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>01 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>02 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>03 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>04 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>05 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>06 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			<div class="item">
				<div class="rate-col">
					<p>07 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>08 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>09 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>10 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>11 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
			<div class="item">
				<div class="rate-col">
					<p>12 Jul 2019</p>
					<p>From</p>
					<p>₹ 2800</p>
				</div>
			</div>
			
		</div>
		</div>
	</div>
</section>

<!--end of owl carousel content-->

<?php $allpro_ids = array();
if(count($this->cart->contents()) > 0){ 
	foreach ($this->cart->contents() as $item){
	$allpro_ids[] = $item['category_id'];
	}
}

?>
<!--start content section-->

<section class="search-content-section">
	<div class="container">
		<div class="row row1">
		    
			<div class="col-lg-8">
				<div class="hotel1 left-col">
				<script>
				function setprice2(id,roomtype){
					$("#room_type_"+id).val(roomtype);
					price = $("#price"+roomtype+"_"+id).val();
					$("#price_"+id).val(price);
						$("#formup").submit(); 
				}
				function setprice(id,roomtype){
					$("#room_type_"+id).val(roomtype);
					price = $("#price"+roomtype+"_"+id).val();
					$("#price_"+id).val(price);
						
				}
				function form_submit(){
				$("#formup").submit(); 	
				}
				</script>
				
					<ul>
					<?php 
					$Allcategory = $this->listing_model->GetSupportListingHotelRoomByListingId($SupportSingleData[0]['id']);
					foreach($Allcategory as $categoryData){
						
						
						$src = $this->image->getImageSrc("listings",$categoryData['image_name'],DEFAULT_HEADER_BANNER);
						 
						
					?>
					
					
					
						<li>
							<div class="image room">
								<img src="<?php echo $src?>" class="img-fluid">
								<span><i class="fa fa-picture-o"></i></span>
							</div>
							<div class="headings">
								<h1><?php echo $categoryData['image_title']?></h1>
							
								
								<form action="<?php echo BASE_URL?>cart/add" id="form_<?php echo $categoryData['id']?>" method="post" accept-charset="utf-8">

								<input type="hidden" name="current_url"  value="<?=str_replace("/index.php","",current_url());?>">
								<input type="hidden" name="id" id="category_id_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['id']?>">
								<input type="hidden" name="id" id="listing_id_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['listing_id']?>">
								<input type="hidden" name="id" id="id_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['id']?>">

								<input type="hidden" name="name" id="name_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['image_title']?>">
								<input type="hidden" name="room_type" id="room_type_<?php echo $categoryData['id']?>" value="1">
								<input type="hidden" name="room" id="room_<?php echo $categoryData['id']?>" value="1">


								<input type="hidden" name="price" id="price_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['price1']?>">
								<input type="hidden" name="price1" id="price1_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['price1']?>">
								<input type="hidden" name="price2" id="price2_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['price2']?>">
								<input type="hidden" name="price3" id="price3_<?php echo $categoryData['id']?>" value="<?php echo $categoryData['price2']+$categoryData['price3']?>">
								
								<table class="row">
									<tr>
										<td>Adults<br />
								<select id="adults_<?php echo $categoryData['id']?>" onchange="return setprice('<?php echo $categoryData['id']?>',this.value);">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								</select></td>
										<td>Children<br />
								<select id="children_<?php echo $categoryData['id']?>">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								
								</select></td>
										<td>Infant<br />
								<select id="infant_<?php echo $categoryData['id']?>">
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								
								</select></td> 
										<td>
										<?php 
										
										if(!in_array($categoryData['id'],$allpro_ids)){ ?>
										<button type="button" onclick="add_ajax('<?php  echo $categoryData['id']?>');" id="btn<?php echo $categoryData['id']?>" class="btn"  >Add <i class="fa fa-angle-right" aria-hidden="true"></i></button> 
										<?php } else { ?>
<button type="button" class="btn"  >Added <i class="fa fa-angle-right" aria-hidden="true"></i></button>										
										<?php } ?>										
										
										</td>
									</tr>
								</table>  
								</form> 
								
								<!--onclick="add_ajax('<?php // echo $categoryData['id']?>');"-->
								
								
								
							</div>
							
							<div class="amenities_box">
							<?php $amenities = explode(",",$categoryData['amenities']);
							if(count($amenities) > 0 && array_filter($amenities)){
							?>
								<!--p>Amenities</p-->
								<?php if(in_array('1',$amenities)){ ?>
								<a title="Wifi"><img src="<?php echo FRONT_DIR?>images/amme/wifi_i.jpg" /></a>
								<?php } if(in_array('2',$amenities)){ ?>
								<a title="Lunch"><img src="<?php echo FRONT_DIR?>images/amme/lunch_i.jpg" /></a>
								<?php } if(in_array('3',$amenities)){ ?>
								<a title="Swimming Pool"><img src="<?php echo FRONT_DIR?>images/amme/swimm_i.jpg" /></a>
								<?php } if(in_array('4',$amenities)){ ?>
								<a title="SPA"><img src="<?php echo FRONT_DIR?>images/amme/spa_i.jpg" /></a>
								<?php } if(in_array('5',$amenities)){ ?>
								<a title="Breakfast"><img src="<?php echo FRONT_DIR?>images/amme/breakfast_i.jpg" /></a>
								<?php } if(in_array('6',$amenities)){ ?>
								<a title="Dinner"><img src="<?php echo FRONT_DIR?>images/amme/dinner_i.jpg" /></a>
								<?php } if(in_array('7',$amenities)){ ?>
								<a title="Parking"><img src="<?php echo FRONT_DIR?>images/amme/parking_i.jpg" /></a> 
								<?php } if(in_array('8',$amenities)){ ?>
								<a title="Sports"><img src="<?php echo FRONT_DIR?>images/amme/sports_i.jpg" /></a> 
								<?php } if(in_array('9',$amenities)){ ?>
								<a title="Restaurents"><img src="<?php echo FRONT_DIR?>images/amme/restaurent_i.jpg" /></a> 
							<?php } } ?>
								
								
							</div>
							
							<div class="amenities_desc"><?=$categoryData['amenities_desc'];?></div>
							
							<div class="headings" style="display:none;"> 
								<?php if(!empty($categoryData['price1'])){ ?>
								<div class="all_book_box">
									<table>
										<tr>
											<td><h2>Single Adults</h2></td>
											<td><h3>₹ <?php echo $categoryData['price1']?></h3></td>											
										</tr> 
									</table>
								</div>
							<?php } ?>
							<?php if(!empty($categoryData['price2'])){ ?>
								<div class="all_book_box"> 
									<table>
										<tr>
											<td><h2>Double Person</h2></td>
											<td><h3>₹ <?php echo $categoryData['price2']?></h3></td>											
										</tr> 
									</table> 
								</div>
							<?php } ?>
							<?php if(!empty($categoryData['price3'])){ ?>
								<div class="all_book_box">
									<table>
										<tr>
											<td><h2>Extra Person</h2></td>
											<td><h3>₹ <?php echo $categoryData['price3']?></h3></td>											
										</tr> 
									</table> 
								</div>
							<?php } ?>
							
								
								
								
							</div>
							
							
							<div class="price room"> 
								<p>From&nbsp;&nbsp;<span><i class="fa fa-rupee"></i> <?php echo $categoryData['price1']?></span></p>
								<font>per room per night</font>
							</div>
							
							
							
						</li>  
				<?php } ?>
				</ul>
				
				
			</div>
			</div>
			
			<div class="col-lg-4 pl-0">
				<div class="right-col">
				
				<div class="no-room-summary" id="no-room-summary1">
					<h3>Booking Summary</h3>
		
					<img src="<?php echo FRONT_DIR?>images/bed.png" class="img-fluid">
					
						<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" id="tarrif1" onsubmit="updateDate()">
								<div class="paddingL">
									<div href="#" class="datepickerbtn">
										<div class="dt_heading">
											<input type='text' class="form-control fromdatepicker2" autocomplete="off" value="<?php echo $start_date;?>" id="start_date" name="start_date"  placeholder="Check In Date" />
										</div>
									</div>
									<div href="#" class="datepickerbtn">
										<div class="dt_heading"> 
											<input type='text' value="<?php echo $end_date?>" autocomplete="off" class="form-control todatepicker2" id="end_date"  name="end_date" placeholder="Check Out Date" />
										</div>
									</div>
									<button type="button" class="btn btn-primary" onclick="updateDate();" >Submit</button>
									
								</div> 
								
								
										
								</form>
								
								<?php 
								
								
					$now = strtotime($end_date); // or your date as well
					$your_date = strtotime($start_date);
					$datediff = $now - $your_date;

					 $days =  round($datediff / (60 * 60 * 24));
					 
					$all_date = date_range($start_date,$end_date);




					?>
					<?php if ($days < 0 || $days == 0){ ?>
					<div class="check_avilable"><span id="err_msg"></span></div>
					<?php } else if($days < 1 || $days==0) {  ?>
					<div class="check_avilable"><span id="err_msg">Minimum Booking duration is 1 days </span></div>
					
					<?php } else if( $days > 9) {  ?>
					<div class="check_avilable" style="display:none;"><span id="err_msg">Kindly Call  for more than 9 days.</span></div>
					
					<?php } ?>

						<div class="duaration">Duration : <span class="theme_color" id="noOfDays"><?php echo $days?> Days</span></div>
					
				</div>
				
				
				<div class="room-booking-summary" id="room-booking-summary" style="display:block;">
					
					
					<div class="booking-summary">
						<div id="cartDiv">
						
						<?php 
						echo form_open(BASE_URL.'cart/update_cart','id="formup"');
						if (count($this->cart->contents()) > 0){ ?>
				<input type="hidden" name="current_url" id="current_url" value="<?=str_replace("/index.php","",current_url())?>">
					<?php
					
					$sub_total = 0; 
					$i = 1;
					
					?>
					<div class="right_head_bottom">
    					<table>
    		            <tr>
        					<th class="right_head">Room </th>
        					<th class="right_head">Room Type</th>
        					<th class="right_head">Amount</th> 
    					</tr>
    					</table>
					</div>
					
				<?php
					$error = array();
					$available_error = array();
					$total_adults = 0;
					$total_children = 0;
					$total_infant = 0;
					foreach ($this->cart->contents() as $item):
			
						//echo form_hidden('current_url', str_replace("/index.php","",current_url()));
						echo form_hidden('cart['. $i .'][id]', $i);
						echo form_hidden('cart['.$i.'][rowid]', $item['rowid']);
						echo form_hidden('cart['. $item['id'].'][listing_id]', $item['listing_id']);
						echo form_hidden('cart['.$i.'][category_id]', $item['category_id']);
						echo form_hidden('cart['.$i.'][name]', $item['name']);
						echo form_hidden('cart['.$i.'][price]', $item['price']);
						//echo form_hidden('cart['.$i.'][qty]', $item['qty']);
						
						
						
						echo form_hidden('cart['.$i.'][room_type]', $item['room_type']);
						echo form_hidden('cart['.$i.'][room]', $item['room']);
						echo form_hidden('cart['.$i.'][option]', $item['option']);
						
						
						$item['qty'] = 1;
						$total_charge = 0;
						$available_error2 = '';
						if(count($all_date) > 0){
						foreach ($all_date as $value) {
							if($value != $end_date){
							$CurrentDateRoomCharge =  $this->listing_model->getRoomPriceByCurrentDate($value,$item['id'],$item['listing_id'],$item['room_type'],$item['children'],$item['infant']); 
							
							$check_room_availablity = $this->listing_model->GetRoomAvailability($value,$item['id'],$item['listing_id'],$item['room_type']);
							if($check_room_availablity!=''){
								$available_error2 .= $check_room_availablity;
								$available_error[] = 1;
							}
							
							if(!empty($CurrentDateRoomCharge)){
							$total_charge = $total_charge + $CurrentDateRoomCharge;
							}else{
								$total_charge = $total_charge + $item['price'];
							}
							}		
							}
						}
							
							
							$totalmate = $item['adults']+$item['children'];
							$total_adults = $total_adults + $item['adults'];
							$total_children = $total_children + $item['children'];
							$total_infant = $total_infant + $item['infant'];
							if($totalmate > 3){
							$error[] = $totalmate;
							}
						echo $html = '
						
							<div class="right_head_bottom">
								<table>
									<tr>
										<td>Room '.$i.'</td>
										<td>'.$item['name'].'</td>
										<td><i class="fa fa-rupee"></i> '.$total_charge.'</td> 
									</tr>';
									
									
									echo $html = '<tr> 
    									<td><div class="Ad_box">Adults&nbsp;
    								<select id="adults_'.$i.'" name="cart['.$i.'][adults]" onchange="return setprice2('.$item['id'].',this.value);">';
    								for($j=1;$j<4;$j++){ 
    								if($j==$item['adults']) {  $sel ='selected="selected"';} else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?=$sel;?>><?=$j?></option>
    								<?php }
    								echo '</select></div></td>
    								
    								<td><div class="Ad_box">Children&nbsp;
    								<select id="children_'.$i.'" name="cart['.$i.'][children]" onchange="return form_submit();" >';
    								for($j=0;$j<3;$j++){ 
    								if($j==$item['children']) {  $sel ='selected="selected"'; } else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?php echo $sel;?>><?=$j?></option>
    								<?php }
    								echo '
    								</select></div></td>
    								
    								<td><div class="Ad_box">Infant&nbsp;
    								<select id="infant_'.$i.'" name="cart['.$i.'][infant]">';
    								for($j=0;$j<3;$j++){ 
    								if($j==$item['infant']) {  $sel ='selected="selected"'; } else{ $sel ='';}
    								?>
    								<option value="<?=$j?>" <?=$sel;?>><?=$j?></option>
    								<?php }
    								echo '
    								</select></div></td>
								</tr>';
								
								if($item['adults'] > 0 && $this->session->userdata('bh_front_user_id')){
									for($j=1;$j<=$item['adults'];$j++){
										
										echo "<tr><td>Guest Name ".$j."</td><td colspan='2'><input required type='text' name='cart[".$i."][adults_name_".$j."]' value='".$this->session->userdata("adults_name_".$j."_".$i)."' class='adults_field form-control' value=''></td></tr>";
									}
									
								}
								if($item['children'] > 0 && $this->session->userdata('bh_front_user_id') > 0){
									for($j=1;$j<=$item['children'];$j++){
										
										echo "<tr><td>Children Name ".$j."</td><td colspan='2'><input required type='text' name='cart[".$i."][children_name_".$j."]' value='".$this->session->userdata("children_name_".$j."_".$i)."' class='children_field form-control' value=''></td></tr>";
									}
									
								}
								
								if($totalmate > 3 ){
									echo $html = '<tr>
										<div class="more_error">We are sorry!<br />Available Rooms cannot Accommodate more then 3 Guests. So please add new room.</div>
										 
									</tr>';	
								}
								
								if(!empty($available_error2)){
									echo $html = '<tr>
										<div class="more_error">No Room Available.</div>
									</tr>';	
								}
										
									echo $html = '
								</table>
							</div>
							
							<div class="btn_boxx"><i onclick="removePro(&#39;'.$item['rowid'].'&#39;,&#39;'.$item['id'].'&#39;)"  title="Delete Room" class="fa fa-trash pkg_del" aria-hidden="true"></i>  <i class="fa fa-plus pkg_add" title="Add Another Room" onclick="add_ajax_another('.$item['id'].','.$i.');"></i></div>
							
							'; 
							
							$room = (int)$item['adults'];
							
							
							$item['subtotal'] = $total_charge;
							$i++;
							$sub_total = $sub_total + $item['subtotal'];
							
							
							?>
							
							<?php endforeach; 
							
							$tax = get_tax($sub_total);
							$discount_amount = $this->session->userdata('discount_amount');
							$grand_total = (int)($sub_total + $tax - $discount_amount);
							$this->session->set_userdata('sub_total',$sub_total);
							$this->session->set_userdata('total_tax',$tax);
							$this->session->set_userdata('grand_total',(int)$grand_total);
							
							
							?> 
						
						
							<div class="row">
								<div class="col-md-12 col-sm-6 col-xs-6 row_padding">
								<div class="boxex-right">
								    <table> 
									 <tr>
								            <td><span class="theme_color font_w ">Total Adults:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 "><?php echo $total_adults; ?></span></td>
								        </tr>
										 <tr>
								            <td><span class="theme_color font_w ">Total Children:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 "><?php echo $total_children; ?></span></td>
								        </tr>
										 <tr>
								            <td><span class="theme_color font_w ">Total Infant:  </span></td>
								            <td style="text-align:right;">
										    <span class="font_w18 "><?php echo $total_infant; ?></span></td>
								        </tr><tr>
								            <td colspan="3"></td>
								        </tr>
										 
										
								        <tr>
								            <td><span class="theme_color font_w ">Sub Total:  </span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
										    <span class="font_w18 "><?php echo number_format(@$sub_total,2); ?></span></td>
								        </tr>
										
								<?php if($this->session->userdata('coupon_code')!=""){ ?>
								        <tr>
								            <td><span class="theme_color font_w ">Coupon Applied (<?=$this->session->userdata('coupon_code')?>): <br> </span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
									        <span class="font_w18 "><?=number_format((int)$this->session->userdata('discount_amount'),2)?></span></td>
								        </tr>
								<?php } ?>
										<tr>
								            <td><span class="theme_color font_w ">Tax: </span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
									        <span class="font_w18 "><?php echo number_format(@$tax,2); ?></span></td>
								        </tr>
								        <tr>
								            <td><span class="theme_color font_w ">Grand Total</span></td>
								            <td style="text-align:right;"><span class="font_rs theme_color"><i class="fa fa-rupee"></i></span>
										    <span class="font_w18 "><?php echo number_format(@$grand_total,2); ?></span></td>
								        </tr>
											<tr>
											<td colspan="2">
											<span class="theme_color font_w " id="pay_at_hotel_error1"></span>
											<span class="theme_color font_w " id="pay_at_hotel_error2"></span>
											</td>
											</tr>
				 
				 
								    </table>
									</div>
								</div>
								
							</div>
							
					
							<?php }  
								$listing_id = $SupportSingleData[0]['id'];
								$dates_available = $this->commonmod_model->checkHotelDatesIsAvailable($listing_id,$start_date,$end_date);

								
								 if(count($this->cart->contents()) > 8) { 
								 $flag='no';
								 echo 'Can not book more than 9 rooms.';
								 $style = 'display:none;'; 
								 }
								 else if($days <= 0) { $style = 'display:none;'; }
								 else { $style = '';}
								 
								 if($i > 0){
								?>
								<?php 
									
			
			if($this->session->flashdata("coupan_error")) 
			echo '<div class="error" id="FLASH" name="FLASH">'.$this->session->flashdata("coupan_error").'</div>';
			
								if( $this->session->userdata('coupon_id') =="" ){ 
								?>
								<div class="coupandiv">
								<input type="text" name="coupon_code" placeholder="Enter Coupon Code" class="form-control" value=""> 
								
									<input type="submit"  name="make_discount" value="Apply Coupan Code" class="booking_now"> 
</div>									
								<?php } else { ?>
								
								
								<?php } ?>
									
								
								
								
								<button type="submit" class="booking_now"> Update Booking </button>
									
								 <?php } 
								 if ($days < 0 || $days == 0){ ?>
							
							<?php  } else if (count($this->cart->contents()) > 0  && count($available_error)==0 
							&& count($error)==0  && (!empty($this->session->userdata('bh_front_user_id'))) && $days > 0){ ?>
				
					<button type="button" onclick="SubmitRequest();" class="booking_now booking_now2">Pay Now </button>
					
					<?php if(count($dates_available) > 0) { ?>
					<button type="button" onclick="PayatHotel();" class="booking_now booking_now2">Pay At Hotel </button>
					<?php } ?>
					
					<?php } else if(count($this->cart->contents()) > 0  && count($available_error)==0 && count($error)==0 && $days > 0) {  ?> 
				
						
					
					<div class="cd-main-nav__list js-signin-modal-trigger tarrif_login"  style="<?php echo $style?>" >
					
						<a data-toggle="modal" class="booking_now booking_now2" data-target="#myModalLogin"> Book Now</a>
					
						</div>
		
						<?php } ?>
						
						
					
					<?php echo form_close();?>
					</div>
					
					
					
				</div>
				
				
				
				</div>
			</div>
		    </div>
		
		<div class="row row2 tab_box">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#about-hotel" role="tab" aria-controls="home" aria-selected="true">About Hotel</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#policies" role="tab" aria-controls="profile" aria-selected="false">Policies</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#hotel-map" role="tab" aria-controls="contact" aria-selected="false">Hotel Map</a>
			  </li>
			  <li class="nav-item" style="display:none;">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="contact" aria-selected="false">Reviews</a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="about-hotel" role="tabpanel" aria-labelledby="home-tab">
				<div class="row row1">
					<!--h4>About <?php echo $SupportSingleData[0]['listing_title'];?></h4-->
				</div>
				<?php $src = $this->image->getImageSrc("listings",$SupportSingleData[0]['listing_image1'],"./webroot/front/images_not_found.jpg");?>
				<div class="row row2">
					<div class="col-lg-5 hotel-image" style="display:none;">
						<div class="image">
							<img src="<?php echo $src?>" class="img-fluid">
						</div>
					</div>
					
					<div class="col-lg-12 mail">
						<div class="hotel-text">
						
						<?php echo html_entity_decode(strip_tags($SupportSingleData[0]['listing_description'],"<p></p><ol></ol>"));?>
						
							
						</div>
						
						
					</div>
					
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="policies" role="tabpanel" aria-labelledby="profile-tab">
				
				
				<div class="row row2">
					  <?php echo html_entity_decode($SupportSingleData[0]['policies'])?>
				</div>
				
			  </div>
			  
			  <div class="tab-pane fade" id="hotel-map" role="tabpanel" aria-labelledby="contact-tab">
			  <?php echo html_entity_decode(stripslashes($SupportSingleData[0]['map']))?>
			
				 </div>
			  
			  <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="contact-tab" style="display:none;">
					<section class="testimonials1">
							<div class="row row1">
								<div class="media">
								  <img src="images/reviews-img.jpg" class="mr-3" alt="..." style="width:50px;">
								  <div class="media-body">
									<h5 class="mt-0">Prakash Sharma</h5>
									Great service and very professional! They went above and beyond.
								  </div>
								</div>
								
								<div class="media">
								  <img src="images/reviews-img.jpg" class="mr-3" alt="..." style="width:50px;">
								  <div class="media-body">
									<h5 class="mt-0">Vijay Mehta</h5>
									We were very pleased with the service on our heating unit. The technician arrived on time.
								  </div>
								</div>
								
								<div class="media">
								  <img src="images/reviews-img.jpg" class="mr-3" alt="..." style="width:50px;">
								  <div class="media-body">
									<h5 class="mt-0">Aman Soni</h5>
									Great service and very professional! They went above and beyond.
								  </div>
								</div>
								
							</div>
					</section>
			  </div>
			  
			</div>
		</div>
		
	</div>
</section>

<!--end of content section-->

<script type="text/javascript">

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
			 url : "<?php echo base_url('cart/update_date'); ?>",
          type: "POST",
          data: {'start_date': start_date, 'end_date': end_date },
		  dataType: 'html',
           success: function(data){
			
             
			  if(data < 0 ){
				  $("#err_msg").html('Minimum Booking duration is 1 days.');
				  $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }if(data < 1 ){
				  $("#err_msg").html('End Date Should be higher than start Date, Minimum Hotel Booking duration is 1 Days.');
				  $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }else if(data > 15){
				  $("#err_msg").html('Kindly Contact to Admin for more than 15 days.');
				   $("#noOfDays").html(data +' Days');
				   $(".tarrif_login").hide();
				  return false;
			 }else {
			 $("#noOfDays").html(data +' Days');
			 $("#err_msg").html('');
			 }
			window.location.reload();
				
			
           }
         });
}


function getcart(){

 $.ajax({
			 url : "<?php echo base_url('cart/update_cart_ajax'); ?>",
          type: "POST",
          data: {  },
		  dataType: 'html',
           success: function(data){
			
             $("#cartDiv").html(data);
			
			 	return  countpro(); 
			   
           }
         });
		 
		 
}

function add_ajax_another(id,valu){
	
	
	 $.ajax({
			 url : "<?php echo base_url('cart/add_new_ajax'); ?>",
          type: "POST",
          data: {'category_id': id},
		  dataType: 'html',
           success: function(data){
			  
			window.location.reload();
              
           }
         });
}
function add_ajax(id){
	id = $("#id_"+id).val();
	name = $("#name_"+id).val();
	category_id = $("#category_id_"+id).val();
	listing_id = $("#listing_id_"+id).val();
	price = $("#price_"+id).val();
	room_type = $("#room_type_"+id).val();
	adults = $("#adults_"+id).val();
	
	children = $("#children_"+id).val();
	
	infant = $("#infant_"+id).val();
	room = $("#room_"+id).val();
	//days = $("#days_"+id).val();
	
	 $.ajax({
			 url : "<?php echo base_url('cart/add_ajax'); ?>",
          type: "POST",
          data: {'id': id, 'name': name,'room': room,'price': price,'category_id': category_id, 'room_type': room_type, 'adults': adults, 'children': children, 'infant': infant, 
		  'listing_id': listing_id },
		  dataType: 'html',
           success: function(data){
			  
			window.location.reload();
              
           }
         });
}

function removePro(rowid,id){
	 $.ajax({
			 url : "<?php echo base_url('cart/removepro'); ?>",
          type: "POST",
          data: {'rowid': rowid  },
		  dataType: 'html',
           success: function(data){
			
            // $("#cartDiv").html(data);
			 $("#btn"+id).html('Add <i class="fa fa-angle-right" aria-hidden="true"></i>');
			 window.location.reload();
			
           }
         });
}
function countpro(){
	 $.ajax({
			 url : "<?php echo base_url('cart/countpro'); ?>",
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

function PayatHotel(){
	$("#pay_at_hotel_error1").html('');
	$("#pay_at_hotel_error2").html('');
	adult_flag =0;
	children_flag =0;
	 $('.adults_field').each(function(){
       if( $(this).val().length == 0){
          $("#pay_at_hotel_error1").html('Guest Name can not be empty.');
		  var adult_flag=1;
	   }
    });
	
	 $('.children_field').each(function(){
       if( $(this).val().length == 0){
          $("#pay_at_hotel_error2").html('Children Name can not be empty.');
		  var children_flag=1;
	   }
    });
	
	if(adult_flag > 0 || children_flag > 0){
		return false;
	}
	else{
	current_url = '<?=BASE_URL?>search/submit_request';
	$("#current_url").val(current_url);
	$("#formup").submit(); 
	
	}
}

function SubmitRequest(){
	$("#pay_at_hotel_error1").html('');
	$("#pay_at_hotel_error2").html('');
	adult_flag =0;
	children_flag =0;
	 $('.adults_field').each(function(){
       if( $(this).val().length == 0){
          $("#pay_at_hotel_error1").html('Guest Name can not be empty.');
		  var adult_flag=1;
	   }
    });
	
	 $('.children_field').each(function(){
       if( $(this).val().length == 0){
          $("#pay_at_hotel_error2").html('Children Name can not be empty.');
		  var children_flag=1;
	   }
    });
	
	if(adult_flag > 0 || children_flag > 0){
		return false;
	}
	else{
	
	current_url = '<?=BASE_URL?>instamozo/index';
	$("#current_url").val(current_url);
	$("#formup").submit(); 
	}
	
       
}

$(document).ready(function() {
    $("#start_date").val('<?php echo $start_date?>');
    $("#end_date").val('<?php echo $end_date?>');
});

function submitCheck(){
window.location.href='<?php echo BASE_URL?>search/submit_request';

}

</script>


<?php $this->load->view("Element/front/footer.php");?>

<?php $this->load->view("Element/front/footer_common.php");?>
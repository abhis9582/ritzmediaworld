<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Vacation">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
  
  
  
  
  
  

<style>
.table tbody td::before {
display: none;
}
 @media only screen and (max-width: 900px) {
.table thead {
display: none;
}
.table tbody td {
float: left;
width: 100%;
position: relative;
padding-left: 56%;
word-break: break-all;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
}
.table tbody td::before {
display: block;
position: absolute;
top: 0;
left: 14px;
max-width: 40%;
font-weight: bold;
color: #103184;
}
}
</style>

<script type="text/javascript">
	$(function() {
		$('.table').responsiveTable();
	});
	</script>  
  
  
  
  
  
  
  
  
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>
<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
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
						<li class="breadcrumb-item active" aria-current="page">My Booking</li>
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
                <h3 class="right_heading">My Booking</h3>
                <select name="agent_id" id="agent_id" class="tab_filter" ONCHANGE="redirect(this.value)">
                    <option value="<?=BASE_URL?>user/mybooking">Please Select</option> 
                    <option value="<?=BASE_URL?>user/mybooking_status/1" <?php if(@$status=='1'){ ?> selected <?php } ?>>Booked</option> 
                    <option value="<?=BASE_URL?>user/mybooking_status/3" <?php if(@$status=='3'){ ?> selected <?php } ?>>Pending</option>
                    <option value="<?=BASE_URL?>user/mybooking_status/4" <?php if(@$status=='4'){ ?> selected <?php } ?>>Cancelled</option> 
                </select>
                <?php 
                    if(validation_errors())
                    echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
                    if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
                ?>
            <table id="myTable" class="grid_table">
            <?php if(count($Bookings) > 0) { ?>
            <tr>
                <th>Listing</th>
                <th>Request Date</th>
                <th>Booking Date</th>
                <th>Status</th>
            </tr>
            <?php  foreach($Bookings as $BlogsData) { ?>
            <tr>
                <td><?php $listingData = $this->commonmod_model->GetSupportListingDetails($BlogsData['listing_id']);
                echo "<b>";
                echo  $listingData[0]['listing_title'];
                echo "</b><br>";	
                $categoryData =  $this->commonmod_model->GetListingCategoryByID($listingData[0]['category_id']);
                echo  '<span class="ravi_smoll_font">'.$categoryData[0]['category_name'].'</span>';
                ?> </td>
                <td><?=date("d M,Y",strtotime($BlogsData['add_date']));?> </td>
                <td><?=date("d M,Y",strtotime($BlogsData['booking_date_from']));?> To <?=date("d M,Y",strtotime($BlogsData['booking_date_to']));?> </td>
                <td><?=$BlogsData['status'];?></td>
                </tr>  
                <?php } ?>	
                <?php } else{  ?>
            <tr>
                <td colspan="4">No records found</td>
                </tr>
            <?php } ?>					
            </table>
            </div>
            </div>
        </div>
    </div>
</section>
 





<?php $this->load->view("Element/front/footer.php");?>
<script>
function redirect(url){
window.location.href= url ;

}
</script>
<?php $this->load->view("Element/front/footer_common.php");?>
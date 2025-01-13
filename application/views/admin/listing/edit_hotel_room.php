<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
<meta name="author" content="GeeksLabs">
<meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
<link rel="shortcut icon" href="img/favicon.png">

<title>Hotel Category</title>
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
<h3 class="page-header"><i class="fa fa-laptop"></i> Hotel Category</h3>
<ol class="breadcrumb">
<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Hotel Category</a></li>						  	

</ol>
</div>
</div>




<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
Edit Hotel Category
<br>
<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a>
</header>
<div class="panel-body">

<?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 



<div class="col-lg-8">


<form method="post" action="<?=BASE_URL.'admin/listing/edit_hotel_room/'.$id.'/'.$listing_id?>" class="form-horizontal" role="form" enctype="multipart/form-data">
<input id="SaveStatus" name="submitF" type="hidden" value="1" />


<div class="form-group">
<label for="icode" class="col-md-3 control-label">Hotel Category Name</label>
<div class="col-md-9">
<input class="form-control" name="image_title" value="<?=(isset($listing_edit_images[0]['image_title'])!='')?$listing_edit_images[0]['image_title']:''?>" placeholder="Category Name">
</div>
</div>	

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Image</label>
<div class="col-md-9">
<input name="image_name" id="fileupload" class="form-control" placeholder="" type="file">
<?php  $src = $this->image->getImageSrc("listings",$listing_edit_images[0]['image_name'],"");?>
<img src="<?=$src?>" style="width:110px;"/> 
<br><br><span> Please upload image of size:  Width = 1000px, Height = 600px;</span>

</div>
</div>				


<?php $amenities = explode(",",$listing_edit_images[0]['amenities']);?>
<div class="form-group">
<label for="email" class="col-md-3 control-label">Amenities</label>
<div class="col-md-9">
<input type="checkbox" value="1" name="amenities[]" <?=in_array('1',$amenities)?'checked':''?> >
<a title="Wifi"><img src="<?=FRONT_DIR?>images/amme/wifi_i.jpg"></a>
<input type="checkbox" <?=in_array('2',$amenities)?'checked':''?>  value="2" name="amenities[]">
<a title="Lunch"><img src="<?=FRONT_DIR?>images/amme/lunch_i.jpg"></a>
<input type="checkbox" value="3" <?=in_array('3',$amenities)?'checked':''?>  name="amenities[]">
<a title="Swimming Pool"><img src="<?=FRONT_DIR?>images/amme/swimm_i.jpg"></a>
<input type="checkbox" value="4" <?=in_array('4',$amenities)?'checked':''?>  name="amenities[]"><a title="SPA"><img src="<?=FRONT_DIR?>images/amme/spa_i.jpg"></a>
<input type="checkbox" value="5" <?=in_array('5',$amenities)?'checked':''?>  name="amenities[]"><a title="Breakfast"><img src="<?=FRONT_DIR?>images/amme/breakfast_i.jpg"></a>
<input type="checkbox" value="6" <?=in_array('6',$amenities)?'checked':''?>  name="amenities[]"><a title="Dinner"><img src="<?=FRONT_DIR?>images/amme/dinner_i.jpg"></a>
<input type="checkbox" value="7" <?=in_array('7',$amenities)?'checked':''?>  name="amenities[]">
<a title="Parking"><img src="<?=FRONT_DIR?>images/amme/parking_i.jpg"></a>

<input type="checkbox" <?=in_array('8',$amenities)?'checked':''?> value="8" name="amenities[]">
<a title="Sports"><img src="<?=FRONT_DIR?>images/amme/sports_i.jpg"></a> 
<input type="checkbox" value="9" <?=in_array('9',$amenities)?'checked':''?> name="amenities[]">
<a title="Restaurents"><img src="<?=FRONT_DIR?>images/amme/restaurent_i.jpg"></a> 

</div>
</div>		


<div class="form-group">
<label for="icode" class="col-md-3 control-label">Amenities Description</label>
<div class="col-md-9">
<textarea class="form-control ckeditor" name="amenities_desc" rows="5" cols="10" placeholder="Amenities Description"><?=(isset($listing_edit_images[0]['amenities_desc'])!='')?$listing_edit_images[0]['amenities_desc']:''?> </textarea>
</div>
</div>


<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price Sgl</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price1" value="<?=(isset($listing_edit_images[0]['price1'])!='')?$listing_edit_images[0]['price1']:''?>" placeholder="Price">
</div>
</div>
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price Sgl Description</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price1_description" value="<?=(isset($listing_edit_images[0]['price1_description'])!='')?$listing_edit_images[0]['price1_description']:''?>" placeholder="Price 1 Description">
</div>
</div>

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price DBL </label>
<div class="col-md-9">
<input type="text" class="form-control" name="price2" value="<?=(isset($listing_edit_images[0]['price2'])!='')?$listing_edit_images[0]['price2']:''?>" placeholder="Price">
</div>
</div>

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price DBL Description</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price2_description" value="<?=(isset($listing_edit_images[0]['price2_description'])!='')?$listing_edit_images[0]['price2_description']:''?>" placeholder="Price 2 Description">
</div>
</div>
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Total Rooms </label>
<div class="col-md-9">
<input type="text" class="form-control" name="total_rooms" value="<?=(isset($listing_edit_images[0]['total_rooms'])!='')?$listing_edit_images[0]['total_rooms']:''?>" placeholder="Total Rooms">
</div>
</div>
<?php /*
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price(CP SINGLE) Per Person</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price3" value="<?=(isset($listing_edit_images[0]['price3'])!='')?$listing_edit_images[0]['price3']:''?>" placeholder="Price">
</div>
</div> 

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price(CP Single) Description</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price3_description" value="<?=(isset($listing_edit_images[0]['price3_description'])!='')?$listing_edit_images[0]['price3_description']:''?>" placeholder="Price 3 Description">
</div>
</div> */ ?>

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price 3rd Person</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price3" value="<?=(isset($listing_edit_images[0]['price3'])!='')?$listing_edit_images[0]['price3']:''?>" placeholder="Price">
</div>
</div>
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Per Children (Price)</label>
<div class="col-md-9">
<input type="text" class="form-control" name="children_price" value="<?=(isset($listing_edit_images[0]['children_price'])!='')?$listing_edit_images[0]['children_price']:''?>" placeholder="Price">
</div>
</div>
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Per Infant (Price)</label>
<div class="col-md-9">
<input type="text" class="form-control" name="infant_price" value="<?=(isset($listing_edit_images[0]['infant_price'])!='')?$listing_edit_images[0]['infant_price']:''?>" placeholder="Price">
</div>
</div>

<?php /*
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price(CP SINGLE) Per Person</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price3" value="<?=(isset($listing_edit_images[0]['price3'])!='')?$listing_edit_images[0]['price3']:''?>" placeholder="Price">
</div>
</div>

<div class="form-group">
<label for="icode" class="col-md-3 control-label">Price(CP Single) Description</label>
<div class="col-md-9">
<input type="text" class="form-control" name="price3_description" value="<?=(isset($listing_edit_images[0]['price3_description'])!='')?$listing_edit_images[0]['price3_description']:''?>" placeholder="Price 3 Description">
</div>
</div> */ ?>



<div style="margin-top:10px" class="form-group">
<!-- Button -->

<div class="col-sm-12 text-center controls">
<button type="submit" class="btn btn-default2">Submit</button>
</div>
</div>
</form>


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
<script type="text/javascript" src="<?=ADMIN_DIR?>assets/ckeditor/ckeditor.js"></script>
</body>
</html>

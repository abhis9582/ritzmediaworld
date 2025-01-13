<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
<meta name="author" content="GeeksLabs">
<meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
<link rel="shortcut icon" href="img/favicon.png">

<title>Edit Gallery Images</title>
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
<h3 class="page-header"><i class="fa fa-laptop"></i> Edit Gallery Images</h3>
<ol class="breadcrumb">
<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
<li><i class="fa fa-laptop"></i><a href="<?=BASE_URL?>admin/listing/support">Support Listing</a></li>						  	

</ol>
</div>
</div>




<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
Edit Gallery Image
<br>
<a style="float:right;margin-bottom:10px;" class="btn btn-primary admin-buttns" href="<?=BASE_URL?>admin/listing/support" title="Back">Back</a>
</header>
<div class="panel-body">

<?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'</div>';
?> 



<div class="col-lg-6">


<form method="post" action="<?=BASE_URL.'admin/listing/edit_image/'.$id.'/'.$listing_id?>" class="form-horizontal" role="form" enctype="multipart/form-data">
<input id="SaveStatus" name="submitF" type="hidden" value="1" />
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Category</label>
<div class="col-md-9">
<script>
function showtitle(value){
		if(value=='2002'){ $("#offer_title").show(); }
	else{ $("#offer_title").hide(); }
}
</script>
<select name="category_id" id="category_id" onchange="return showtitle(this.value)" class="form-control">

<option value="2000" <?=($listing_edit_images[0]['category_id']=='2000')?'selected':''?>>Gallery </option>
<option value="2001" <?=($listing_edit_images[0]['category_id']=='2001')?'selected':''?> >Activities</option>
<option value="2002" <?=($listing_edit_images[0]['category_id']=='2002')?'selected':''?>>Special Offer</option>
<option value="2003" <?=($listing_edit_images[0]['category_id']=='2003')?'selected':''?>>Features</option>
<option value="2004" <?=($listing_edit_images[0]['category_id']=='2004')?'selected':''?>>Header Banner </option>
   <option <?=($listing_edit_images[0]['category_id']=='2005')?'selected':''?> value="2005">Camp/Hotel Gallery </option>

</select>	
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

<div class="form-group" id="offer_title" style="display:none;">
<label for="icode" class="col-md-3 control-label">Offer Title</label>
<div class="col-md-9">
<input class="form-control" name="image_title" value="<?=(isset($listing_edit_images[0]['image_title'])!='')?$listing_edit_images[0]['image_title']:''?>" placeholder="Offer Title" type="text">
</div>
</div>

<div class="form-group" style="display:block;">
			<label for="icode" class="col-md-3 control-label">Description</label>
			<div class="col-md-9">
			<textarea class="form-control ckeditor" rows="5" cols="10" name="description" placeholder="Description" type="text"><?=(isset($listing_edit_images[0]['description'])!='')?$listing_edit_images[0]['description']:''?></textarea>
			</div>
			</div>
			
			

<div class="form-group" style="display:none;">
<label for="icode" class="col-md-3 control-label">Sort order</label>
<div class="col-md-9">
<input class="form-control" name="sort_order" value="<?=(isset($listing_edit_images[0]['sort_order'])!='')?$listing_edit_images[0]['sort_order']:''?>" placeholder="Sort Order" type="text">
</div>
</div>
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
<script>
$(window).load(function (){
	showtitle('<?=$listing_edit_images[0]['category_id']?>');
	});
	
</script>

</body>
</html>

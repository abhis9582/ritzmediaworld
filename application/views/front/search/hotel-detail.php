<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="author" content="CT Hotel">
<title><?php echo $SupportSingleData[0]['listing_title']?></title>
<meta name="description" content="<?php echo $SupportSingleData[0]['listing_title']?>">
<meta name="keyword" content="<?php echo $SupportSingleData[0]['listing_title']?>">
<?php $this->load->view("Element/front/header_common.php");?>

</head>

<body>
<?php $this->load->view("Element/front/header.php");?>

<section class="main-header">
<?php 
$Gallery = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2000');
$Activities = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2001');
$Offers = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2002');
$Features = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2003');
$Banner = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2004');
$CampGallery = $this->listing_model->getALLHotelImageByCategory($SupportSingleData[0]['id'],'2005');
if(count($Banner) > 0) { ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<?php $i=0; foreach($Banner as $BannerData){ ?>
<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i?>" <?php echo ($i==0)?'class="active"':''?>></li>
<?php  $i++; } ?>
</ol>
<div class="carousel-inner" style="height:150px;">
<?php $i=1; foreach($Banner as $BannerData){ 

$src = $this->image->getImageSrc("listings",$BannerData['image_name'],DEFAULT_HEADER_BANNER);
?>
<div class="carousel-item <?php echo ($i==1)?'active':''?>">
<img src="<?php echo $src?>" class="d-block w-100" alt="Banner <?php echo $i?>">
</div>
<?php $i++; } ?>
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>

<?php  } ?>
<!--nav-->

<?php echo home_header_menu();?>
<!--end of nav-->
</section>

<!--end of header-->

<!--start book form-->

<!--start book form-->
<div class="book-form-vertical">
<!--div class="container">
<div class="row">
<div class="book-form book-form-home">
<form method="post" id="searchF2" autocomplete="off" action="<?php echo BASE_URL?>search-hotel">
<div class="form-row">
<div class="form-group">
<select name="city" required id="city" class="form-control" onchange="return getHotelByCity2(this.value)">
	<option value="">Select Location</option>
	<?php $AllCity = $this->listing_model->GetALLEnableCity();
	foreach($AllCity as $CityData){ 
	$all_hotel = $this->commonmod_model->getHotelByCity($CityData['id']);
									
									if(count($all_hotel) > 0){
	?>
		<option value="<?php echo $CityData['id']?>"><?php echo $CityData['name']?></option>
	<?php }  }
	?>
	 </select>
</div>

<div class="form-group">
<select class="form-control" required  autocomplete="off" name="listing_id" id="listing_id">
<option value="">Select Hotel</option>
</select>
</div>

<div class="form-group">
<div class="form-wrap">
<input type="text" class="form-control fromdatepicker" required autocomplete="off"   name="start_date" placeholder="Arrival Date">
<span class="data-time-picker-arrow"></span>
</div>
</div>

<div class="form-group">
<div class="form-wrap">
<input type="text" class="form-control todatepicker" required autocomplete="off"   name="end_date" placeholder="Departure Date">
<span class="data-time-picker-arrow"></span>
</div>
</div>
<div class="form-group">
<div class="form-wrap">
<input type="submit" class="submit-btn"  name="submit" value="Book Now">
<span class="data-time-picker-arrow1"></span>
</div>
</div>
</form>
</div>
</div>
</div>
</div-->


<!--end of book form-->


<!--nav-->

<nav class="navbar navbar-expand-lg navbar-light bg-light crystal-navbar sticky-top" id="main_navbar1">
<div class="container">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
<ul class="navbar-nav justify-content-center">
<?php  if(!empty($SupportSingleData[0]['listing_description'])) { ?>
<li><a class="nav-item nav-link nav-item1" href="#about-us">About Us</a></li>
<?php  } if(!empty($SupportSingleData[0]['camp_desc'])  || count($CampGallery)>0) { ?>
<li><a class="nav-item nav-link nav-item1" href="#surrounding">Surrounding</a></li>
<?php  } if(!empty($SupportSingleData[0]['listing_video'])) { ?>
<li><a class="nav-item nav-link nav-item1" href="#video1">Camp Video</a></li>
<?php  } if(!empty($SupportSingleData[0]['policies']) ) { ?>
<li><a class="nav-item nav-link nav-item1" href="#policies">Policies</a></li>
<?php  } if(!empty($SupportSingleData[0]['accomodation']) ) { ?>
<li><a class="nav-item nav-link nav-item1" href="#accomodation">Accomodation</a></li>
<?php  } if(!empty($SupportSingleData[0]['activities']) || count($Activities)>0) { ?>
<li><a class="nav-item nav-link nav-item1" href="#activities">Activities</a></li>
<?php  } if(count($Gallery)>0){ ?>
<li><a class="nav-item nav-link nav-item1" href="#gallery">Gallery</a></li>
<?php  } if(!empty($SupportSingleData[0]['tarrif_desc'])) { ?>
<li><a class="nav-item nav-link nav-item1" href="#reservation">Tariff & Reservation</a></li>

<?php  } if(count($Offers)>0){ ?>

<li><a class="nav-item nav-link nav-item1" href="#main-offer">Offers</a></li>
<?php  } if(count($Features)>0  || !empty($SupportSingleData[0]['property_features'])){ ?>
<li><a class="nav-item nav-link nav-item1" href="#features">Features</a></li>
<?php  } if(!empty($SupportSingleData[0]['address']) || !empty($SupportSingleData[0]['email_id']) ||  !empty($SupportSingleData[0]['phone_number']) || !empty($SupportSingleData[0]['mobile_number'])
) { ?>
<li><a class="nav-item nav-link nav-item1" href="#contact">Contact Us</a></li>
<?php  } ?>
</ul>

</div>
</div>
</nav>

<!--end of nav-->

<!--start tab content-->

<!--start about-us section-->
<?php  if(!empty($SupportSingleData[0]['listing_description'])){ ?>
<section class="about-us-section main-crystal1" id="about-us">
<div class="container">
<div class="row row1">
<h1>About Us</h1>
</div>
<?php $src = $this->image->getImageSrc("listings",$SupportSingleData[0]['listing_image1'],"./webroot/front/images_not_found.jpg");?>
	<?php $class = ($SupportSingleData[0]['listing_image1']!="")?'col-lg-8':'col-lg-12'?>			
<div class="row row2 Surrounding_div">
<?php  if($src !=""){ ?>
<div class="col-lg-4">
<div class="about-img">
<img src="<?php echo $src?>" class="img-fluid">
</div>
</div>
<?php  } ?>

<div class="<?php echo $class?>">
<?php echo $SupportSingleData[0]['listing_description']?>
</div>
</div>
</div>
</section>
<?php  } ?>

<!--end of about-us section-->

<!--start surrounding-section-->

<?php  if(!empty($SupportSingleData[0]['camp_desc'])){ ?>
<section class="about-us-section" id="surrounding">
<div class="container">

<div class="row row1">
<h1>Surrounding</h1>
</div>
<?php $src = $this->image->getImageSrc("listings",$SupportSingleData[0]['listing_image2'],"./webroot/front/images_not_found.jpg");?>
	<?php $class = ($SupportSingleData[0]['listing_image2']!="")?'col-lg-12':'col-lg-7'?>	
<div class="row row2 Surrounding_div">
	<div class="col-8"><?php echo $SupportSingleData[0]['camp_desc']?></div>
	<div class="col-4">
		<?php  if($src!=""){ ?>
		<img src="<?php echo $src;?>" class="img-fluid surrounding_pic" alt="...">
		<?php  } ?>
	</div> 
</div>
</div>
</section>

<?php if(count($CampGallery) > 0){ ?>
<section class="about-us-section" id="campgallery" style="padding:0 0 50px 0;">
<div class="container">
<div class="row row1">
</div>
<div class="row">
<div class="owl-carousel sariska-gallery-carousel owl-theme">
<?php  foreach($CampGallery as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	?><div class="item">
<div class="img-col">
<figure><img src="<?php echo $src?>" class="img-fluid">
<div class="overflow"></div>
</figure>

<h2><?php echo $Actvitiedata['image_title']?></h2>

</div>
</div>

<?php  } ?>
</div>
</div>
</div>
</section>

<?php  } } ?>


<?php  if(!empty($SupportSingleData[0]['listing_video'])){ 
$src = $this->image->getImageSrc("listings/video",$SupportSingleData[0]['listing_video'],"./webroot/front/images_not_found.jpg");
?>
<section class="about-us-section" id="video1">
<div class="container">

<div class="row row1">
<h1 class="videos">Camp Video</h1>
</div>
<?php $src = $this->image->getImageSrc("listings/video",$SupportSingleData[0]['listing_video'],"./webroot/front/banner_vid.mp4");?>
<div class="row row2">
<div class="media"> 
<video  src="<?php echo $src;?>" controls="controls" type="video/mp4" autoplay="false"></video>

</div>
</div> 
</div>
</section>
<?php  } ?>


<!--end of surrounding section-->


<!--start activities section-->

<?php  if(!empty($SupportSingleData[0]['accomodation'])){ ?>

<section class="about-us-section" id="accomodation">
<div class="container">

<div class="row row1">
<h1>Accomodation</h1>
<div class="col-lg-12">
<?php echo $SupportSingleData[0]['policies']?>
</div>
</div>
</div>
</section>


<?php  } if(!empty($SupportSingleData[0]['policies'])){ ?>
<section class="about-us-section" id="policies">
<div class="container">

<div class="row row1">
<h1>Policies</h1>
<div class="col-lg-12">
    <p>&nbsp;</p>
<?php echo $SupportSingleData[0]['policies']?>
</div>
</div>
</div>
</section>



<?php  } 
if(!empty($SupportSingleData[0]['activities']) || count($Activities)> 0){ ?>
<section class="about-us-section" id="activities">
<div class="container">

<div class="row row1">
<h1>Activities</h1>
<div class="col-lg-12">
    <p>&nbsp;</p>
<?php echo $SupportSingleData[0]['activities']?>
</div>
</div>

<div class="row row2">
<div class="owl-carousel activity-carousel owl-theme">
<?php  foreach($Activities as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	?>
<div class="item">
<div class="img-col">
<figure><img src="<?php echo $src?>" class="img-fluid">
<div class="overflow"></div>
</figure>

<h2><?php echo $Actvitiedata['image_title']?></h2>

</div>
</div>
<?}?>
</div>
</div>
</div>
</section>

<?php  } ?>
<!--end of activities section-->

<!--start gallery section-->
<?php  if(count($Gallery) > 0){ ?>
<section class="about-us-section" id="gallery" style="padding:50px 0;">
<div class="container">
<div class="row row1">
<h1>Our Gallery</h1>
</div>
<div class="row row2">
<div class="owl-carousel sariska-gallery-carousel owl-theme">
<?php  foreach($Gallery as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	?>
<div class="item">
<div class="gallery-image" data-toggle="modal" data-target="#gallery-modal1<?php echo $Actvitiedata['id']?>">
<figure><img src="<?php echo $src?>" class="img-fluid"></figure>
</div>
</div>

<?php  } ?>


</div>

<?php  foreach($Gallery as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	?>
<div class="modal fade" id="gallery-modal1<?php echo $Actvitiedata['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<img src="<?php echo $src?>">
</div>
</div>
</div>
</div>
<?php  } ?>


</div>


</div>

</div>
</section>

<?php  } ?>
<!--end of gallery section-->


<!--start of tariff section-->
<?php if(!empty($SupportSingleData[0]['tarrif_desc'])){ ?>
<section class="about-us-section" id="reservation">
<div class="container">

<div class="row row1">
<h1>Tariff & Reservation</h1>
</div>

<div class="row row2">
<div class="col-lg-12">
<div class="left-col">
<?php echo html_entity_decode($SupportSingleData[0]['tarrif_desc']);?>
</div>
</div>

</div>



</div>
</section>
<?}?>
<!--end of tariff section-->

<!--start features section-->

<?php if(!empty($SupportSingleData[0]['property_features'])){ ?>
<section class="about-us-section" id="features">
<div class="container">
<div class="row row1">
<h1>Our Features</h1>
</div>

<div class="row row2"><?php echo html_entity_decode($SupportSingleData[0]['property_features'])?></div>

<div class="row row3">
<div class="owl-carousel features-carousel owl-theme">
<?php  foreach($Features as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	?>
<div class="item">
<div class="content">
<div class="image"><img src="<?php echo $src;?>" class="img-fluid">
<div class="heading"><h2><?php echo $Actvitiedata['image_title']?></h2></div>
</div>
</div>
</div>
<?php  } ?>

</div>
</div>
</div>
</section>

<?php  } ?>
<!--end of features section-->


<?php if(count($Offers) > 0){ ?>
<section class="about-us-section" id="main-offer">
<div class="container">
<div class="row row1">
<h1>Our Offers</h1>
</div>

<div class="row row3">
    <p>&nbsp;</p>
<div class="owl-carousel features-carousel owl-theme">
<?php  foreach($Offers as $Actvitiedata){
	$src = $this->image->getImageSrc("listings",$Actvitiedata['image_name'],"./webroot/front");
	$Actvitiedata['image_title'] = ($Actvitiedata['image_title']=='')?'latest':$Actvitiedata['image_title'];
	?>
<div class="item">
<div class="content">
<div class="image"><a href="<?=BASE_URL?>offers/<?=create_url($Actvitiedata['image_title'])?>/<?=$Actvitiedata['id']?>"><img src="<?php echo $src;?>" class="img-fluid"></a>
<div class="heading"><h3><?php echo $Actvitiedata['image_title']?></h3></div>
</div>
</div>
</div>
<?php  } ?>

</div>
</div>
</div>
</section>

<?php  } ?>


<!--start contact us-section-->

<?php  if(!empty($SupportSingleData[0]['map']) || !empty($SupportSingleData[0]['address']) || !empty($SupportSingleData[0]['email_id']) ||  !empty($SupportSingleData[0]['phone_number']) || !empty($SupportSingleData[0]['mobile_number'])
) { ?>
<section class="about-us-section" id="contact">
<div class="container">

<div class="row">


<div class="col-lg-12 hotel_contat_box"> 
<h2><?php echo $SupportSingleData[0]['listing_title']?></h2>
<ul>
<?php if(!empty($SupportSingleData[0]['address'])) {?>
<li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span><?php echo $SupportSingleData[0]['address']?></span></li>

<?php } if(!empty($SupportSingleData[0]['email_id'])) {?>
<li><i class="fa fa-envelope"></i>&nbsp;&nbsp;<span><a href="mailto:<?php echo $SupportSingleData[0]['email_id']?>"><?php echo $SupportSingleData[0]['email_id']?></a></span></li>

<?php  } if(!empty($SupportSingleData[0]['phone_number'])) {?>
<li><i class="fa fa-phone"></i>&nbsp;&nbsp;<span><a href="tel:<?php echo $SupportSingleData[0]['phone_number']?>"><?php echo $SupportSingleData[0]['phone_number']?></a></span></li>
<?php  } ?>
<?php if(!empty($SupportSingleData[0]['mobile_number'])) {?>
<li><i class="fa fa-mobile"></i>&nbsp;&nbsp;<span><a href="tel:<?php echo $SupportSingleData[0]['mobile_number']?>"><?php echo $SupportSingleData[0]['mobile_number']?></a></span></li>
<?php  } ?>
</ul> 
</div>
<div class="col-lg-12 hotel_contat_box">
<?php echo html_entity_decode(stripslashes($SupportSingleData[0]['map']))?>
</div>

</div>
</div>
</section>
<?php  } ?>
<!--end of contact us- section-->





<!--end of tab content-->


<script>
function getHotelByCity(cityid) {

$.ajax({
url : <?php echo base_url('content/show_hotel_ajax'); ?>,
type: "POST",
data: {'city':cityid },
dataType: 'json',
success: function(data){

$("#listing_id").html(data);

}, 
error: function(){
alert("there is error");
}
});

}
</script>



<?php $this->load->view("Element/front/footer_home.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
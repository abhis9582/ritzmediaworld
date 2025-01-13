<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Bhalaai">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>






<!--gallery-->
<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>SEARCH RESULT :</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / SEARCH RESULTS</p>
</div>

</div>
</div><!--second-head-->


<div class="gallery2">  



<div class="container">
<?php  if(count($SupportData)>0){ 
        foreach($SupportData as $SupoortdataOne){ 
	
		$src = $this->image->getImageSrc("listings",$SupoortdataOne['listing_image1'],"./webroot/front/images_not_found.jpg"); 
		$VideoSrc = $this->image->getVideoSrc("listings/video",$SupoortdataOne['listing_video'],"");
		?>
<div class="box1 col-md-3">
<a href="<?=BASE_URL?>listing-detail/<?=$SupoortdataOne['id']?>"><img src="<?=$src?>" alt="">
<p><?=$SupoortdataOne['listing_title']?></p></a>
</div>
<?php  } } ?>
</div>
</div><!--gallery-->


<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
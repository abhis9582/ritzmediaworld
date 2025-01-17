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


<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],""); ?>
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
					  
                    <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="javascript:void();"><?=$Content[0]['page_heading']?></a></li>
                    

                   
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<!--end of about-us section1-->

<!--start contactus-content-->
  <?php   $HowITWORKSDATA =  $this->howitworks_model->getALLHowItworksBycategoryId(2);?>
			 <?php if(count($HowITWORKSDATA) > 0){ $i=1; ?>
<section class="contactus-section">
	
	<div class="container">
		<div class="row row1">
			<div class="col-lg-12">

                <div class="panel-group" id="accordion">
          <?
				 foreach($HowITWORKSDATA as $howitworksData){ ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                               <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$i?>"><?=$howitworksData['title'];?></a>
                            </h4>
                        </div>
                         <div id="collapseOne<?=$i?>" class="panel-collapse collapse <?=($i==1)?'show':''?>">
                        <div class="container">
                            <div class="row"><br>
                          	 <?php   if($howitworksData['howitworks_image1']!="" || $howitworksData['youtube_video']!=""){ ?>
                            <div class="col-sm-12"><?php $src = $this->image->getImageSrc("blogs",$howitworksData['howitworks_image1'],"");
							 if($howitworksData['howitworks_image1']!="" ){
							?>
             
							<img src="<?=$src?>" class="img-responsive" /> <br>
							 <?php } 
							 if($howitworksData['youtube_video']!="") { ?>
							<iframe  src="<?=$howitworksData['youtube_video']?>" frameborder="0" allowfullscreen></iframe>
							<?php } ?>
							</div>
							 <?php } ?>
                            
                            <div class="panel-body">
                                  <?=html_entity_decode($howitworksData['description']);?> </div></div>
                                </div> 
                         </div>
                    </div>
                    <!-- /.panel -->
			 <?php $i++; }   ?>
                    
                    
                    
    
                </div>
                <!-- /.panel-group -->
            </div>
            <!-- /.col-lg-12 -->
        </div><!--row-->
  </div><!--container-->
</section>
<?php } ?>


<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
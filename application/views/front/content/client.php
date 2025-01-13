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
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1491326822260603');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1491326822260603&ev=PageView&noscript=1" />
        </noscript>
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>


<div class="clearfix"></div>
 <?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
 
 <!--start about-us section1-->
<section class="aboutus-section1" style="background: url(<?=$src?>);">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left">
					<h1 class="events">Clients</h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Clients</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
<!--end of about-us section1-->
 
 
 
 
<!--div class="banner-area pdt100 pdb100" style="background: url(<?=$src?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <div class="sliderText" style="margin-top:60px;">
		<?php if($Content[0]['heading_title']!=""){ ?>
                <h1><?php $head = strip_tags($Content[0]['heading_title']);
				echo (strlen($head) > 20)?substr($head,0,20):$head;
				?></h1>
		<?php } ?>
            
               <?php if($Content[0]['heading_description']!=""){ ?>
			   <h3><?php $headdes =strip_tags($Content[0]['heading_description']); 
			   
			   echo (strlen($headdes) > 100)?substr($headdes,0,100).'...':$headdes;
			   ?></h3>
			   <?php } ?>
			    <?php if($Content[0]['read_more_link']!=""){ ?>
                 <a href="<?=$Content[0]['read_more_link']?>" class="btn btn-default btn-lg redBttn"><?=strip_tags($Content[0]['read_more_text'])?></a>
				<?php } ?>
              </div>
                </div>
            </div>
        </div>
    </div-->
	
  

<section class="our-team-page">
<div class="container"> 
<div class="row row3">
                <?php  foreach($Client as $GalleryData) { ?>
                  <div class="col-md-3 text-center">
                <div class="thumbnail_client">
                <?php  $src = $this->image->getImageSrc("gallery",$GalleryData['image_name'],"");?>
                <img class="img-responsive" src="<?=$src?>"/>
                 </div>
            </div>
                <?php }?>
        </div> 
    </div> 
</section>
<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
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
<?php $this->load->view("Element/front/header_common.php");?>

<style>

.login_images img { border-radius:10px; }
.login_text h3,h4 { color:#e17f0b;  font-weight:900;}
.user_frontlook { background:white; border-radius:10px;  }



@media (min-width: 768px) 
{
	.login_images img { width:150px;  }
	.user_frontlook { padding:10px; }
}
@media (min-width: 992px) 
{
	.login_images img { width:150px;  }
	.user_frontlook { padding:20px; }
	
}
@media (min-width: 1200px) 
{
	.login_images img { width:250px;  }
	.ppp1 { display:inline; }
	.ppp2 { display:inline; }
	.ppp3 { display:inline; }
	.ppp4 { display:inline; }
	.ppp5 { display:inline; }
	.user_frontlook { padding:50px; }
  
}




</style>


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
						<li class="breadcrumb-item active" aria-current="page">My Account</li>
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
            <div class="col-lg-9"></div>
        </div>
    </div>
</section>

 





<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
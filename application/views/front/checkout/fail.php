<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?=META_AUTHOR?>">
<title><?=@$Content[0]['meta_title']?></title>
<meta name="description" content="<?=@$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=@$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>

<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1>Payment Fail</h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Payment Fail</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>


   
<section class="section1">
  <div class="container" style="height:400px;">
    <div class="row">
  
      <div class="col-sm-12 text-center">     
             <p style="font-size:25px;"><em>Thankyou, You have not placed booking, Please check again. </em></p><br>
      </div><!--col-sm-12-->
    </div><!--row-->
  </div><!--container-->
</section>


<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
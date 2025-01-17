<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Bhalaai">
	<title><?= $Content[0]['meta_title'] ?></title>
	<meta name="description" content="<?= $Content[0]['meta_description'] ?>">
	<meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
	<?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>


	<!--start about-us section1-->

	<section class="aboutus-section1">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-6">
					<div class="about-left">
						<h1><?= $Content[0]['page_title'] ?></h1>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="about-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?= $Content[0]['page_title'] ?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--end of about-us section1-->

	<!--start our-team page-->

	<!-- <section class="about1-content">
	<div class="container">
	<?php if (count($OurTeam1) > 0) { ?>
		
	<div class="row row1">
		<div class="col-lg-12">
			<div class="about1-col">
				<h1>BOARD OF DIRECTORS</h1>
				<?php foreach ($OurTeam1 as $OurData) {
					$src = $this->image->getImageSrc("gallery", $OurData['image_name'], "/webroot/front/images_not_found.jpg");
					?>
					<div class="dir_profile">
						<div class="item">
							<div class="image"><img src="<?= $src ?>" class="img-fluid"></div>
							<h5><?= $OurData['image_tittle'] ?></h5>
							<p><?= $OurData['banner_description'] ?></p>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>	
	</div>
	<?php } ?>
		
		<?php if (count($OurTeam2) > 0) { ?>
		
		<div class="row row1">
		<div class="col-lg-12">
			<div class="about1-col">
				<h1>Advisory Panel</h1>
				<?php foreach ($OurTeam2 as $OurData) {
					$src = $this->image->getImageSrc("gallery", $OurData['image_name'], "/webroot/front/images_not_found.jpg");
					?>
					<div class="dir_profile">
						<div class="item">
							<div class="image"><img src="<?= $src ?>" class="img-fluid"></div>
							<h5><?= $OurData['image_tittle'] ?></h5>
							<p><?= $OurData['banner_description'] ?></p>        					
						</div>
					</div>
				<?php } ?>
			</div>	
		</div>	
		</div>
	<?php } ?>
	
	<?php if (count($OurTeam3) > 0) { ?>
		
		<div class="row row1">
		<div class="col-lg-12">
			<div class="about1-col">
				<h1>Operations Team</h1>
		<?php foreach ($OurTeam3 as $OurData) {
			$src = $this->image->getImageSrc("gallery", $OurData['image_name'], "/webroot/front/images_not_found.jpg");
			?>
			<div class="dir_profile">
				<div class="item">
					<div class="image"><img src="<?= $src ?>" class="img-fluid"></div>
					<h5><?= $OurData['image_tittle'] ?></h5>
					<p><?= $OurData['banner_description'] ?></p>
					
				</div>
			</div>
		<?php } ?>
		</div>	
		</div>	
		</div>
	<?php } ?>
				
			
		</div>
</section> -->


	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
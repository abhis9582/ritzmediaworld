<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?= $Content[0]['meta_title'] ?></title>
	<meta name="description" content="<?= $Content[0]['meta_description'] ?>">
	<meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php $this->load->view("Element/front/header_common.php"); ?>

</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>


	<div class="clearfix"></div>
	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>


	<!--start about-us section1-->
	<!--start about-us section1-->
	<section class="aboutus-section1" style="background: url(<?= $src ?>);">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-6">
					<div class="about-left">
						<h1 class="events"><?= $Content[0]['page_title'] ?></h1>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="about-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?= $Content[0]['page_title'] ?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--start contactus-content-->
	<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>

	<section class="our-team-page">
		<div class="container">
			<div class="row row1">
				<!--h2 class="title"><?= $Content[0]['page_heading'] ?></h2-->


				<!--div class="col-sm-9 nopadding"><?= $Content[0]['page_description'] ?></div>
		<div class="col-sm-3 nopadding"><img src="webroot/images/partner.png" class="vision_image1" /></div-->

				<!--
		<div class="col-md-6">
		<?php $src = $this->image->getImageSrc("pages", $Content[0]['page_image1'], DEFAULT_HEADER_BANNER); ?>
		<img src="<?= $src ?>" alt="<?= $Content[0]['page_heading'] ?>">
		</div>
		<div class="col-md-6">
		<?php $src = $this->image->getImageSrc("pages", $Content[0]['page_image2'], DEFAULT_HEADER_BANNER); ?>
		<img src="<?= $src ?>" alt="<?= $Content[0]['page_heading'] ?>">
		
		</div>
		-->

				<?php
				if (validation_errors())
					echo '<div class="error" id="FLASH" name="FLASH">' . validation_errors() . '</div>';
				if ($this->session->flashdata("error")) {
					echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata("error") . '</div>';
				} else if ($this->session->flashdata("success")) {
					echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata("success") . '</div>';
				}
				if (isset($_SESSION['error'])) {
					unset($_SESSION['error']);
				} else if (isset($_SESSION['success'])) {
					unset($_SESSION['success']);
				}
				?>
				<form class="p-3" action="<?= BASE_URL . 'enquiries.html' ?>" method="post" enctype="multipart/form-data">
					<input name="submit_contact" type="hidden" value="1" />
					<input name="user_id" type="hidden" value="0" />

					<div class="form-row">
						<div class="col-md-12">
							<h2>Reach Out To Us</h2>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<input type="text" required name="name" class="form-control" id="inputEmail4"
								placeholder="Name" required>
						</div>
						<div class="form-group col-md-6">
							<input type="email" required name="email" class="form-control" id="inputPassword4"
								placeholder="Email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="text" required name="mobile_number" class="form-control" id="inputEmail4"
								placeholder="Mobile Number" pattern="[0-9]{10}" required>
						</div>
						<div class="form-group col-md-12">
							<textarea required name="property" class="form-control" id="inputEmail4"
								placeholder="Enter Property Name"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<textarea required name="message" class="form-control" id="inputEmail4"
								placeholder="Enter Message">
							</textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<div class="g-recaptcha" data-sitekey="6Ldke1gqAAAAAOt1CC4uheHxO0ujjUfb248kqqS_"></div>
						</div>
					</div>
					<input type="submit" class="btn" name="Submit" value="Submit">
				</form>
			</div>
		</div>
	</section>

	<!--end of our-team page-->

	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
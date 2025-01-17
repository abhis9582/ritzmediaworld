<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Bhalaai">
	<title><?= $Content[0]['meta_title'] ?></title>
	<meta name="description" content="<?= $Content[0]['meta_description'] ?>">
	<meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
	<?php $this->load->view("Element/front/header_common.php"); ?>

</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>


	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>


	<!--start about-us section1-->

	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>
	<section class="aboutus-section1" style="background: url(<?= $src ?>);">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-6">
					<div class="about-left contact-left">
						<h1><?= $Content[0]['page_heading'] ?></h1>
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

	<!--end of about-us section1-->

	<!--start contactus-content-->
	<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>

	<section class="our-team-page">
		<div class="container">
			<div class="row row1">
				<?= $Content[0]['page_description'] ?>

				<?php
				if (validation_errors()) {
					echo '<div class="error" id="FLASH" name="FLASH">' . validation_errors() . '</div>';
				}
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
				<div class="d-flex justify-content-center">
					<div class="col-md-8">
						<form class="p-3" action="<?= BASE_URL . 'career.html' ?>" method="post"
							enctype="multipart/form-data">
							<input name="submit_contact" type="hidden" value="1" />
							<input name="user_id" type="hidden" value="0" />

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
								<div class="form-group col-md-6">
									<input type="number" required class="form-control" name="mobile_number"
										id="inputEmail4" placeholder="Mobile No." required>
								</div>
								<div class="form-group col-md-6">
									<select id="inputState" name="post_apply" class="form-control">
										<option selected>Apply For..</option>
										<option>Sales</option>
										<option>Marketing</option>
										<option>Reservation</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<input type="file" name="cv" class="form-control-file" id="exampleFormControlFile1">
							</div>
							<div class="form-group">
								<textarea class="form-control" required rows="4" name="message"
									placeholder="Query"></textarea>
							</div>
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="6Ldke1gqAAAAAOt1CC4uheHxO0ujjUfb248kqqS_"></div>
							</div>
							<input type="submit" class="btn" name="Submit" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--end of our-team page-->

	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
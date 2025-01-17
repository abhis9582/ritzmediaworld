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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>
	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>
	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>
	<section class="aboutus-section1">
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

	<!--start contactus-content-->
	<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>
	<section class="contactus-section">
		<?= $Content[0]['page_short_description'] ?>
		<div class="container">
			<div class="row row1 d-flex justify-content-center mt-3">
				<div class="col-md-5">
					<?php
					if (validation_errors())
						echo '<div class="error" id="FLASH" name="FLASH" style="color:red;">' . validation_errors() . '</div>';
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
					<div class="left-col">
						<?= $Content[0]['page_description'] ?>
						<br>
						<form action="<?= BASE_URL . 'contact.html' ?>" method="post">
							<input name="submit_contact" type="hidden" value="1" />
							<input name="user_id" type="hidden" value="0" />
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input type="text" name="name" class="form-control" id="exampleInputEmail1"
									aria-describedby="emailHelp" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">E-mail</label>
								<input type="email" name="email" class="form-control" id="exampleInputPassword1"
									required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Mobile No.</label>
								<input type="text" name="mobile_number" class="form-control" id="exampleInputPassword1"
									pattern="[0-9]{10}" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Query</label>
								<textarea class="form-control" name="message" rows="4" required></textarea>
							</div>
							<div class="g-recaptcha" data-sitekey="6Ldke1gqAAAAAOt1CC4uheHxO0ujjUfb248kqqS_"></div>
							<input type="submit" class="btn btn-primary" value="Submit">
						</form>
					</div>
				</div>
				<div class="col-md-5 my-auto">
					<div class="right-col">
						<h5>Corporate Office:</h5>
						<h6><?= $Systemdata[0]['website_name'] ?></h6>
						<p><i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?= $Systemdata[0]['website_address'] ?></p>
						<p class="mobile"><i class="fa fa-mobile"></i>&nbsp;&nbsp;<a
								href="tel:<?= $Systemdata[0]['phone_number'] ?>"><?= $Systemdata[0]['phone_number'] ?></a>&nbsp;&nbsp;
							<a
								href="tel:<?= $Systemdata[0]['mobile_number'] ?>"><?= $Systemdata[0]['mobile_number'] ?></a>
						</p>
						<ul>
							<li><i class="fa fa-envelope"></i>&nbsp;&nbsp;
								<a
									href="mailto:<?= $Systemdata[0]['website_email_id'] ?>"><?= $Systemdata[0]['website_email_id'] ?></a>
							</li>
							<li><i class="fa fa-globe"></i>&nbsp;&nbsp;<a
									href="<?= $Systemdata[0]['website_url'] ?>"><?= $Systemdata[0]['website_url'] ?></a>
							</li>
						</ul>
						<?= $Content[0]['heading_description'] ?>
					</div>
				</div>
			</div>
		</div>
		<h2 class="text-center mt-3" style="color:#915a00;">Our Location</h2>
		<div class="map-container">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3506.2210737021164!2d77.40871997528409!3d28.502995675735733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce530165cc6c1%3A0x9ea28df462e9945e!2sRitz%20Media%20World-Digital%20Marketing%20Agency%20in%20Noida%20%7C%20Social%20Media%20Agency%20in%20Noida%20%7C%20Newspaper%20%26%20Radio%20Ad%20Agency%20in%20Noida!5e0!3m2!1sen!2sin!4v1736328116798!5m2!1sen!2sin"
				width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>
	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
</body>

</html>
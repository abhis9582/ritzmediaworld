<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<title><?php echo $Content[0]['meta_title'] ?></title>
	<meta name="description" content="<?php echo $Content[0]['meta_description'] ?>">
	<meta name="keyword" content="<?php echo $Content[0]['meta_keywords'] ?>">
	<?php $this->load->view("Element/front/header_common.php"); ?>
</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>
	<div class="clearfix"></div>
	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>


	<!--start about-us section1-->

	<section class="aboutus-section1" style="background: url(<?= $src ?>);">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-6">
					<div class="about-left">
						<?php if ($noRecordFound) { ?>
							<h1 class="concept"><?php echo $noRecordFound; ?></h1>
						<?php } ?>
						<h1 class="concept"><?= $Content[0]['page_heading'] ?></h1>
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

	<!--start our-team page-->

	<section class="about1-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php if ($noRecordFound) { ?>
						<?php echo $noRecordFound; ?>
					<?php } ?>
					<?= html_entity_decode($Content[0]['page_description']) ?>
				</div>

			</div>
	</section>
	<!--end of our-team page-->

	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
</body>

</html>
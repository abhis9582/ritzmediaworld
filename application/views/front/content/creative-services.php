<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="RMW">
	<title><?= $Category[0]['meta_title'] ?></title>
	<meta name="description" content="<?= $Category[0]['meta_description'] ?>">
	<meta name="keyword" content="<?= $Category[0]['meta_keywords'] ?>">
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
						<h1><?= $Category[$id - 1]['category_name'] ?></h1>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">
									<?= $Category[$id - 1]['category_name'] ?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--end of about-us section1-->
	<div class="container">
		<?php
		$this->db->select('*');
		$this->db->from('bh_menu_list');
		$this->db->where('status', '1');
		$menu_list = $this->db->get()->result_array();
		?>
		<div class="row">
			<div class="container">
				<div class="row">
					<?php foreach ($menu_list as $list) {
						if ($list['category_id'] == $id) {
							$url_title = create_url($list['menu_url']);
							?>
							<div class="col-md-3 col-sm-12">
								<div class="text-center h3 my-2">
									<a href="<?php echo BASE_URL . $url_title . '.html'; ?>">
										<div class="services-heading">
											<?php echo $list['menu_name']; ?>
										</div>
										<div class="my-2">
											<img class="w-100"
												src="<?php echo BASE_URL . '/webroot/services/' . $list['image'] ?>"
												alt="<?php echo $list['image'] ?>">
										</div>
									</a>
								</div>
							</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</div>


	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
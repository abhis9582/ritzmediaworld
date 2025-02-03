<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?= strip_tags($BlogData[0]['meta_title']) ?></title>
	<meta name="description" content="<?= strip_tags($BlogData[0]['meta_description']); ?>" />
	<meta name="keyword" content="<?= strip_tags($BlogData[0]['meta_keywords']); ?>" />
	<meta property="og:title" content=" <?= strip_tags($BlogData[0]['title']) ?>" />
	<meta property="og:description" content="<?= strip_tags($BlogData[0]['description']); ?>" />
	<meta property="og:image"
		content="<?php echo $this->image->getImageSrc("blogs", $BlogData[0]['blog_image1'], ""); ?>" />
	<meta name="author" content="Ritz Media World" />
	<?php $this->load->view("Element/front/header_common.php"); ?>
	<link rel="stylesheet" href="<?php echo FRONT_DIR ?>css/style.css">
</head>
<style>
	#loader {
		height: 100%;
		width: 100%;
		position: fixed;
		display: flex;
		justify-content: center;
		align-items: center;
		background: black;
		opacity: 0.8;
		z-index: 999;
		color: white;
		font-size: 30px;
		display: none;
	}
</style>

<body>
	<div id="loader">
		Loading...
	</div>
	<?php $this->load->view("Element/front/header.php"); ?>
	<?php $src = $this->image->getImageSrc("pages", $Content[0]['banner_image'], DEFAULT_HEADER_BANNER); ?>
	<section class="aboutus-section1" style="background: url(<?= $src ?>);">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-6">
					<div class="about-left contact-left">
						<h4 class="text-light"><?= Ucwords($BlogData[0]['title']) ?></h4>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-right">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="<?= BASE_URL ?>blogs">Blogs</a></li>
								<li class="breadcrumb-item active"><?= Ucwords($category_name[0]['category_name']) ?>
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
	<section class="contactus-section">
		<div class="container">
			<div class="row row1">
				<div class="col-lg-9">
					<div class="left-col">
						<div class="projects events-list">
							<?php  //print_r($Blogs);							
							$url_title = str_replace(" ", "", $BlogData[0]['title']);
							$url_title = strtolower($url_title);
							$day = date("d", strtotime($BlogData[0]['add_date']));
							$month = date("M", strtotime($BlogData[0]['add_date']));
							?>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<?php $src = 'webroot/images/blog_not_found.jpg';
								$imagename = $BlogData[0]['blog_image1'];
								$imgpath = $this->image->GetImageDirectory('blogs', $imagename);
								if ($imagename != "" && file_exists($imgpath . "/" . $imagename) == true) {
									$src = ($imagename) ? $imgpath . '/' . $imagename : "webroot/images/rap_temp.jpg";
								}
								?>
								<!-- <img src="<?= BASE_URL . $src ?>" class="img-responsive blog-img" <?php if ($BlogData[0]['img1_size']) {
										echo "style='width:" . $BlogData[0]['img1_size'] . "%'";
									} ?> alt="image"> -->
								<img src="<?= BASE_URL . $src ?>" class="img-responsive blog-img" alt="image">
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="media-body blog_main">
									<header class="post-heading">
										<div class="date-tag"><span><?= $day ?></span><?= $month ?></div>
										<!-- <h4 class="media-heading headingfont"><?= $BlogData[0]['title'] ?></h4> -->
									</header>
									<div class="addthis_inline_share_toolbox"></div>
									<div class="clearfix"></div>
									<p class="mt-4">
										<?= stripslashes($BlogData[0]['description']) ?>
									</p>
									<?php
									$y1_arr = json_decode($BlogData[0]['y1_size']);
									if (substr($BlogData[0]['youtube_video'], 0, 17) == 'https://youtu.be/') {
										$right_url = substr($BlogData[0]['youtube_video'], 17);
										$new_url = 'https://www.youtube.com/embed/' . $right_url;
										echo '<iframe style="width:';
										if ($y1_arr[0] != '') {
											echo $y1_arr[0] . 'px';
										} else {
											echo "400px";
										}
										echo ';height:';
										if ($y1_arr[1] != '') {
											echo $y1_arr[1] . 'px';
										} else {
											echo "250";
										}
										echo ';" src="' . $new_url . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
									} else if (substr($BlogData[0]['youtube_video'], 0, 24) == 'https://www.youtube.com/') {
										$right_url = substr($BlogData[0]['youtube_video'], 32, 11);
										$new_url = 'https://www.youtube.com/embed/' . $right_url;
										echo '<iframe style="width:';
										if ($y1_arr[0] != '') {
											echo $y1_arr[0] . 'px';
										} else {
											echo "560px";
										}
										echo ';height:';
										if ($y1_arr[1] != '') {
											echo $y1_arr[1] . 'px';
										} else {
											echo "400px";
										}
										echo ';" src="' . $new_url . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
									}
									?>

									<!-- Other Data -->

									<?php
									for ($i = 2; $i < 12; $i++) {
										$y_arr = json_decode($BlogData[0]['y' . $i . '_size']);
										if ($BlogData[0]['title' . $i] || $BlogData[0]['blog_image' . $i] || $BlogData[0]['youtube_video' . $i]) {
											?>
											<!-- IMAGE --> <?php // echo $i; ?> <!--AND DESCRIPTION--> <?php // echo $i; ?>
											<?php if ($BlogData[0]['blog_image' . $i]) { ?>
												<?php
												$src = 'webroot/images/blog_not_found.jpg';
												$imagename = $BlogData[0]['blog_image' . $i];
												$src = 'webroot/images/blogs/' . $imagename;
												?>
												<img src="<?= BASE_URL . $src ?>" class="img-responsive blog-img" <?php if ($BlogData[0]['img' . $i . '_size']) {
														echo "style='width:" . $BlogData[0]['img' . $i . '_size'] . "%'";
													} ?> alt="image">
											<?php } ?>
											<?php
											if ($BlogData[0]['title' . $i]) {
												?>
												<header class="post-heading">
													<!-- <div class="date-tag"><span><?= $day ?></span><?= $month ?></div> -->
													<h4 class="media-heading headingfont"><?= $BlogData[0]['title' . $i] ?></h4>
												</header>
												<div class="addthis_inline_share_toolbox"></div>
												<div class="clearfix"></div>
											<?php } ?>
											<?php if ($BlogData[0]['description' . $i]) { ?>
												<p>
													<?= stripslashes($BlogData[0]['description' . $i]) ?>
												</p>
											<?php } ?>
											<?php
											if ($BlogData[0]['youtube_video' . $i]) {
												if (substr($BlogData[0]['youtube_video' . $i], 0, 17) == 'https://youtu.be/') {
													$right_url = substr($BlogData[0]['youtube_video' . $i], 17);
													$new_url = 'https://www.youtube.com/embed/' . $right_url;

													echo '<iframe style="width:';
													if ($y_arr[0]) {
														echo $y_arr[0] . 'px';
													} else {
														echo "560px";
													}
													echo ';height:';
													if ($y_arr[1]) {
														echo $y_arr[1] . 'px';
													} else {
														echo "400px";
													}
													echo ';" src="' . $new_url . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
												} else if (substr($BlogData[0]['youtube_video' . $i], 0, 24) == 'https://www.youtube.com/') {
													$right_url = substr($BlogData[0]['youtube_video' . $i], 32, 11);
													$new_url = 'https://www.youtube.com/embed/' . $right_url;
													echo '<iframe style="width:';
													if ($y_arr[0]) {
														echo $y_arr[0] . 'px';
													} else {
														echo "560px";
													}
													echo ';height:';
													if ($y_arr[1]) {
														echo $y_arr[1] . 'px';
													} else {
														echo "400px";
													}
													echo ';" src="' . $new_url . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
												}
											}
											?>
											<br><br>
											<?php
										}
									}
									?>
									<div class="keywords_list d-flex flex-wrap">
										<?php
										$metaKeywords = $BlogData[0]['meta_keywords'];
										$keywordsArray = explode(',', $metaKeywords);
										foreach ($keywordsArray as $keyword) {
											$keyword = trim($keyword);
											if (!empty($keyword)) {
												$tag = strtolower(str_replace(' ', '-', $keyword));
												echo "<div class='meta_keywords'><a href='" . BASE_URL . "tags/" . $tag . "'>" . $keyword . "</a></div>";
											}
										}
										?>
									</div>

								</div>
							</div>
						</div>
						<br><br>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="form-container-fixed">
						<h2>Get In Touch</h2>
						<form id="popup-form12" method="post" onsubmit="submitForm(event)">

							<div class="form-group">
								<input type="text" id="name1" name="name" required placeholder="Your Name">
							</div>
							<div class="form-group">
								<input type="tel" id="mobile1" name="mobile" required placeholder="Your Mobile">
							</div>
							<div class="form-group">
								<input type="email" id="email1" name="email" required placeholder="Your Email">
							</div>
							<select class="pop-form-select" name="services" id="services1" required>
								<option selected>Select Service</option>
								<option value="print_advertising">Print Advertising</option>
								<option value="creative_services">Creative Services</option>
								<option value="radio_advertising">Radio Advertising</option>
								<option value="celebrity_endorsements">Celebrity Endorsements</option>
								<option value="digital_marketing">Digital Marketing</option>
								<option value="content_marketing">Content Marketing</option>
								<option value="web_designing_development">Web Designing & Development</option>
							</select>
							<div class="form-group">
								<textarea id="message1" name="message" required
									placeholder="Any specific requirement"></textarea>
							</div>
							<button type="submit" class="submit-btn">SUBMIT</button>
						</form>
					</div>
					<div class="widget widget_categories animated fadeInUp in" data-animation="fadeInUp" data-delay="0">
						<h4 class="mt-3"><b>Categories</b></h4>
						<ul>
							<?php
							foreach ($Category_list as $BlogCatData) {
								$cat_url_title = create_url($BlogCatData['category_name']);
								?>
								<li class="category-text-container d-flex mt-3">
									<a href="<?php if ($BlogCatData['id'] == "") {
										echo '#';
									} else {
										echo BASE_URL ?>category/<?= $cat_url_title;
									} ?>">
										<?= $BlogCatData['category_name'] ?>
										(<?= $this->commonmod_model->GetCountBlogBycategory($BlogCatData['id']); ?>)
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<?php if ($RecentBlogs[0]) {
						$i = 1;
						?>
						<div class="mt-5 thumb_post_list blog_list">
							<h4>Related Post</h4>
							<ul>
								<?php foreach ($RelatedBlogs as $rb) {
									if ($i < 6) {
										?>
										<?php $url_title = create_url($rb['slug_url']); ?>
										<li><a
												href="<?php echo BASE_URL; ?>blog/<?php echo $url_title; ?>"><?php echo ucwords($rb['title']); ?></a>
										</li>
										<?php $i++;
									} ?>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
					<div class="form-container-fixed">
						<h2>Get In Touch</h2>
						<form id="popup-form1" method="post" onsubmit="submitForm2(event)">
							<div class="form-group">
								<input type="text" id="name" name="name" required placeholder="Your Name">
							</div>
							<div class="form-group">
								<input type="tel" id="mobile2" name="mobile" required placeholder="Your Mobile">
							</div>
							<div class="form-group">
								<input type="email" id="email2" name="email" required placeholder="Your Email">
							</div>
							<select class="pop-form-select" name="services" id="services" required>
								<option selected>Select Service</option>
								<option value="print_advertising">Print Advertising</option>
								<option value="creative_services">Creative Services</option>
								<option value="radio_advertising">Radio Advertising</option>
								<option value="celebrity_endorsements">Celebrity Endorsements</option>
								<option value="digital_marketing">Digital Marketing</option>
								<option value="content_marketing">Content Marketing</option>
								<option value="web_designing_development">Web Designing & Development</option>
							</select>
							<div class="form-group">
								<textarea id="message" name="message" required
									placeholder="Any specific requirement"></textarea>
							</div>
							<button type="submit" class="submit-btn">SUBMIT</button>
						</form>
					</div>
					<!--featured articles-->
				</div>
			</div>
		</div>
	</section>
	<?php if (!empty($BlogData[0]['description11'])):
		print_r($BlogData[0]['description11']);
		?>
		<?= $BlogData[0]['description11']; ?>
	<?php endif; ?>
	<script>
		function submitForm(event) {
			event.preventDefault(); // Prevent form from submitting the usual way
			const form = document.getElementById('popup-form12');
			const formData = new FormData(form);
			// Mobile validation: Should start with 6 and be exactly 10 digits
			const mobile = document.getElementById('mobile1').value;
			const mobileRegex = /^[6-9]\d{9}$/; // regex for mobile number starting with 6 and exactly 10 digits
			if (!mobileRegex.test(mobile)) {
				alert("Please enter a valid mobile number starting with 6 and 10 digits.");
				return; // Stop form submission if mobile is invalid
			}

			// Email validation (HTML5 built-in, but you can do additional checks if needed)
			const email = document.getElementById('email1').value;
			const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ //;
			if (!emailRegex.test(email)) {
				alert("Please enter a valid email address.");
				return; // Stop form submission if email is invalid
			}
			// Get the current date and time
			const now = new Date();
			const currentDate = now.toLocaleDateString();  // e.g., "12/9/2024"
			const currentTime = now.toLocaleTimeString();  // e.g., "10:25:30 AM"

			// Append the date and time separately to the form data
			formData.append('date', currentDate);
			formData.append('time', currentTime);
			// If all validations pass, proceed to submit the form
			form.action = "https://script.google.com/macros/s/AKfycbxNUxQqJc1vXdGM7_ztmftsiC4Kk30zYEOq4rnxWj29PKRaYk-utTTilO37mYTzpiI0/exec";
			document.getElementById("loader").style.display = "flex";
			// Use fetch API to send data to the Google Apps Script without redirecting
			fetch(form.action, {
				method: form.method,
				body: formData
			})
				.then(response => response.json())
				.then(data => {
					document.getElementById("loader").style.display = "none";
					alert('Form submitted successfully!');
					// Optionally, reset the form
					form.reset();
				})
				.catch(error => {
					console.error('Error submitting the form:', error);
					document.getElementById("loader").style.display = "none";
					alert('There was an error submitting the form. Please try again.');
				});
		}
	</script>
	<script>
		function submitForm2(event) {
			event.preventDefault(); // Prevent form from submitting the usual way
			const form = document.getElementById('popup-form1');
			const formData = new FormData(form);
			// Mobile validation: Should start with 6 and be exactly 10 digits
			const mobile = document.getElementById('mobile2').value;
			const mobileRegex = /^[6-9]\d{9}$/; // regex for mobile number starting with 6 and exactly 10 digits
			if (!mobileRegex.test(mobile)) {
				alert("Please enter a valid mobile number starting with 6 and 10 digits.");
				return; // Stop form submission if mobile is invalid
			}

			// Email validation (HTML5 built-in, but you can do additional checks if needed)
			const email = document.getElementById('email2').value;
			const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/ //;
			if (!emailRegex.test(email)) {
				alert("Please enter a valid email address.");
				return; // Stop form submission if email is invalid
			}
			// Get the current date and time
			const now = new Date();
			const currentDate = now.toLocaleDateString();  // e.g., "12/9/2024"
			const currentTime = now.toLocaleTimeString();  // e.g., "10:25:30 AM"

			// Append the date and time separately to the form data
			formData.append('date', currentDate);
			formData.append('time', currentTime);
			// If all validations pass, proceed to submit the form
			form.action = "https://script.google.com/macros/s/AKfycbxNUxQqJc1vXdGM7_ztmftsiC4Kk30zYEOq4rnxWj29PKRaYk-utTTilO37mYTzpiI0/exec";
			document.getElementById("loader").style.display = "flex";
			// Use fetch API to send data to the Google Apps Script without redirecting
			fetch(form.action, {
				method: form.method,
				body: formData
			})
				.then(response => response.json())
				.then(data => {
					document.getElementById("loader").style.display = "none";
					alert('Form submitted successfully!');
					// Optionally, reset the form
					form.reset();
				})
				.catch(error => {
					console.error('Error submitting the form:', error);
					document.getElementById("loader").style.display = "none";
					alert('There was an error submitting the form. Please try again.');
				});
		}
	</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592bf100525fc5cf"></script>
	<script>
		$(".blog_main a").attr("target", "_blank");
	</script>
	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
</body>

</html>
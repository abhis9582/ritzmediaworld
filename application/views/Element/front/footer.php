<html>

<head>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo FRONT_DIR ?>css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: "Lexend", serif !important;
		}
	</style>
</head>

<body>
	<?php if ($RelatedBlogs || $RecentBlogs) { ?>
		<section class="blogs-section">
			<div class="container">
				<h4 class="mb-4 h3">Recent Post</h4>
				<div class="row">
					<?php if ($RelatedBlogs) { ?>
						<?php foreach ($RecentBlogs as $rb) {
							$url_title = create_url($rb['slug_url']);
							?>
							<div class="col-md-4" title="<?php echo ucwords($rb['title']); ?>">
								<strong class="h6"><?php echo ucwords($rb['title']) ?>
								</strong>
								<img class="mt-3 recent-post-img"
									src="<?php echo BASE_URL; ?>webroot/images/blogs/<?php echo $rb['blog_image1']; ?>"
									alt="Ritz media World - Blog" />
								<a class="btn btn-primary mt-3" href="<?php echo BASE_URL . 'blog/' . $url_title; ?>">
									Read More
								</a>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</section>
	<?php } ?>
	<?php $Systemdata = $this->commonmod_model->GetSystemConfigSetting(1); ?>

	<!--================ Start Footer Area =================-->
	<footer>
		<div class="row p-5 d-flex justify-content-center footer-new">
			<div class="col-md-3">
				<img src="<?php echo BASE_URL ?>webroot/front/images/nn_logo.jpg" alt="footer logo">
				<p class="footer-desc">We’ve been in the business for the better part of the last 16 years. So it’s safe
					to
					say that we’re the most experienced advertising agency in the northern belt of this great nation of
					India. This means that we have been in the trenches with the biggest brands from all business
					disciplines.</p>
				<div class="row mx-2">
					<ul class="d-flex justify-content-center">
						<?php if (!empty($Systemdata[0]['facebook_url'])) { ?>
							<li>
								<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['facebook_url'] ?>"><i
											class="fa-brands fa-facebook"></i></a></div>
							</li>
						<?php }
						if (!empty($Systemdata[0]['youtube_url'])) { ?>
							<li>
								<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['youtube_url'] ?>"><i
											class="fa-brands fa-youtube"></i></a></div>
							</li>
						<?php }
						if (!empty($Systemdata[0]['twitter_url'])) { ?>
							<li>
								<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['twitter_url'] ?>"><i
											class="fa-brands fa-twitter"></i></a></div>
							</li>
						<?php }
						if (!empty($Systemdata[0]['linkedin_url'])) { ?>
							<li>
								<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['linkedin_url'] ?>"><i
											class="fa-brands fa-linkedin"></i></a></div>
							</li>
						<?php }
						if (!empty($Systemdata[0]['vimeo_url'])) { ?>
							<li>
								<div class="footer-icons mx-2"><a href="<?= $Systemdata[0]['vimeo_url'] ?>"><i
											class="fa-brands fa-instagram"></i></a></div>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<h3 class="my-5">What we do</h3>
				<p><a class="text-light" href="<?= BASE_URL ?>print-advertising.html">Print Advertising</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>creative-services.html">Creative Services</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>radio-advertising.html">Radio Advertising</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>celebrity-endorsements.html">Celebrity Endorsements</a>
				</p>
				<p><a class="text-light" href="<?= BASE_URL ?>digital-marketing.html">Digital Marketing</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>contents-marketing.html">Content Marketing</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>web-designing-and-development.html">Web Designing &
						Development</a></p>
			</div>
			<div class="col-md-3">
				<h3 class="my-5">Quick Links</h3>
				<p><a class="text-light" href="<?= BASE_URL ?>about.html">About Us</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>contact.html">Contact Us</a></p>
				<p><a class="text-light" href="<?= BASE_URL ?>blogs">Blogs</a></p>
				<!-- <p><a class="text-light" href="#">Home</a></p> -->
				<p><a class="text-light" href="<?= BASE_URL ?>work.html">Work</a></p>
				<!-- <p><a class="text-light" href="<?= BASE_URL ?>resource.html">Resource</a></p> -->
			</div>
			<div class="col-md-3">
				<h3 class="my-5">Our Offices</h3>
				<span>Address: 402 – 404 , 4th floor Corporate Park, <br>Tower A1 Sector 142 , Greater Noida</span><br>
				<span><i class="fa fa-phone mr-2 mt-2"></i><a href="tel:09220516777" class="text-light">09220516777</a>,
					<a class="text-light" href="tel:07290002168">07290002168</a></span><br>
				<span>Email: info@ritzmediaworld.com</span>
				<div class="row mt-3 d-flex justify-content-center">
					<div class="div mx-2">
						<img src="<?= FRONT_DIR ?>images/googlepartner.webp" alt="google partner" height="55px">
					</div>
					<div class="div mx-2">
						<img width="100px" src="<?= FRONT_DIR ?>images/meta-partner-logo.png" alt="meta partner">
					</div>
				</div>
			</div>
		</div>
	</footer>
	<section class="footer-bottom-section row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="fb-left">
						<a href="https://ritzmediaworld.com/privacy-policy.html">Privacy Policy</a> |
						<a href="https://ritzmediaworld.com/career.html">Career</a> |
						<a href="https://ritzmediaworld.com/sitemap.xml">Sitemap</a> |
						<a href="https://ritzmediaworld.com/blogs">Blogs</a> |
						<a href="https://ritzmediaworld.com/refund-policy.html">Cancellation & Refund Policy</a> |
						<a href="https://g.co/kgs/gjzcQBq">Ritz Media World Reviews</a>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="fb-left">Ritz Media World - Best Advertising and Marketing Agency - India. Copyright
						2002-2025. All rights & trademark reserved.</div>
				</div>
			</div>
		</div>
	</section>

	<!--================ End Footer bottom Area =================-->

	<script>
		function addnewsletter() {

			email = $("#footer_email").val();
			$.ajax({
				url: "<?php echo base_url('user/addnewsletter'); ?>",
				type: "POST",
				data: { 'email': email },
				dataType: 'html',
				success: function (data) {

					$("#footer_email_msg").html(data);
				},
				error: function () {
					// alert("there is error");
				}
			});

		}
	</script>
	<!--<script src="<?= FRONT_DIR ?>js/jquery-3.3.1.slim.min.js"></script>-->

	<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>
	<!-- <script src="<?= FRONT_DIR ?>js/popper.min.js"></script> -->
	<script src="<?= FRONT_DIR ?>js/owl.carousel.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#customers-testimonials').owlCarousel({
				loop: true,
				center: true,
				items: 1,
				margin: 0,
				autoplay: true,
				dots: true,
				autoplayTimeout: 4000,
				smartSpeed: 450,
			});
		});
	</script>
	<script src="<?= FRONT_DIR ?>js/customjquery.js"></script>
	<script src="<?= FRONT_DIR ?>js/bootnavbar.js"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$(function () {
			// $('#main_navbar').bootnavbar();
		})
	</script>
	<!--<script src="<?= FRONT_DIR ?>js/bootstrap.min.js"></script>-->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<div id="whatsapp-icon" style="display: none;">
		<a href="https://wa.me/7290002168" target="_blank" title="Chat on WhatsApp">
			<i class="fab fa-whatsapp"></i>
		</a>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const whatsappIcon = document.getElementById('whatsapp-icon');
			whatsappIcon.style.display = 'flex';
		});
	</script>

</body>

</html>
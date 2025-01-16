<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Bhalaai">
	<title><?= $Content[0]['meta_title'] ?></title>
	<meta name="description" content="<?= $Content[0]['meta_description'] ?>">
	<meta name="keyword" content="<?= $Content[0]['meta_keywords'] ?>">
	<script>
		!function (f, b, e, v, n, t, s) {
			if (f.fbq) return; n = f.fbq = function () {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
			n.queue = []; t = b.createElement(e); t.async = !0;
			t.src = v; s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1491326822260603');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1491326822260603&ev=PageView&noscript=1" />
	</noscript>
	<?php $this->load->view("Element/front/header_common.php"); ?>

</head>

<body>
	<?php $this->load->view("Element/front/header.php"); ?>


	<!--start about-us section1-->

	<section class="aboutus-section1 mb-4">
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

	<section class="about1-content">
		<div class="container d-flex justify-content-center">
			<div class="col-md-8">
				<p class="h1 pt-3">Meet the Dream Team</p>
				<p><i>"We work with style and create a name through our game!"</i></p>
				<p>Ritz Media World’s true spark lies not just in its creativity but in the brilliant minds that weave
					magic
					with fresh ideas and strategies every single day. Let’s introduce you to the masterminds who’ve
					turned
					Ritz into the marketing maestro of NCR!</p>
			</div>
		</div>
		<div class="d-flex justify-content-center mt-5">
			<div class="col-md-6">
				<p class="h3">The Founders: Visionaries Behind the Magic</p>
				<p class="h5"><b>Ritesh Malik</b></p>
				<p><i>"I work with flair; that’s the real story!"</i></p>
				<p>The visionary leader and the ultimate game-changer! Ritesh is the head magician of Ritz Media World,
					blending creativity with ROI like no one else.</p>
				<p>Expertise: Campaign innovation, ROI-driven strategies, and unapologetic brilliance.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5"><b>Satwinder Kaur</b></p>
				<p><i>"When people see it, all they say is – this is a benchmark of success!"</i></p>
				<p>The queen of strategy and the epitome of perfection! Satwinder ensures every plan at Ritz exudes
					excellence.</p>
				<p>Expertise: Flawless execution and seamlessly infusing every project with her signature perfection.
				</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5"><b>Nishi Malik</b></p>
				<p><i>"On the journey of life, she walks her unique path!"</i></p>
				<p>The business visionary and happiness powerhouse of Ritz! Nishi’s positive energy transforms every
					meeting into a creative carnival.</p>
				<p>Expertise: Brand building, business management, and unyielding enthusiasm.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h3">The Key Players: Experts with a Midas Touch</p>
				<p class="h3">Brand Solutions</p>
				<p><i>"I craft brands and make them the talk of the town!"</i></p>
				<p>The guru of brand strategies who ensures every brand finds its shining star moment.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5">Digital Marketing Head</p>
				<p><i>"Making waves in the online world is guaranteed!"</i></p>
				<p>A digital queen who knows every nook and cranny of the online space. SEO, PPC, and social campaigns
					are her playground.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5">Content Lead</p>
				<p><i>"Words have magic, and I’m the writer behind it!"</i></p>
				<p>The genius who creates scroll-stopping content, transforming ideas into quirky and impactful stories.
				</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5">Video Editing Lead</p>
				<p><i>"There’s art in every frame and transition!"</i></p>
				<p>A video wizard who turns mundane footage into viral-worthy masterpieces.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5">Art Director</p>
				<p><i>"Life is a canvas, and I make it pop!"</i></p>
				<p>The Picasso of creativity, whose vibrant designs light up every Ritz campaign.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h5">Sound Engineer</p>
				<p><i>"Every beat and every jingle must be pitch-perfect!"</i></p>
				<p>Sneha breathes life into sound, crafting jingles and audio vibes that make Ritz campaigns
					unforgettable.</p>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<div class="col-md-6">
				<p class="h1">More Stars Powering the Ritz Engine</p>
				<ul class="mt-4">
					<li>
						<p><b>Social Media Manager: </b>"Turning likes and shares into conversations is my ultimate
							game!"</p>
					</li>
					<li>
						<p><b>Client Relationship Manager: </b>"Building lasting bonds with clients is my specialty!"
						</p>
					</li>
					<li>
						<p><b>Performance Marketing Specialist: </b>"I’m all about numbers and laser-focused on
							delivering results!"</p>
					</li>
					<li>
						<p><b>Graphic Designer: </b>"Creating designs that captivate at first glance is my forte!"</p>
					</li>
				</ul>
			</div>
		</div>
	</section>


	<?php $this->load->view("Element/front/footer.php"); ?>
	<?php $this->load->view("Element/front/footer_common.php"); ?>
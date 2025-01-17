<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>404 Page Not Found</title>
	<style>
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #001240;
			font-family: cursive;
		}

		/* Container styling */
		#container {
			width: 100%;
			margin: 0 auto;
			padding: 20px;
		}

		/* Heading styling */
		h1 {
			font-size: 2.5rem;
			margin-bottom: 20px;
			color: #fff;
			text-align: center;
		}

		/* Row styling */
		.row {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
		}

		/* Content and Image default styling */
		.content,
		.image {
			width: 100%;
			text-align: center;
		}

		.content {
			order: 1;
		}

		.image {
			order: 2;
			margin-top: 20px;
		}

		img {
			width: 500px;
			height: auto;
			display: block;
			margin: 0 auto;
		}

		/* Styling for error message */
		.error-msg {
			font-size: 2rem;
			color: #fff;
		}

		.error-msg span {
			line-height: 45px;
		}

		.error-msg a {
			color: #007bff;
			text-decoration: none;
		}
	</style>
</head>

<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<div class="row">
			<div class="col-md-6">
				<p class="error-msg">
					<span>Oh</span><br>
					<span>no...</span><br>
					<span>Ritz Media World</span><br>
					<span>cannot find that</span><br>
					<span>page.</span><br>
					<span>Go Back</span><br>
					<span>to Website</span><br>
					<a href="https://ritzmediaworld.com/">www.ritzmediaworld.com</a>
				</p>
			</div>
			<div class="col-md-6">
				<img src="https://static.wixstatic.com/media/338691_21e88bd2fb7645c7ac75e6f4ff5cab7b~mv2.png/v1/crop/x_36,y_0,w_1964,h_2000/fill/w_740,h_754,al_c,q_90,usm_0.66_1.00_0.01,enc_avif,quality_auto/The%20Go-To%20Guy%20Question.png"
					alt="image">
			</div>
		</div>
	</div>
</body>

</html>
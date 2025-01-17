<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
if (!function_exists('test_method')) {
	function test_method($var = '')
	{
		return $var;
	}
}

function header_menu()
{
	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from('bh_menu_category');
	$ci->db->where('status', '1');
	$cat = $ci->db->get()->result_array();
	?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light about-main-header" id="main_navbar">
		<div class="container">
			<a class="navbar-brand" href="<?= BASE_URL ?>"><img src="<?= FRONT_DIR ?>images/nn_logo.jpg" class="img-fluid"
					alt="Ritz Media World"></a>
			<button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= BASE_URL ?>">Home <span class="sr-only">(current)</span></a>
					</li>
					<li id="services_dropdown"
						class="nav-item dropdown">
						<a class="nav-link dropdown-toggle industry-link" href="#" id="navbarDropdown3" title="Industry"
							role="button" aria-label="Submit" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">Services</a>
						<ul class="dropdown-menu industry-dropdown" aria-labelledby="navbarDropdown3">
							<li class="nav-item dropdown">
								<a class="dropdown-item nav-link dropdown-toggle" href="#" id="featuresDropdown"
									role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Creative Services">
									Creative Services
								</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>branding-and-identity-development.html">Branding and
											Identity Development</a></li>
									<li class="dropdown">
										<a class="dropdown-item" href="<?= BASE_URL ?>graphic-designing.html">
											Graphic Designing
										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>logo-design.html">Logo Design</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>print-advertisement-design.html">Print
											Advertisement Design
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>ui-ux-design.html">UI/UX Design
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>packaging-design.html">Packaging
											Design
										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown6"
									title="Print Advertising" role="button" aria-label="Submit">Print Advertising</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>advertisement-designing.html">Advertisement Design
										</a></li>
									<li>
										<a class="dropdown-item" href="<?= BASE_URL ?>ad-placements.html">
											Ad Placements

										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>copywriting.html">Copywriting</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>negotiating-rates.html">Negotiating
											Rates
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>ad-size-optimization.html">Ad Size
											Optimization
										</a></li>
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>advertisement-scheduling.html">Advertisement Scheduling
										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown7"
									title="Radio Advertising" role="button" aria-label="Submit">Radio
									Advertising</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>advertisement-concept-development.html">Advertisement
											Concept Development
										</a></li>
									<li class="dropdown">
										<a class="dropdown-item" href="<?= BASE_URL ?>scriptwriting.html">
											Scriptwriting

										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>voiceover-casting.html">Voiceover
											Casting
										</a></li>
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>recording-and-production.html">Recording and
											Production

										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>media-planning-and-buying.html">Media
											Planning and
											Buying

										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>negotiating-ad-rates.html">Negotiating
											Ad Rates

										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown8"
									title="Celebrity Endorsements" role="button" aria-label="Submit">Celebrity
									Endorsements</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item" href="<?= BASE_URL ?>celebrity-selection.html">Celebrity
											Selection
										</a></li>
									<li class="dropdown">
										<a class="dropdown-item" href="<?= BASE_URL ?>negotiating-contracts.html">
											Negotiating Contracts

										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>creative-collaboration.html">Creative
											Collaboration</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>campaign-integration.html">Campaign
											Integration
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>public-relations.html">Public
											Relations
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>legal-compliance.html">Legal
											Compliance
										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown9"
									title="Digital	Marketing" role="button" aria-label="Submit">Digital
									Marketing</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>digital-marketing-services.html">Digital Marketing
											Services
										</a></li>
									<li class="dropdown">
										<a class="dropdown-item"
											href="<?= BASE_URL ?>search-engine-optimization---seo.html">
											Search Engine Optimization - SEO

										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>ppc-google-ads-agency.html">PPC
											(Google Ads)</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>social-media-management.html">Social
											Media
											Management
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>orm-in-digital-marketing.html">ORM in
											Digital
											Marketing
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>lead-generation.html">Lead Generation
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>brand-awareness.html">Brand Awareness
										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown19"
									title="Content Marketing" role="button" aria-label="Submit">Content
									Marketing</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item" href="<?= BASE_URL ?>content-marketing.html">Content
											Marketing
										</a></li>

									<li class="dropdown">
										<a class="dropdown-item" href="<?= BASE_URL ?>blog-content.html">
											Blog Content
										</a>
									</li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>article-contents.html">Article Content
										</a></li>
									<li><a class="dropdown-item" href="<?= BASE_URL ?>pr-content.html">PR Content
										</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown20"
									title="Web Designing &	Development" role="button" aria-label="Submit">Web Designing &
									Development</a>
								<ul class="dropdown-menu" aria-labelledby="featuresDropdown">
									<li><a class="dropdown-item" href="<?= BASE_URL ?>web-designing-development.html">Web
											Designing &
											Development
										</a></li>
									<li class="dropdown">
										<a class="dropdown-item" href="<?= BASE_URL ?>custom-design-development.html">
											Custom Design & Development
										</a>
									</li>
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>wordpress-web-designing.html">WordPress Web
											Designing</a></li>
									<li><a class="dropdown-item"
											href="<?= BASE_URL ?>e-commerce-web-designing.html">E-Commerce Web
											Designing
										</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li
						class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="<?= BASE_URL ?>about.html" id="navbarDropdown"
							title="About Us" role="button" aria-label="Submit" data-toggle="dropdown" area-haspopup="true"
							aria-expanded="false">About Us</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown10">
							<li class="nav-item dropdown">
								<a class="dropdown-item" href="<?= BASE_URL ?>about.html" id="navbarDropdown1">
									Our Profile
								</a>
							</li>
							<li class="nav-item dropdown">
								<a class="dropdown-item" href="<?= BASE_URL ?>management.html" id="navbarDropdown2"
									title="Management" role="button" aria-label="Submit">
									Management
								</a>
							</li>
						</ul>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL; ?>work.html">Our Work</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL; ?>blogs">Blogs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= BASE_URL ?>contact.html">Contact Us</a>
					</li>
					<li class="nav-extra-items">
						<ul>
							<?php
							foreach ($cat as $catgory) {
								?>

								<li class="nav-item">
									<a class="nav-link"
										href="<?php echo BASE_URL . $catgory['category_url'] . '.html'; ?>"><?php echo $catgory['category_name']; ?></a>
								</li>

							<?php } ?>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
}

function create_url($string)
{
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}









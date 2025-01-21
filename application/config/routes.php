<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'content/index';

$route['blog/([a-zA-Z0-9-_]+)'] = 'blogs/blog_single/$1';
$route['category/([a-zA-Z0-9-_]+)'] = 'blogs/category/$1';
$route['tags/([a-zA-Z0-9-_]+)'] = 'blogs/tagsRelatedBlogs/$1';
$route['landing-page.html'] = 'content/landingPage';
$route['privacy-policy.html'] = 'content/privacyPolicy';
$route['refund-policy.html'] = 'content/refundPolicy';
$route['login'] = 'user/login';
$route['forgotpassword'] = 'user/forgotpassword';
$route['enquiries.html'] = 'content/enquiries';
$route['about.html'] = 'content/about';
$route['new-page'] = 'content/newpage';
// $route['gallery.html'] = 'content/gallery';
$route['client.html'] = 'content/client';
$route['contact.html'] = 'content/contact';
$route['popupsubmit'] = 'content/popUpcontact';
$route['cookie-data'] = 'content/cookieData';
$route['career.html'] = 'content/career';
$route['management.html'] = 'content/management';
$route['work.html'] = 'content/common/98';
$route['industry.html'] = 'content/common/100';
$route['resource.html'] = 'content/common/101';
$route['creative-services.html'] = 'content/creativeservices/1';
$route['print-advertising.html'] = 'content/creativeservices/2';
$route['radio-advertising.html'] = 'content/creativeservices/3';
$route['celebrity-endorsements.html'] = 'content/creativeservices/4';
$route['digital-marketing.html'] = 'content/creativeservices/5';
$route['contents-marketing.html'] = 'content/creativeservices/6';
$route['web-designing-and-development.html'] = 'content/creativeservices/7';
$route['web-story'] = 'content/webStory';
//CREATIVE SERVICES SUBMENU
$route['branding-and-identity-development.html'] = 'content/menudata/1';
$route['graphic-designing.html'] = 'content/menudata/2';
$route['logo-design.html'] = 'content/menudata/3';
$route['print-advertisement-design.html'] = 'content/menudata/4';
$route['ui-ux-design.html'] = 'content/menudata/5';
$route['packaging-design.html'] = 'content/menudata/6';
//PRINT ADVERTISING SUBMENU
$route['advertisement-designing.html'] = 'content/menudata/7';
$route['ad-placements.html'] = 'content/menudata/8';
$route['copywriting.html'] = 'content/menudata/9';
$route['negotiating-rates.html'] = 'content/menudata/17';
$route['ad-size-optimization.html'] = 'content/menudata/10';
$route['advertisement-scheduling.html'] = 'content/menudata/11';
//RADIO ADVERTISING SUBMENU
$route['advertisement-concept-development.html'] = 'content/menudata/12';
$route['scriptwriting.html'] = 'content/menudata/13';
$route['voiceover-casting.html'] = 'content/menudata/14';
$route['recording-and-production.html'] = 'content/menudata/15';
$route['radio-advertising-and-media-planning.html'] = 'content/menudata/16';
$route['negotiating-ad-rates.html'] = 'content/menudata/18';
//CELEBRITY ENDORSEMENTS SUBMENU
$route['celebrity-endorsements-and-selection.html'] = 'content/menudata/23';
$route['negotiating-contracts.html'] = 'content/menudata/24';
$route['creative-collaboration.html'] = 'content/menudata/25';
$route['campaign-integration.html'] = 'content/menudata/26';
$route['public-relations.html'] = 'content/menudata/27';
$route['legal-compliance.html'] = 'content/menudata/28';
//DIGITAL MARKETING SUBMENU
$route['digital-marketing-services.html'] = 'content/menudata/29';
$route['search-engine-optimization---seo.html'] = 'content/menudata/30';
// $route['search-engine-optimization---seo.html'] = 'content/seopage';
$route['ppc-google-ads-agency.html'] = 'content/menudata/31';
$route['social-media-management.html'] = 'content/menudata/32';
$route['orm-in-digital-marketing.html'] = 'content/menudata/33';
$route['lead-generation.html'] = 'content/menudata/34';
$route['brand-awareness.html'] = 'content/menudata/35';
//CONTENT MARKETING SUBMENU
$route['content-marketing.html'] = 'content/menudata/21';
$route['blog-content.html'] = 'content/menudata/20';
$route['article-contents.html'] = 'content/menudata/19';
$route['pr-content.html'] = 'content/menudata/22';
//WEB DESIGN & DEVELOPMENT SUBMENU
$route['web-designing-development.html'] = 'content/menudata/36';
$route['custom-design-development.html'] = 'content/menudata/37';
$route['wordpress-web-designing.html'] = 'content/menudata/38';
$route['e-commerce-web-designing.html'] = 'content/menudata/39';
//END OF SUBMENUS

$route['register'] = 'user/create_account';

$route['search-hotel'] = 'content/search_hotel';
$route['offers/([a-zA-Z0-9-_]+)/(:num)'] = 'content/offer_detail/$1/$2';
$route['hotel/([a-zA-Z0-9-_]+)/(:num)'] = 'search/support_detail/$1/$2';
$route['view-hotels/([a-zA-Z0-9-_]+)/(:num)'] = 'search/hotel_detail/$1/$2';

$route['search_properties'] = 'user/properties';
$route['myaccount'] = 'user/myaccount';
$route['search_properties/(:num)'] = 'search/search_properties/$1';
$route['search_properties/(:num)/(:num)'] = 'search/search_properties/$1/$2';
$route['search_properties/(:num)/(:num)/(:num)'] = 'search/search_properties/$1/$2/$3';

$route['listing-detail/(:num)'] = 'search/support_detail/$1';
$route['listing-detail/(:num)/(:num)'] = 'search/support_detail/$1/$2';
$route['listing-booking/(:num)/(:num)'] = 'search/listing_booking/$1/$2';

$route['properties.html'] = 'content/properties';
$route['([a-zA-Z0-9-_]+)+.html'] = 'content/find_html';

//$route['test.html'] = 'content/common/57';
$route['print-advertisement-design-services.html'] = 'content/common/58';
$route['newspaper-print-ad-placement-services.html'] = 'content/common/60';
$route['newspaper-print-ad-copywriting-services.html'] = 'content/common/61';
$route['best-rates-for-newspaper-print-ads.html'] = 'content/common/62';
$route['best-size-for-newspaper-print-ad.html'] = 'content/common/63';
$route['newspaper-print-ad-scheduling-services.html'] = 'content/common/64';

$route['brand-identity-design-services.html'] = 'content/common/65';
$route['creative-graphic-design-services.html'] = 'content/common/66';
$route['creative-logo-design-services.html'] = 'content/common/67';
$route['print-advertisement-design-services.html'] = 'content/common/68';
$route['user-experience-design-services.html'] = 'content/common/69';
$route['product-packaging-design-services.html'] = 'content/common/70';

$route['radio-ad-concept-development.html'] = 'content/common/71';
$route['radio-ad-script-writing.html'] = 'content/common/72';
$route['radio-ad-voiceover-artist.html'] = 'content/common/73';
$route['radio-ad-recording-studio.html'] = 'content/common/74';
$route['radio-ad-planing-and-buying-agency.html'] = 'content/common/75';
$route['best-rages-for-radio-advertising.html'] = 'content/common/76';

$route['celebrities-for-brand-endorsements.html'] = 'content/common/77';
$route['contract-negotiations-for-celebrity-endorsements.html'] = 'content/common/78';
$route['celebrity-collaboration-for-creative-design.html'] = 'content/common/79';
$route['celebrities-for-marketing-campaign.html'] = 'content/common/80';
$route['public-relations-with-celebrity-endorsements.html'] = 'content/common/81';
$route['legal-experts-in-celebrity-endorsements.html'] = 'content/common/82';

$route['digital-marketing-service-agency.html'] = 'content/common/83';
$route['search-engine-optimization-seo.html'] = 'content/common/84';
$route['pay-per-click-ppc-marketing-agency.html'] = 'content/common/85';
$route['social-media-marketing-agency.html'] = 'content/common/86';
// $route['orm-in-digital-marketing.html'] = 'content/common/87';
$route['seo-lead-generation-company.html'] = 'content/common/88';
$route['brand-awareness-campaign.html'] = 'content/common/89';

$route['seo-content-writing-services.html'] = 'content/common/90';
$route['blog-post-content-writing.html'] = 'content/common/91';
$route['article-post-content-writing.html'] = 'content/common/92';
$route['pr–press-release-content.html'] = 'content/common/93';

// $route['website-designing-development.html'] = 'content/common/94';
// $route['custom-design-development.html'] = 'content/common/95';
// $route['wordpress-web-development-company.html'] = 'content/common/96';
// $route['ecommerce-website-design-company.html'] = 'content/common/97';

$route['admin'] = 'admin/admin/login';

$route['admin/login?msg=login'] = 'admin/admin/login';
$route['admin/login'] = 'admin/admin/login';
$route['admin/dashboard'] = 'admin/admin/index';
$route['admin/change-password'] = 'admin/admin/change_password';
$route['admin/logout'] = 'admin/admin/logout';
$route['admin/manage-admin'] = 'admin/admin/view_all';
$route['admin/add-admin'] = 'admin/admin/add_admin';
$route['admin/edit-admin/(:num)'] = 'admin/admin/edit_admin/$1';

$route['admin/permission/(:num)'] = 'admin/admin/permission/$1';
$route['admin/system-setting'] = 'admin/admin/systemsetting';
$route['admin/web-story'] = 'admin/admin/webStory';

$route['admin/menu'] = 'admin/home/menu';
$route['admin/add_menu_list'] = 'admin/home/add_menu_list';
$route['admin/delete_menu_list/(:num)'] = 'admin/home/delete_menu_list/$1';
$route['admin/edit_menu_list/(:num)'] = 'admin/home/edit_menu_list/$1';
$route['admin/menu_category'] = 'admin/home/menu_category';
$route['admin/add_menu_category'] = 'admin/home/add_menu_category';
$route['admin/edit_menu_category/(:num)'] = 'admin/home/edit_menu_category/$1';
$route['admin/delete_menu_category/(:num)'] = 'admin/home/delete_menu_category/$1';
$route['blogs/(:num)'] = 'blogs/index/$1';
$route['admin/blogs/other/edit/(:num)'] = 'admin/blogs/edit_other/$1';
$route['admin/why_choose_us'] = 'admin/home/why_choose_us';
$route['admin/why_ritz_best'] = 'admin/home/why_best';
$route['admin/our_vision'] = 'admin/home/our_vision';
$route['admin/how_we_work'] = 'admin/home/how_we_work';
$route['admin/services'] = 'admin/home/services';
$route['admin/customers'] = 'admin/home/customers';
$route['admin/testimonials'] = 'admin/home/testimonials';
$route['admin/networthy_assets'] = 'admin/home/networthy_assets';
$route['admin/kaam_hai_mera'] = 'admin/home/kaam_hai_mera';
$route['admin/update_titles'] = 'admin/home/update_title_page';

$route['admin/manage-users'] = 'admin/user/index';
$route['admin/add-user'] = 'admin/user/add_user';
$route['admin/edit-user/(:num)'] = 'admin/user/edit_user/$1';
$route['admin/view-user/(:num)'] = 'admin/user/view_user/$1';

$route['admin/blogcategories'] = 'admin/blogcategory/index';
$route['admin/blogcategories/add'] = 'admin/blogcategory/add';
$route['admin/blogcategories/edit/(:num)'] = 'admin/blogcategory/edit/$1';
$route['admin/category/view/([a-zA-Z0-9-_]+)'] = 'admin/blogcategory/view/$1';
// $route['admin/view_archieve/([a-zA-Z0-9-_]+)'] = 'admin/blog/view_archive/$1';

$route['admin/othercategories'] = 'admin/othercategory/index';
$route['admin/othercategories/add'] = 'admin/othercategory/add';
$route['admin/othercategories/edit/(:num)'] = 'admin/othercategory/edit/$1';
$route['query'] = 'content/querypage';

$route['translate_uri_dashes'] = FALSE;

<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i
                class="icon_menu"></i></div>
    </div>

    <!--logo start-->
    <a href="<?= BASE_URL . 'admin/dashboard' ?>" class="logo">
        <h1 style="color:white; font-size:18px; font-weight:bold;">Ritz Media World</h1>
    </a>

    <!--<a href="<?= BASE_URL . 'admin/dashboard' ?>" class="logo">Bhalaai <span class="lite">NGO</span></a>-->
    <!--logo end-->

    <div class="nav search-row" id="top_menu" style="display:none;">
        <!--  search form start -->
        <ul class="nav top-menu">
            <li>
                <form class="navbar-form">
                    <input class="form-control" placeholder="Search" type="text">
                </form>
            </li>
        </ul>
        <!--  search form end -->
    </div>

    <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">


            <!-- alert notification end-->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="profile-ava displaysNone">
                        <img alt="" src="<?= ADMIN_DIR ?>img/avatar1_small.jpg">
                    </span>
                    <span class="username"><?= $this->session->userdata('bh_admin_name'); ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top displaysNone">
                        <a href="<?= BASE_URL ?>admin/edit-admin"><i class="icon_profile"></i> Edit Profile</a>
                    </li>
                    <li class="">
                        <a href="<?= BASE_URL ?>admin/change-password"><i class="icon_mail_alt"></i> Change Password</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/logout"><i class="icon_clock_alt"></i> Logout</a>
                    </li>

                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
</header>
<!--header end-->

<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="<?= BASE_URL . 'admin/dashboard' ?>">
                    <i class="icon_house_alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <?php
            if ($this->session->userdata('bh_admin_id') == 4) { ?>
                <!--li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Hotels</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?= BASE_URL ?>admin/listing/support">Manage Hotels</a></li>
                         
                          <li style="display:block;"><a class="" href="<?= BASE_URL ?>admin/cities">Manage Cities</a></li>
                          <li style="display:none;"><a class="" href="<?= BASE_URL ?>admin/othercategories">Hotels Types</a></li>
                         
                       
                       </ul>
                  </li-->

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_desktop"></i>
                        <span>Manage Order</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="<?= BASE_URL ?>admin/listing/order">Manage Order</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/listing/corporate_request">Corporate Request</a></li>

                    </ul>
                </li>


            <?php } else {


                if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '1') || ($this->session->userdata('bh_admin_role') == 'Super Admin')) { ?>
                    <li style="display:none;" class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="icon_document_alt"></i>
                            <span> Admin</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="" href="<?= BASE_URL ?>admin/manage-admin">Manage Admin</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '3')) { ?>
                    <li style="display:none;" class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="icon_document_alt"></i>
                            <span>Users</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="" href="<?= BASE_URL ?>admin/manage-users">Manage User</a></li>

                        </ul>
                    </li>
                <?php } ?>

                <?php if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '4') || $this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '5')) { ?>

                    <li class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="icon_desktop"></i>
                            <span>Blogs</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">

                            <?php if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '5')) { ?>
                                <li><a class="" href="<?= BASE_URL ?>admin/blogcategories">Blog Categories</a></li>

                            <?php }
                            if ($this->commonmod_model->getAdminFunctionPermission($this->session->userdata('bh_admin_id'), '4', '7')) { ?>
                                <li><a class="" href="<?= BASE_URL ?>admin/blogs/add">Add New Blog</a></li>

                            <?php }
                            if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '4')) { ?>
                                <li><a class="" href="<?= BASE_URL ?>admin/blogs">Manage Blogs</a></li><?php } ?>
                        </ul>
                    </li>
                <?php } ?>


                <?php if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '9')) { ?>
                    <!--li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Hotels</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?= BASE_URL ?>admin/listing/support">Manage Hotels</a></li>
                         
                          <li><a class="" href="<?= BASE_URL ?>admin/cities">Manage Cities</a></li>
                          <li style="display:none;"><a class="" href="<?= BASE_URL ?>admin/othercategories">Hotels Types</a></li>
                         
                       
                       </ul>
                  </li-->
                <?php } ?>


                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_desktop"></i>
                        <span>Website Pages</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="<?= BASE_URL ?>admin/content">Manage Pages</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/menu">Manage Menu</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/menu_category">Manage Menu Category</a></li>


                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_desktop"></i>
                        <span>Home</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="<?= BASE_URL ?>admin/home/why_choose_us">Why Choose Us</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/why_ritz_best">Why Ritz Best</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/our_vision">Our Vision</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/how_we_work">How We Work</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/services">Manage Services</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/home/customers">Manage Customers</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/home/testimonials">Manage Testimonial</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/home/networthy_assets">Networthy Assets</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/home/kaam_hai_mera">Kaam Hai Mera</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/update_titles">Update Title Descriptions</a></li>
                    </ul>
                </li>

                <?php if ($this->commonmod_model->getAdminMenuPermission($this->session->userdata('bh_admin_id'), '11')) { ?>
                    <li style="display:none;" class="sub-menu">
                        <a href="javascript:;" class="">
                            <i class="icon_desktop"></i>
                            <span>Manage Order</span>
                            <span class="menu-arrow arrow_carrot-right"></span>
                        </a>
                        <ul class="sub">
                            <li style="display:none;"><a class="" href="<?= BASE_URL ?>admin/listing/order">Manage Order</a></li>
                            <li style="display:none;"><a class="" href="<?= BASE_URL ?>admin/listing/corporate_request">Corporate
                                    Request</a></li>

                        </ul>
                    </li>
                <?php } ?>


                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon_documents_alt"></i>
                        <span>System Setting</span>
                        <span class="menu-arrow arrow_carrot-right"></span>
                    </a>
                    <ul class="sub">
                        <!-- <li><a class="" href="<?= BASE_URL ?>admin/testimonial">Manage Testimonials</a></li> -->
                        <li><a class="" href="<?= BASE_URL ?>admin/listing/newsletter">Manage Newsletter</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/mediabanner">Manage Home Slider</a></li>

                        <!-- <li><a class="" href="<?= BASE_URL ?>admin/gallery">Manage Other Images</a></li> -->
                        <li><a class="" href="<?= BASE_URL ?>admin/howitworks">Manage FAQs</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/enquiry">Contact Enquiry</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/enquiry/enquiries">Enquiries</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/enquiry/career">Manage Career</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/ourteam">Manage Our Team</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/system-setting">Global Setting</a></li>
                        <li><a class="" href="<?= BASE_URL ?>admin/web-story">Manage Web Story</a></li>
                    </ul>
                </li>

            <?php } ?>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
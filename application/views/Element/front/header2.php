<div class="panels3">
  <div class="container">
    <div class=" col-md-12">

      <ul class="pull-right">
        <? if ($this->session->userdata('bh_front_username') != "") { ?>
          <li><a href="<?= BASE_URL ?>myaccount"><i class="fa fa-user"></i> &nbsp;My Account</a></li>

          <li><a href="<?= BASE_URL ?>user/logout"><i class="fa fa-lock"></i> &nbsp;Logout</a></li>
        <? } else { ?>

          <li><a href="<?= BASE_URL ?>login"><i class="fa fa-lock"></i> &nbsp;Login</a></li>
        <? } ?>
      </ul>
    </div>
  </div>
</div>
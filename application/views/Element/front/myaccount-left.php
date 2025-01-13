<table>
    <tr style="display:none;">
        <td><?php $src = $this->image->getImageSrc("users",$UserData[0]['user_image1'],"./webroot/front/img/new.png"); ?></td>
    </tr>
    <tr>
        <td><img src="<?=$src?>" class="profile-pic" alt="Logo"></td>
    </tr>
    <tr>
        <td><h4><?=$UserData[0]['first_name']." ".$UserData[0]['last_name'];?></h4></td>
    </tr>
    <tr>
        <td>
            
			<div class="ppp_box">
				<i class="fa fa-pencil"></i> &nbsp;&nbsp;  
				 <a href="<?=BASE_URL?>user/edit_profile/<?=$UserData[0]['user_id'];?>">Edit profile</a>
			</div>
			
			<div class="ppp_box">
				<i class="fa fa-unlock-alt"></i> &nbsp;&nbsp;  
				<a href="<?=BASE_URL?>user/changepassword">Change password</a>
			</div>
			 <?php if($this->session->userdata('bh_front_usertype')=='User') { ?>
			
			<div class="ppp_box">
                    <i class="fa fa-home"></i> &nbsp;&nbsp;
					<a href="<?=BASE_URL?>user/order">My Booking</a>
			</div>
			 <? } ?>
				 <? if($this->session->userdata('bh_front_usertype')=='Agent') { ?>
			
				
			<div class="ppp_box">
				<!-- <li><a href="<?=BASE_URL?>user/subcription">My Properties</a></li> -->
			
                    <i class="fa fa-home"></i> &nbsp;&nbsp;
					<a href="<?=BASE_URL?>user/add_request">Add Request</a>
				
			</div>
			<div class="ppp_box">
                    <i class="fa fa-home"></i> &nbsp;&nbsp;
					<a href="<?=BASE_URL?>user/allrequest">All Request</a>
				
			</div>
			
			<div class="ppp_box">
					<i class="fa fa-book"></i> &nbsp;&nbsp;
					<a href="<?=BASE_URL?>user/order">My Booking</a>
			</div>
				<? } ?>
        </td>
    </tr>
</table>

               
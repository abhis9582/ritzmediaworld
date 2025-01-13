<?php $this->load->view('includes/face_header'); ?>
<table width="100%"  border="0" cellspacing="5" cellpadding="5" class="list">
<thead>
<tr>
	<td  height="30"><?php echo $heading_title; ?></td>
</tr>
<tr>
  <td>
  <?php echo validation_message('alert');?></td>
 </tr> 
</thead>
</table>


<?php echo form_open('sitepanel/discoupon/viewmember/'.$couponID);?>
<table width="100%" border="0" cellspacing="4" cellpadding="4" class="list">
 <tr>
   <td colspan="4"><?php echo error_message(); ?></td>
  </tr> 
  <?php
$couponId = (int) $this->uri->segment(4,0);
$sql="SELECT wc.*,wcc.*
FROM wp_coupons AS wc, wp_coupon_customers AS wcc
WHERE wc.coupon_id =wcc.coupon_id AND wc.coupon_id ='$couponId' ";
$res  = custom_result_set($sql);
//trace($res);
if(is_array($res) && count($res) > 0 )
{
?>	
 <tr bgcolor="#CCCCCC">
    <th width="9%">S.no</th>
    <th width="42%">Coupon</th>
    <th width="32%">Member</th>
    <th width="17%">Status</th>
  </tr>
<?php

	$ctr=1;
	foreach($res as $v)
	{
?>  
<tr>
    <td width="9%"><?php echo $ctr;?>
    </td>
    <td width="42%">
    
   <strong> Coupon Code : </strong><?php echo $v['coupon_code'];?>
   <br />
   <strong> Coupon Discount : </strong><?php  if($v['coupon_type']=='p') { echo $v['coupon_discount']."%"; }else{ echo $v['coupon_discount']; } ?>
    </td>
    <td width="32%"><?php echo $v['name'];?> <br />
    <?php echo $v['email'];?> </td>
    <td width="17%">
	    <?php 
		if($v['status']==1)
		{
		         echo "Used";
	     }
		 if($v['status']==0)
		 {
		         echo "Unused";
	     }
		
		 ?>
         </td>
  </tr>
<?php 
      $ctr++;
	}
}else
{
	
	echo "<center><strong> No record(s) found !</strong></center>" ;
}
 ?>  
 
</table>
<?php echo form_close();?>
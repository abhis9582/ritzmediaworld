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

<?php echo form_open('sitepanel/coupons/assign_to_member/'.$couponID);?>

<table width="100%" border="0" cellspacing="4" cellpadding="4" class="list">
 <tr>
   <td colspan="3"><?php echo error_message(); ?></td>
  </tr> 
 <tr bgcolor="#CCCCCC">
    <th width="14%" align="left">S.no</th>
    <th width="41%" align="left">Name</th>
    <th width="45%" align="left">Email</th>
  </tr>
 
<?php

if(is_array($res) && count($res) > 0 )
{
	$ctr=1;
	foreach($res as $v)
	{
?>  
<tr>
    <td width="14%">
    <input type="checkbox" name="mid[]" value="<?php echo $v['customers_id'];?>">
    </td>
    <td width="41%"><?php echo $v['name'];?>  </td>
    <td width="45%"><?php echo $v['user_name'];?></td>
  </tr>
<?php 
      $ctr++;
	}
}
 ?> 
 
  <tr><td colspan="7" align="right" height="30"><?php echo $page_links; ?></td></tr>  
 <tr>
   <td colspan="3" align="left"><input type="submit" name="submit2" value="Send Coupon">
   <input type="hidden" name="action" value="Add">
   
   </td>
 </tr>  
</table>
 
<?php echo form_close();?>
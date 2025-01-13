<?php $this->load->view('includes/header'); ?>
<div id="content">
 <div class="breadcrumb_sitepanel"><?php echo anchor('sitepanel/dashbord','Home'); ?> &raquo; <?php echo $heading_title; ?> </a></div>
 <div class="box">
  <div class="heading">
   <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons"> <?php echo anchor("sitepanel/coupons/add/",'<span>Add Discount coupon</span>','class="button" ' );?> </div>
  </div>
  <div class="content">
   <?php echo form_open("sitepanel/coupons/",'id="search_form" method = "get" ');?>
   <div align="right" class="breadcrumb_sitepanel"> Records Per Page : <?php echo display_record_per_page();?> </div>
   <table width="100%"  border="0" cellspacing="3" cellpadding="3" >
    <?php
    if(error_message() !=''){
	    echo error_message();
    }?>
    <tr>
     <td align="center" >Search [ Coupon Code ] 
      <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
      <a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>
      <?php if($this->input->get_post('keyword')!=''){
	      echo anchor("sitepanel/coupons/",'<span>Clear Search</span>');
      }?>
     </td>
    </tr>
   </table>
   <?php echo form_close();
   if( is_array($res) && !empty($res) ){
	   echo form_open("sitepanel/coupons/",'id="data_form"');?>
	   <table class="list" width="100%" id="my_data">
	    <thead>
	     <tr>
	      <td width="5%" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
	      <td width="17%" class="left">Coupon Code</td>
	      <td width="12%" class="left">Discount</td>
	      <td width="15%" class="left">Coupon Usage</td>
	      <td width="20%%" class="left">Coupon Validity</td>
	      <td width="15%" class="left">Coupon Members</td>
				<td width="8%" class="right"><span class="left">Status</span></td>
				<td width="8%" class="right">Action</td>
			 </tr>
			</thead>
			<tbody>
			 <?php
			 $atts = array(
			 'width'      => '600',
			 'height'     => '600',
			 'scrollbars' => 'yes',
			 'status'     => 'yes',
			 'resizable'  => 'yes',
			 'screenx'    => '0',
			 'screeny'    => '0'
			 );
			 
			 foreach($res as $catKey=>$pageVal){
				 ?>
				 <tr>
				  <td style="text-align: center;"><input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['coupon_id'];?>" /></td>
				  <td class="left">
				   <?php echo $pageVal['coupon_code'];?><br />
				   <?php  if($pageVal['minimum_order_amount']!=''){?><strong> Apply on  minimum order :</strong> <?php echo $pageVal['minimum_order_amount']; }?>
				  </td>
				  <td class="left"><?php  if($pageVal['coupon_type']=='p') { echo $pageVal['coupon_discount']."%"; }else{ echo $pageVal['coupon_discount']; } ?></td>
				  <td class="left"><?php echo $pageVal['coupon_usage'];?></td>
				  <td class="left">Start Date : <?php echo getDateFormat($pageVal['start_date'],1);?><br/>End Date :  <?php echo getDateFormat($pageVal['end_date'],1);?></td>
				  <td><?php echo anchor_popup('sitepanel/coupons/assign_to_member/'.$pageVal['coupon_id'], 'Send Coupon', $atts);?><br /><br /><?php echo anchor_popup('sitepanel/coupons/coupon_assigned_customers/'.$pageVal['coupon_id'], 'View Member', $atts);?></td>
				  <td class="right"><?php echo ($pageVal['status']==1)?"Active":"In-active";?></td>
				  <td align="center" ><?php echo anchor("sitepanel/coupons/edit/$pageVal[coupon_id]/".query_string(),'Edit'); ?></td>
				 </tr>
				 <?php
			 }?>
			</tbody>
		 </table>
		 <?php
		 if($page_links!=''){
			 ?>
			 <table class="list" width="100%">
			  <tr><td align="right" height="30"><?php echo $page_links; ?></td></tr>
			 </table>
			 <?php
		 }?>
		 <table class="list" width="100%">
		  <tr>
		   <td height="35" align="left" style="padding:2px">
		    <input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onclick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
		    <input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onclick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
		    <input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onclick="return validcheckstatus('arr_ids[]','delete','Record');"/>
		   </td>
		  </tr>
		 </table>
		 <?php
		 echo form_close();
	 }else
	 {
		 echo "<center><strong> No record(s) found !</strong></center>" ;
	 }?>
	</div>
 </div>	
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/header'); ?>
<div id="content">
 <div class="breadcrumb_sitepanel"><?php echo anchor('sitepanel/dashbord','Home'); ?>&raquo; <?php echo anchor('sitepanel/discoupon/','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?></div>
 <div class="box">
  <div class="heading">
   <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
   <div class="buttons">&nbsp;</div>
  </div>
  <div class="content">
   <?php echo validation_message();
   echo error_message();
   echo form_open('sitepanel/coupons/add/');?>
   <div id="tab_pinfo">
    <table width="90%"  class="form"  cellpadding="3" cellspacing="3">
     <tr><th colspan="2" align="right" ><span class="required">*Required Fields</span><br></th></tr>
     <tr><th colspan="2" align="center" > </th></tr>
     <tr class="trOdd">
      <td height="26" align="right" ><span class="required">*</span> Discount Coupon Type </td>
      <td align="left">
       <select name="coupon_type">
        <option value="">Coupon Type</option>
        <option value="p" <?php echo $this->input->post('coupon_type')==='p' ? 'selected="selected"' : '';?>>Percentage</option>
        <option value="a" <?php echo $this->input->post('coupon_type')==='a' ? 'selected="selected"' : '';?>>Amount</option>
       </select>
      </td>
     </tr>
     <tr class="trOdd">
      <td width="28%" height="26" align="right" ><span class="required">*</span> Coupon Discount:</td>
      <td width="72%" align="left"><input type="text" name="coupon_discount" size="40" value="<?php echo set_value('coupon_discount');?>"> [Ex : Percentage: 5, Amount: 120.00 ]</td></tr>
      <tr class="trOdd">
       <td height="26" align="right" >Minimum order amount</td>
       <td align="left"><input type="text" name="minimum_order_amount" size="40" value="<?php echo set_value('minimum_order_amount');?>" /> [Ex : Amount: 1520.00 ] </td>
      </tr>
      <tr class="trOdd">
       <td height="26" align="right" >Coupon Usage</td>
       <td align="left">
        <input type="radio" name="coupon_usage" value="single"  checked="checked" /> Single &nbsp;
        <input type="radio" name="coupon_usage" value="multiple" /> Multiple
       </td>
      </tr>
      <tr class="trOdd">
       <td width="28%" height="26" align="right" ><span class="required">*</span> Start Date:</td>
       <td width="72%" align="left"><input name="start_date" class="start_date1" type="text" style="padding:2px; width:133px;" value="<?php echo set_value('start_date');?>"><a href="#" class="start_date"><img src="<?php echo base_url();?>assets/developers/images/cal0.png" width="16" height="16" alt=""></a></td>
      </tr>
      <tr class="trOdd">
       <td width="28%" height="26" align="right" ><span class="required">*</span> End Date:</td>
       <td width="72%" align="left"><input name="end_date" class="end_date1" type="text" style="padding:2px; width:133px;" value="<?php echo set_value('end_date');?>"><a href="#" class="end_date"><img src="<?php echo base_url();?>assets/developers/images/cal0.png" width="16" height="16" alt=""></a></td>
      </tr>
      <tr class="trOdd">
       <td align="left">&nbsp;</td>
       <td align="left">
        <input type="submit" name="sub" value="Add" class="button2" />
        <input type="hidden" name="action" value="addtestimonial" />
       </td>
      </tr>
     </table>
    </div>
    <?php echo form_close(); ?>
   </div>
  </div>
 </div>  
</div>
<?php
$default_date = '2013-01-01';
$posted_start_date = $this->input->post('start_date');
?>
<script type="text/javascript">
  $(document).ready(function(){
	$('.btn_sbt2').live('click',function(e){
		e.preventDefault();
		$start_date = $('.start_date1:eq(0)').val();
		$end_date = $('.end_date1:eq(0)').val();
		$start_date = $start_date=='From' ? '' : $start_date;
		$end_date = $end_date=='To' ? '' : $end_date;
		$(':hidden[name="keyword2"]','#myform').val($('input[type="text"][name="keyword2"]').val());
		$(':hidden[name="start_date"]','#myform').val($start_date);
		$(':hidden[name="end_date"]','#myform').val($end_date);
		$("#myform").submit();
	});
	$('.start_date,.end_date').live('click',function(e){
	  e.preventDefault();
	  cls = $(this).hasClass('start_date') ? 'start_date1' : 'end_date1';
	  $('.'+cls+':eq(0)').focus();
	});
	$( ".start_date1").live('focus',function(){
			$(this).datepicker({
			showOn: "focus",
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			defaultDate: 'y',
			buttonText:'',
			minDate:'<?php echo $default_date;?>' ,
			maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
			yearRange: "c-100:c+100",
			buttonImageOnly: true,
			onSelect: function(dateText, inst) {
						  $('.start_date1').val(dateText);
						  $( ".end_date1").datepicker("option",{
							minDate:dateText ,
							maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
						});

					  }
		});
	});
	$( ".end_date1").live('focus',function(){
			$(this).datepicker({
					  showOn: "focus",
					  dateFormat: 'yy-mm-dd',
					  changeMonth: true,
					  changeYear: true,
					  defaultDate: 'y',
					  buttonText:'',
					  minDate:'<?php echo $posted_start_date!='' ? $posted_start_date :  $default_date;?>' ,
					  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
					  yearRange: "c-100:c+100",
					  buttonImageOnly: true,
					  onSelect: function(dateText, inst) {
						$('.end_date1').val(dateText);
					  }
				  });
	  });

  });
</script>
<?php $this->load->view('includes/footer'); ?>
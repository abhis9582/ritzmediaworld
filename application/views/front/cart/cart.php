<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Shopping Cart</title>
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>


    
    <!--Page Title-->
    <section class="page-title" style="background-image:url(<?=FRONT_DIR?>images/background/page-title-1.jpg);">
        <div class="auto-container">
            <h1>Shopping Cart</h1>
        </div>
        
        
    </section>
	
	
	
	
	
	<div class="container">
	<br>
	<div class="sec-title mb-60">
                <h2>Shopping Cart</h2>
                <div class="line"></div>
    </div>
	</div>
	
	
	 <div class="container">
	
		
		
	
		<div class="col-xs-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
						
					</div>
				</div>
				<div class="panel-body card_area">
					
					<?php 
					
					if (count($this->cart->contents()) > 0) { ?>
					<div class="row padding_topbottom hidden-sm hidden-xs">
						<div class="col-xs-12 col-sm-12 col-md-1 border_right ">S.NO.</div>
					
						<div class="col-xs-12 col-sm-12 col-md-5 border_right">Item</div>
						<div class="col-xs-12 col-sm-12 col-md-2 border_right">Price</div>
						<div class="col-xs-12 col-sm-12 col-md-1 border_right">Qty.</div>
						
						<div class="col-xs-12 col-sm-12 col-md-2 border_right">Total</div>
						<div class="col-xs-12 col-sm-12 col-md-1">Action</div>
						
					</div>
					<?php } ?>
					
					<hr class="col-md-12 col-sm-12 col-xs-12 clear_gap">
					<?php if (count($this->cart->contents()) > 0){ ?>
					<?php
					echo form_open('cart/update_cart');
					$grand_total = 0; $i = 1;
					
					foreach ($this->cart->contents() as $item):
						echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
						echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
						echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
						echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
						echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
						echo form_hidden('cart['. $item['id'] .'][type]', $item['type']);
						echo form_hidden('cart['. $item['id'] .'][scents]', $item['qty']);
						echo form_hidden('cart['. $item['id'] .'][addins]', $item['addins']);
						echo form_hidden('cart['. $item['id'] .'][soap_label1]', $item['soap_label1']);
						echo form_hidden('cart['. $item['id'] .'][soap_label2]', $item['soap_label2']);
						echo form_hidden('cart['. $item['id'] .'][label_image]', $item['label_image']);
					?>
					<div class="row padding_topbottom">
						
						<div class="col-xs-12 col-sm-12 col-md-1 border_right">
							<?php echo $i++; ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 border_right">
                       <?php $src = @$this->commonmod_model->product_image($item['id']);?>
							<img src="<?=$src?>" alt="" class="img-responsive"> 
							<?php if($item['type']=='designpro'){ ?>
							<br>
							Base selection: <?php echo $item['name']; ?> | Scents selection: <?php echo implode(",",$item['scents']); ?> | Addins selection: <?php echo implode(",",$item['addins']); ?> | Soap label line 1: <?php echo $item['soap_label1']; ?> | Soap label line 2: <?php echo $item['soap_label2']; ?> | Label image: <?php echo $item['label_image']; ?>
							<?php } else { ?>
							<?php echo $item['name']; ?>
							<?php } ?>
						
						</div>
					
							
						
						<div class="col-xs-12 col-sm-12 col-md-2 border_right">
							<?=CURRENCY?> <?php echo number_format($item['price'],2); ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-1 border_right">
							<?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" size="1" class="input_border" style="text-align: right"'); ?>
						</div>
					
						
						
						 
						 
					<?php  $tax = @$this->commonmod_model->ApplyTaxOnProduct($item['id'],'');
                                 $tax_amount = $tax*$item['qty'];
							?>
						<div class="col-xs-12 col-sm-12 col-md-2 border_right">
							<?=CURRENCY?> <?php echo number_format(($item['subtotal']+$tax_amount),2) ?>
							<?=CURRENCY?>  <?=@$this->commonmod_model->GetTaxOnProduct($item['id'])?> 
							
								<?php $grand_total = $grand_total + $item['subtotal']+$tax_amount; ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-1">
							<?php echo anchor('cart/remove/'.$item['rowid'],'<i class="fa fa-trash" aria-hidden="true"></i>'); ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<!----------------empty space----->
						</div>
						
						
						
					</div>
					<hr class="col-md-12 col-sm-12 col-xs-12 clear_gap">
					<div class="col-xs-12 col-sm-12 col-md-12 height40 hidden-lg hidden-md"><!----------------empty space-----></div>
						
					<?php endforeach; ?>
					<div class="row"><div class="col-xs-12 height10"></div></div>
					
					<div class="row">
						<div class="">
							<div class="col-xs-12">
								<b>&nbsp;&nbsp; Order Total: <?=CURRENCY?> <?php echo number_format(@$grand_total,2); ?></b>
							</div>
							
						</div>
					</div>
					<?php } else{ ?>
					<div class="row"><div class="col-xs-12 height10"></div></div>
					
					<div class="row">
						<div class="">
							<div class="col-xs-12">
								<b>Shopping Cart is Empty.</b>
							</div>
							
						</div>
					</div>
					<?php } ?>
					
					
					
					<div class="row"><div class="col-xs-12 height10"></div></div>
					
				</div>
					<?php if (count($this->cart->contents()) > 0){ ?>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-3">
							<input type="button" value="Continue Shopping" class="button_padding button_color" onclick="window.location='<?=BASE_URL?>products'" />
						</div>
						<div class="col-xs-9">
							<input type="button" value="Clear Cart " onclick="clear_cart()" class="button_padding margin_right10 pull-right button_color">
							<input type="submit" value="Update Cart" class="button_padding margin_right10 pull-right button_color">
							<?php echo form_close(); ?>
							
						</div>
					</div>
				</div>
				<?php } ?>
				
			</div>
			
			
				<?php if (count($this->cart->contents()) > 0){ ?>
			<input type="button" value="Checkout" onclick="window.location='<?=BASE_URL?>checkout'" class="button_color button_padding margin_right10 pull-right">
				<?php }  ?>
					<input type="button" value="Go to Product Page" onclick="window.location='<?=BASE_URL?>products'" class="button_color button_padding margin_right10 pull-right">
			
			<div class="col-xs-12 height40"></div>
			
		</div>
	
</div>

	
	
	
    
    
    <script>
function clear_cart() {
	var result = confirm('Are you sure want to remobe all cart items?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}
</script>
    
    

<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
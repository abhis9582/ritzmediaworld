<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="<?=META_AUTHOR?>">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
<link href="<?=ADMIN_DIR?>css/jquery.dataTables.css" rel="stylesheet" />
</head>
<body>
<?php $this->load->view("Element/front/header.php");?>

<section class="aboutus-section1">
	<div class="container">
		<div class="row row1">
			<div class="col-lg-6">
				<div class="about-left contact-left">
					<h1><?=$Content[0]['page_heading']?></h1>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="about-right">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Booking</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactus-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="user_left_area">  
            	    <?php $this->load->view("Element/front/myaccount-left.php");?>
            	</div>
            </div>
            <div class="col-lg-9">
                <div class="user_right_area">
                    <h3 class="right_heading">My Booking</h3>
                
                   <?php if(count($AllorderList) > 0) { ?>
                   <table id="myTable">
                <thead>
        		<tr>
                  <th>Booking ID</th> 
                  <th>Date Added</th>
                  <th style="width:30px;">View</th>
                </tr>
        		</thead> 
                <tbody class="tabs-body">
                  <?php foreach($AllorderList as $Allorder) { 
        		  
        		  ?>
                  <tr>
                    <td>#<?=$Allorder['order_id']?></td>
                    <td><?=date("d/ m/ Y",strtotime($Allorder['date_added']));?></td>
                   <td> <a href="<?=BASE_URL?>user/orderdetail/<?=$Allorder['order_id']?>" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
                  <?php } else { ?>
            	  <p> You have not Booking yet.</p>
            	  <?php } ?>
	  </div>
            </div>
	    </div>
    </div>
</section>
 

<?php $this->load->view("Element/front/footer.php");?>

<script src="<?=ADMIN_DIR?>js/jquery.dataTables.js" ></script>
<script>
 $(document).ready(function(){
    $('#myTable').DataTable();
})
 </script>
<?php $this->load->view("Element/front/footer_common.php");?>

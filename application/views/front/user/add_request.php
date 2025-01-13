<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Bhalaai">
<title><?=$Content[0]['meta_title']?></title>
<meta name="description" content="<?=$Content[0]['meta_description']?>">
<meta name="keyword" content="<?=$Content[0]['meta_keywords']?>">
<?php $this->load->view("Element/front/header_common.php");?>
  
</head>

<body>
<?php $this->load->view("Element/front/header.php");?>
<?php $src = $this->image->getImageSrc("pages",$Content[0]['banner_image'],DEFAULT_HEADER_BANNER); ?>
<section class="aboutus-section1" style="background: url(<?=$src?>);">
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
						<li class="breadcrumb-item active" aria-current="page">Add Request</li>
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
                <h3 class="right_heading">Add Request</h3>
                <?php
if(validation_errors())
echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
if($this->session->flashdata("error"))  echo '<div class="normal" id="FLASH" name="FLASH">'.$this->session->flashdata("error").'<br></div>';
?>

    <form method="post" action="<?=BASE_URL.'user/add_request'?>/<?=$UserData[0]['user_id']?>" class="form-horizontal" role="form" enctype="multipart/form-data">
		 
						<input id="SaveStatus" name="submitF" type="hidden" value="1" /> 
						<table>
					
						    <tr>
						        <td><input type="text" name="first_name" value="<?=(isset($_POST['first_name'])!='')?$_POST['first_name']:''?>" placeholder="First Name"></td>
						    </tr>
							<tr>
						        <td><input type="text" name="department" value="<?=(isset($_POST['department'])!='')?$_POST['department']:''?>" placeholder="Department"></td>
						    </tr>
							<tr>
						        <td><input type="text" name="empid" value="<?=(isset($_POST['empid'])!='')?$_POST['empid']:''?>" placeholder="EMPID"></td>
						    </tr>
							<tr>
						        <td><input type="text" name="total_peaple" value="<?=(isset($_POST['total_peaple'])!='')?$_POST['total_peaple']:''?>" placeholder="Total People"></td>
						    </tr>
							
						    <tr>
						       <td><input type="text" name="total_rooms" value="<?=(isset($_POST['total_rooms'])!='')?$_POST['total_rooms']:''?>" placeholder="Total Rooms"></td>
						    </tr>
							
							<tr>
						       <td><select name="city" id="city" class="form-control" onchange="return getHotelByCity3(this.value)">
									<option>Select Location</option>
									<?php $AllCity2 = $this->listing_model->GetALLEnableCity();
									print_r($this->db->last_query());
									
									foreach($AllCity2 as $CityData1){ 
									$all_hotel = $this->commonmod_model->getHotelByCity($CityData1['id']);
									
									if(count($all_hotel) > 0){
									?>
										<option value="<?=$CityData1['id']?>"><?=$CityData1['name']?></option>
									<?php } } ?>
									 </select></td>
						    </tr>
						    <tr>
						       <td><select class="form-control" autocomplete="off"  onchange="return show_hotel_room_category(this.value);" name="listing_id" id="listing_id3">
						  <option value="">Select Hotel</option>
						</select></td>
						    </tr>
						    <tr>
						       <td><select class="form-control" autocomplete="off"  name="room_type" id="room_type">
						  <option value="">Select Room Type</option>
						</select></td>
						    </tr>
							
							<tr>
						       <td><input type="text" class="fromdatepicker" autocomplete="off" name="start_date" value="<?=(isset($_POST['start_date'])!='')?$_POST['start_date']:''?>" placeholder="Start Date">
						       <input type="text" class="fromdatepicker" name="end_date" autocomplete="off" value="<?=(isset($_POST['end_date'])!='')?$_POST['end_date']:''?>" placeholder="End Date"></td>
						    </tr>
							
						    <tr>
						        <td><textarea type="text" name="message" placeholder="Message" id="message"><?=(isset($_POST['message'])!='')?$_POST['message']:''?></textarea></td>
						    </tr>
						    <tr>
						        <td><button class="btn btn-primary" name="submitForm" type="submit">Submit</button></td>
						    </tr> 
						</table> 
                     </form>
                </div>
            </div>
        </div>
    </div>
</section>					



							
					



<?php $this->load->view("Element/front/footer.php");?>
 <script>

	   
	    function show_hotel_room_category(hotel_id) {
      
        
        $.ajax({
			 url : "<?php echo base_url('user/show_hotel_category'); ?>",
          type: "POST",
          data: {'hotel_id': hotel_id },
		  dataType: 'html',
           success: function(data){
          
           $("#room_type").html(data);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
    
 </script>
<?php $this->load->view("Element/front/footer_common.php");?>

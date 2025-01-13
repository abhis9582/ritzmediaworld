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

<body class="choose-state-bg">
<?php $this->load->view("Element/front/header2.php");?>

<div class="container">
        <div class="card3 col-md-4 col-md-offset-4">
        <p><img class="profile1-img-card" src="<?=FRONT_DIR?>image/common.png" alt="" /></p>
            
            <div class="form-group">
    <label for="exampleSelect1"></label>
	<span id="stateerr"></span>
    <select class="form-control" name="state_id" required id="state_id" onchange="return show_city(this.value);">
       
    <?php echo $this->commonmod_model->GetListingState();?>
    </select>
     <label for="exampleSelect1"></label>
	 <span id="cityerr"></span>
    
	<select class="form-control" id="city_id" name="city_id" style="display:none;" onchange="return show_property();">
      <option value="">SELECT CITY</option>
     
    </select>
     <label for="exampleSelect1"></label>
	  <span id="propertyerr"></span>
    <select class="form-control" id="property_drop" required style="display:none;">
      <option value="">Property Type</option>
       
    </select>
    
  </div>
  <p class="text-left1"><a href="javascript:void();" onclick="return searchProperties();" class="btn btn-default blackbtn">SEARCH NOW</a></p>
  
            
           
              </div>
              </div>


<?php $this->load->view("Element/front/footer.php");?>
<script>
 $(window).load(function (){
	
	 // show_state('<?=$UserData[0]['country'];?>','<?=$UserData[0]['state'];?>'); 
	
	 //show_city('<?=$UserData[0]['state'];?>','<?=$UserData[0]['city'];?>');
 });
 
 function searchProperties(){
 state_id = $("#state_id").val();
 city_id = $("#city_id").val();
 category_id = $("#property_drop").val();
 if(state_id==""){ 
 $("#state_id").focus();
 $("#stateerr").html("Please Choose State");
  return false;
 }
  if(city_id==""){ 
 $("#city_id").focus();
 $("#cityerr").html("Please Choose City");
 return false;
 }
  if(category_id==""){ 
 $("#property_drop").focus();
 $("#propertyerr").html("Please Choose Property Type");
  return false;
 }
 if (state_id !="") url = '/'+state_id;
 if (city_id !="") url += '/'+city_id;
 if (category_id !="") url += '/'+category_id;
 window.location.href='<?=BASE_URL?>search_properties'+url;
 
 }
 
 
      function show_property(country){ 
      $("#property_drop").show();
        state_id = $("#state_id").val();
 city_id = $("#city_id").val();

		 
        $.ajax({
			 url : "<?php echo base_url('user/show_propertytype'); ?>",
          type: "POST",
          data: {'state_id': state_id ,'city_id':city_id},
		  dataType: 'json',
           success: function(data2){
         
           $("#property_drop").html(data2);
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
	   
	   
	    function show_city(state,current_id2) {
      
        if(state==""){ $("#city_id").prop("disabled",true); }else{ $("#city_id").prop("disabled",false); }
        $.ajax({
			 url : "<?php echo base_url('user/show_listing_city'); ?>",
          type: "POST",
          data: {'state': state, 'current_id':current_id2 },
		  dataType: 'json',
           success: function(data){
           
           $("#city_id").html(data);
           $("#city_id").show();
           }, 
		   error: function(){
		   alert("there is error");
		   }
         });
		 
       }
    
 </script>
<?php $this->load->view("Element/front/footer_common.php");?>
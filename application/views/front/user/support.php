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

<!--second-head-->
<div class="second-head2">
<div class="container">
<div class="left-align col-md-6">
<p>My Properties</p>
</div>

<div class="right-align col-md-6 hidden-xs">
<p class="pull-right">HOME / My Properties</p>
</div>

</div>
</div><!--second-head-->








<div class="padding20px_leftright">
        
<div class="col-md-3 height500">
  <br>
  <br>
  <?php $this->load->view("Element/front/myaccount-left.php");?>
  
</div> 
 
<div class="col-md-9">
  
  
  <div class="col-md-11 col-sm-12 col-xs-12">
  
  
  <!------------after user login--------->
				            
				<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:20px;"></div> </div>
				<div class="black_color_p">
                     <h3 class="mainHeadText padding10px_table"> My Properties </h3>
				<br>
                </div>
					
				
				
              <?php if(count($SupportListing) > 0) { ?>
				<table class="table" >
				<tr>
				<th>Title</th>
				<th>State</th>
				<th>City</th>
					<th>Add Date</th>
				<th>Status</th>
				<th>Action</th>
				</tr>
                    <tbody class="tabs-body">
				  <?php  foreach($SupportListing as $ContentData) { ?>
				<tr>
				 <td><?=Ucfirst($ContentData['listing_title']);?> </td>
                                 <td><?=$this->commonmod_model->GetStateName($ContentData['state']);?> </td>
                                 <td><?=$this->commonmod_model->GetCityName($ContentData['city']);?> </td>
                                
                                 <td><?=date("d M,Y",strtotime($ContentData['add_date']));?> </td>
                               
                                 <td><?=($ContentData['status']==1)?'Active':'Archive';?></td>
				<td>    
						<a href="<?=BASE_URL.'user/view_listing/'.$ContentData['id']?>"> <i class="fa fa-eye" aria-hidden="true" title="View more"></i> </a>
						<a href="<?=BASE_URL.'user/edit_listing/'.$ContentData['id']?>"><i class="fa fa-pencil-square" aria-hidden="true" title="Edit more"></i> </a>
						<!--<a href="<?=BASE_URL.'user/delete_support/'.$ContentData['id']?>" onclick="return confirm('Are You Sure to Delete ?');">	<i class="fa fa-trash-o" aria-hidden="true" title="Delete"></i> </a> -->
					</td>
				</tr>
				  <?php } ?>
                        </tbody>
				</table>
					   <?php } ?>
            

	 
  
  <!-------------after user login close------>
  
  </div>
  
<div class="col-md-12">&nbsp; <!------------empty space--> <div style="height:100px;"></div> </div> 
</div>  
  
  
  
  
  
</div>




<?php $this->load->view("Element/front/footer.php");?>
<?php $this->load->view("Element/front/footer_common.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Manage Permission</title>
    <?php $this->load->view("Element/admin/header_common.php");?>

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
     <?php $this->load->view("Element/admin/header.php");?>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Manage Permission</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?=BASE_URL?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-laptop"></i>Manage Permission</li>						  	
					</ol>
				</div>
			</div>
              
           
		
			
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                      <?php
                    if(validation_errors())
                    echo'<div class="error" id="FLASH" name="FLASH">'.validation_errors().'</div>';
                    if($this->session->flashdata("error")){ 
                        echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata("error").'</div>';}
                    else if($this->session->flashdata("success")){ 
                        echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata("success").'</div>';}
                    if(isset($_SESSION['error'])){
                        unset($_SESSION['error']);
                    }
                    else if(isset($_SESSION['success'])){
                        unset($_SESSION['success']);
                    }
                ?>  <header class="panel-heading">
                            Manage Permission  
						
                          </header>
                        
  <div class="">
   <form class="form-horizontal" action="<?=BASE_URL.'admin/permission/'.$User_ID;?>" method="post"  style="padding-left: 25px; padding-bottom: 32px;">
    <input id="SaveStatus" name="submitF" type="hidden" value="1" />
	 <input id="admin_id" name="admin_id" type="hidden" value="<?=$User_ID?>" />
  <?

  for($i=0; $i<count($ALL_Modules); $i++){
 
  echo '<h3>'.$ALL_Modules[$i]['module_name'].'</h3>';
  echo '<div class="main_module">';
  echo '<input type="hidden" name="module_id2[]" value="'.$ALL_Modules[$i]['module_id'].'">'; 
  $getallfunction = $this->admin_model->GetAllFunctionsOfModule($ALL_Modules[$i]['module_id'],$User_ID);

  for($j=0;$j<count($getallfunction);$j++){
	  
  $sel1 = ($getallfunction[$j]['status']==1)?'checked':''; 
  $sel2 = ($getallfunction[$j]['status']==0)?'checked':''; 

  

   echo '<input type="hidden" name="module_id[]" value="'.$getallfunction[$j]['module_id'].'">';
   
   echo '<input type="hidden" name="permission_function_id[]" value="'.$getallfunction[$j]['id'].'">'; 
   echo '<div class="my_navigation">';
   echo "<div class='func_heading'>".ucfirst($this->admin_model->getModuleFunctionName($getallfunction[$j]['function_id']))."</div>";
   
   echo "<div class='function_span' style='width:100%'>
   <input type='hidden' name='function_id_".$getallfunction[$j]['id']."[]' value='".$getallfunction[$j]['function_id']."' >
   
   Enable<input type='radio' name='status_".$getallfunction[$j]['id']."[]' value='1' ".$sel1." > &nbsp;&nbsp; Disable <input type='radio' name='status_".$getallfunction[$j]['id']."[]' value='0' ".$sel2." ></div>";
   echo '</div>';
  }
   echo '</div>';
  
  }
  
  ?>
  <div class="form-group">
                                          <div class="col-md-12" style="margin-top:15px;">
                                              <button class="btn btn-primary admin-buttns2" name="submitForm" type="submit">Submit</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
                                          </div>
                                      </div>
  </form>
  </div>
                         
                      </section>
                  </div>
              </div>
            
		
              <!-- project team & activity end -->

          </section>
         <?php $this->load->view("Element/admin/footer_common.php");?>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

 <?php $this->load->view("Element/admin/footer.php");?>

  </body>
</html>

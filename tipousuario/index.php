<?php 

require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
//Redirect::to("users/account.php");
//include_once("header.php"); 
include_once("include/config.php");




?>
<style>
#error-msg{ display:none }
#success-msg{ display:none }
.pagination .custom-active {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #ddd;
    border-image: none;
    border-style: solid;
    border-width: 1px 1px 1px 0;
    float: left;
    line-height: 34px;
    padding: 0 14px;
    text-decoration: none;
}

</style>


<div class="block-header">
    <h2>CADASTRO DE TIPO DE USUARIOS </h2>
</div>
<!-- Tabs With Icon Title -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

   <div class="alert" id="error-msg">

   </div>
 
  <div class="alert alert-success" id="success-msg">

  </div>
  <br>
  <br>
 <a class="btn btn-primary" href="add.php" style="float:left;">Adicionar Função    </a>
 <br>
 <br>

<div class="widget widget-table action-table">

           <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nome da Função </th>
                    <!-- <th> Last Name</th>
                    <th> Username</th>
                    <th> Email</th> -->
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody id="target-content">
                
                
                </tbody>
                 </table>
                 
                 

            </div>
            
            <div align="center" id="append-pagination">
           

          </div>

            <!-- /widget-content --> 
          </div>




          </div>




          </div>
        </div>
      </div>

     <?php
	 
	 ?>     
         
      
												
											
													 <!-- Button to trigger modal -->
                                                   
                                                     
                                                   
                                    
                                   
											
          <?php include_once("footer.php");  ?>
		  
    
                                                   
<?php 

require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
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


 <div id="formcontrols" class="tab-pane active">
 
 <div class="alert" id="error-msg">

 </div>
 
  <div class="alert alert-success" id="success-msg">

  </div>
                                                
                                                
                                            
                                            
								<form class="form-horizontal" id="add-tipousuario-form" method="post">
									<fieldset>
										
<!-- 										<div class="control-group">											
											<label for="username" class="control-label">Username</label>
											<div class="controls">
												<input type="text" placeholder="Username" name="user_name"   required id="username" class="span6">
												<p class="help-block">Your username is for logging in and cannot be changed.</p>
											</div> 		
										</div> 
										 -->
										
										<div class="control-group">											
											<label for="nome" class="control-label">Nome</label>
										
												<input class="form-control" type="text" placeholder="Nome" name="nome"  required id="nome" class="span6">
														
										</div> <!-- /control-group -->
										
										
<!-- 										<div class="control-group">											
											<label for="lastname" class="control-label">Last Name</label>
											<div class="controls">
												<input type="text" name="first_name" placeholder="Last Name" required id="lastname" class="span6">
											</div> 			
										</div> 
										
										
										<div class="control-group">											
											<label for="email" class="control-label">Email Address</label>
											<div class="controls">
												<input type="email" name="email" placeholder="Email" id="email" class="span4">
											</div>				
										</div>
										
										
										<br><br>
										
										<div class="control-group">											
											<label for="password1" class="control-label">Password</label>
											<div class="controls">
												<input type="password" name="password"  id="password" class="span4">
											</div> 			
										</div> 
										
										
										<div class="control-group">											
											<label for="password2" class="control-label">Confirm</label>
											<div class="controls">
												<input type="password" name="cpassword"  id="cpassword" class="span4">
											</div> 			
										</div>  -->
	
										 <br>
										
											
										<div class="form-actions">
											<button class="btn btn-primary" type="button" id="add">SALVAR</button> 
											<a href="index.php"  class="btn">VOLTAR</a>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>


								
          </div>
          </div>
          </div>
      </div>
        
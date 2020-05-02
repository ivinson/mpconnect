<?php 

require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
//Redirect::to("users/account.php");
//include_once("header.php"); 
include_once("include/config.php");

$fetch_student_info = $db_con->prepare("select * from tipousuario where id = :id");
$fetch_student_info->execute(array(':id' => $_GET['id']));
$list = $fetch_student_info->fetchAll(PDO::FETCH_ASSOC);
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
  
								<form class="form-horizontal" id="edit-tipousuario-form" method="post">
									<fieldset>
										<input type="hidden" name="id" value="<?php echo $list[0]['id']; ?>">
										

	<!-- 									<div class="control-group">											
											<label for="nome" class="control-label">Nome da função</label>
											<div class="controls">
												<input type="text" value="<?php echo $list[0]['nome']; ?>" placeholder="Username" name="user_name"   required id="username" class="span6">
												<p class="help-block">Your username is for logging in and cannot be changed.</p>
											</div> 			
										</div>  -->
										
										
                      <div class="col-md-8">
                       



								 		<div class="control-group">											
											<label for="nome" class="control-label">Nome</label>
											
												<input class="form-control" type="text" value="<?php echo $list[0]['nome']; ?>"  placeholder="Nome" name="nome"  required id="nome" class="span6">
													
										</div>  
										
										
	
										 <br>
										
											
										<div class="form-actions">
											<button class="btn btn-primary" type="button" id="edit">SALVAR</button> 
											<a href="index.php"  class="btn">VOLTAR</a>
										</div> <!-- /form-actions -->
									</fieldset>
								</form>
								</div>
          </div>
          </div>
          </div>
      </div>

          
         
          <?php include_once("footer.php");  ?>
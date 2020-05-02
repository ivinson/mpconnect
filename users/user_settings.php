<?php

/*TODO

### ok Upload da tabela de excel de cidades
### Restante das tabelas auxiliares
### Organizar permissionamento


Salvar Resto de campos

*/

?>
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php




    //echo $_POST['datepicker1'];
    //$nampcdesde = date('Y-m-d H:i:s',strtotime(Input::get("datepicker1")));
    //die();


if (!securePage($_SERVER['PHP_SELF'])){die();}?>

<?php
//dealing with if the user is logged in
if($user->isLoggedIn() && !checkMenu(2,$user->data()->id)){
    if (($settings->site_offline==1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')){
        $user->logout();
        Redirect::to($us_url_root.'users/maintenance.php');
    }
}

//dump($user);
//print_r($_POST);

$modulo1Chk = '';
$modulo2Chk = '';
$moduloeadChk  = '';
$moduloedvChk  = '';
$moduloprotecaoChk  = '';

//exit;
$raw = date_parse($user->data()->join_date);
$signupdate = $raw['month']."/".$raw['year'];
$emailQ = $db->query("SELECT * FROM email");
$emailR = $emailQ->first();
// dump($emailR);
// dump($emailR->email_act);
//PHP Goes Here!
$errors=[];
$successes=[];
$userId = $user->data()->id;
$grav = get_gravatar(strtolower(trim($user->data()->email)));
$validation = new Validate();
$userdetails=$user->data();


//Temporary Success Message
$holdover = Input::get('success');
if($holdover == 'true'){
    bold("Account Updated");
}
//Forms posted
if(!empty($_POST)) {
    //$token = $_POST['csrf'];
    //if(!Token::check($token)){
        //die('Token doesn\'t match!');
    //}else {
        //Update display name
        if ($userdetails->username != $_POST['username']){
            $displayname = Input::get("username");
            $fields=array(
                'username'=>$displayname,
                'un_changed' => 1,
            );
            $validation->check($_POST,array(
                'username' => array(
                    'display' => 'Username',
                    'required' => true,
                    'unique_update' => 'users,'.$userId,
                    'min' => 1,
                    'max' => 25
                )
            ));
            if($validation->passed()){
                if(($settings->change_un == 2) && ($user->data()->un_changed == 1)){
                    Redirect::to('user_settings.php?err=Username+has+already+been+changed+once.');
                }
                $db->update('users',$userId,$fields);
                $successes[]="Username updated.";
            }else{
                //validation did not pass
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
            }
        }else{
            $displayname=$userdetails->username;
        }
        //Update first name
        if ($userdetails->fname != $_POST['fname']){
            $fname = Input::get("fname");
            $fields=array('fname'=>$fname);
            $validation->check($_POST,array(
                'fname' => array(
                    'display' => 'First Name',
                    'required' => true,
                    'min' => 1,
                    'max' => 25
                )
            ));
            if($validation->passed()){
                $db->update('users',$userId,$fields);
                $successes[]='First name updated.';
            }else{
                //validation did not pass
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
            }
        }else{
            $fname=$userdetails->fname;
        }

        //==========================================
        //==========================================
        //Adaptacao de settings para MPC
        //Ivinson Lima
        //Update City of chapter or volunteer
        //dump($userdetails);
        if ($userdetails->whats != $_POST['whats']){
            //dump($_POST['whats']);
            //dump($userdetails->whats );
            $whats = Input::get("whats");
            //dump($whats);
            $fields=array('whats'=>$whats);
            $validation->check($_POST,array(
                'whats' => array(
                    'display' => 'Whatsapp',
                    'required' => true,
                    'min' => 1,
                    'max' => 25
                )
            ));
            if($validation->passed()){
                $db->update('users',$userId,$fields);
                $successes[]='WhatsApp atualizado.';
            }else{
                //validation did not pass
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
            }
        }else{
            $whats=$userdetails->whats;
        }


        //==========================================
        //Adaptacao de settings para MPC
        //Ivinson Lima
        //Update city of chapter or volunteer
        
        if ($userdetails->idcidade != $_POST['idcidade']){
            $idcidade = Input::get("idcidade");
            dump($idcidade);
            $fields=array('idcidade'=>$idcidade);
            $validation->check($_POST,array(
                'idcidade' => array(
                    'display' => 'Cidade do Voluntário ',
                    'required' => true,
                    'min' => 1,
                    'max' => 25
                )
            ));
            //dump($userdetails);
              if($validation->passed()){
                    $db->update('users',$userId,$fields);
                    $successes[]='Cidade do Voluntário Atualizado.';
                }else{
                    //validation did not pass
                    foreach ($validation->errors() as $error) {
                        $errors[] = $error;
                    }
                }
            }else{
                $idcidade=$userdetails->idcidade;
            }



        //==========================================
        //Adaptacao de settings para MPC
        //Ivinson Lima
        //Update type of chapter or volunteer
        //dump($userdetails);
        if ($userdetails->idtipo != $_POST['idtipo']){
            $idtipo = Input::get("idtipo");
            //dump($idtipo);
            $fields=array('idtipo'=>$idtipo);
            
            $db->update('users',$userId,$fields);
            $successes[]='Função do Voluntário Atualizado.';

            // $validation->check($_POST,array(

            //     'idtipo' => array(
            //         'display' => 'Tipo do Voluntario',
            //         'required' => true,
            //         'min' => 1,
            //         'max' => 25
            //     )
            // ));

            // if($validation->passed()){
            // }else{
            //     // validation did not pass
            //     foreach ($validation->errors() as $error) {
            //         $errors[] = $error;
            //     }
            // }
        }else{
            $idtipo=$userdetails->idtipo;
        }



        //Update last name
        if ($userdetails->lname != $_POST['lname']){
            $lname = Input::get("lname");
            $fields=array('lname'=>$lname);
            $validation->check($_POST,array(
                'lname' => array(
                    'display' => 'Last Name',
                    'required' => true,
                    'min' => 1,
                    'max' => 25
                )
            ));
            if($validation->passed()){
                $db->update('users',$userId,$fields);
                $successes[]='Last name updated.';
            }else{
                //validation did not pass
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
            }
        }else{
            $lname=$userdetails->lname;
        }
        //Update email
        if ($userdetails->email != $_POST['email']){
            $email = Input::get("email");
            $fields=array('email'=>$email);
            $validation->check($_POST,array(
                'email' => array(
                    'display' => 'Email',
                    'required' => true,
                    'valid_email' => true,
                    'unique_update' => 'users,'.$userId,
                    'min' => 3,
                    'max' => 75
                )
            ));
            
            if($validation->passed()){
                $db->update('users',$userId,$fields);
                if($emailR->email_act==1){
                    $db->update('users',$userId,['email_verified'=>0]);
                }
                $successes[]='Email updated.';
            }else{
                //validation did not pass
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
            }
        }else{
            $email=$userdetails->email;
        }

        /*  
            ok Telefone Principal - telefone1
            ok Telefone Secundario - telefone2
            Data Nascimento - nascimento
            
        */

        //Update Telefone
        if ($userdetails->telefone1 != $_POST['tel1']){
                $telefone1 = Input::get("tel1");
                $fields=array('telefone1'=>$telefone1);
                $db->update('users',$userId,$fields);
                $successes[]='Telefone atualizado.';
            }
        else{
                $telefone1=$userdetails->telefone1;
        }            

        //Update Telefone secundario
        if ($userdetails->telefone2 != $_POST['tel2']){
                $telefone2 = Input::get("tel2");
                $fields=array('telefone2'=>$telefone2);
                $db->update('users',$userId,$fields);
                $successes[]='Telefone secundario atualizado.';
            }
        else{
                $telefone2=$userdetails->telefone2;
        }    

        //Update Data de Nascimento
        if ($userdetails->nascimento != $_POST['datanascimento']){
                //$nascimento = Input::get("datanascimento");
                $nascimento = date('Y-m-d H:i:s',strtotime(Input::get("datanascimento")));
                $fields=array('nascimento'=>$nascimento);
                $db->update('users',$userId,$fields);
                $successes[]='Data de nascimento atualizado.';




            }
        else{
                $nascimento=$userdetails->nascimento;
        }

        /*
            2 Email - emailsecundario
            Modulo 1 e 2 - modulo1 modulo2
            Na MPC Desde - nampcdesde

        */
        //Update Email
        if ($userdetails->emailsecundario != $_POST['email2']){
                $emailsecundario = Input::get("email2");
                $fields=array('emailsecundario'=>$emailsecundario);
                $db->update('users',$userId,$fields);
                $successes[]='Email secundario atualizado.';
            }
        else{
                $emailsecundario=$userdetails->emailsecundario;
        }


        $modulo1="";
        $modulo2="";
        $moduloead="";    
        $moduloedv = "";
        $modulocapacitacao_crianca="";
    

        if(isset($_POST['modulo1'])){
            //Update Modulos
            $fields=array('modulo1'=>'1');
            $db->update('users',$userId,$fields);
            $successes[]='Modulo atualizado.';

            }
        else{
                    $fields=array('modulo1'=>'0');
                    $db->update('users',$userId,$fields);
                    $successes[]='Modulo atualizado.';

                    $modulo1=$userdetails->modulo1;
                    if($modulo1>0){ $modulo1Chk = 'checked';}
  
        }


        //dump($userdetails);
        if(isset($_POST['modulo2'])){
            //Update Modulos
            $fields=array('modulo2'=>'1');
            $db->update('users',$userId,$fields);
            $successes[]='Modulo atualizado.';

            }
        else{
                    $fields=array('modulo2'=>'0');
                    $db->update('users',$userId,$fields);
                    $successes[]='Modulo atualizado.';

                    $modulo2=$userdetails->modulo2;
                    if($modulo2>0){ $modulo2Chk = 'checked';}
  
        }
  
        //dump($userdetails);
  
        if(isset($_POST['moduloead'])){
            //Update Modulos
            $fields=array('ead'=>'1');
            $db->update('users',$userId,$fields);
            $successes[]='Modulo atualizado.';

            }
        else{
                    $fields=array('ead'=>'0');
                    $db->update('users',$userId,$fields);
                    $successes[]='Modulo atualizado.';

                    $moduloead=$userdetails->ead;
                    if($moduloead>0){ $moduloeadChk = 'checked';}
  
        }        


        if(isset($_POST['moduloedv'])){
            //Update Modulos
            $fields=array('workshop_edv'=>'1');
            $db->update('users',$userId,$fields);
            $successes[]='Modulo atualizado.';

            }
        else{
                    $fields=array('workshop_edv'=>'0');
                    $db->update('users',$userId,$fields);
                    $successes[]='Modulo atualizado.';

                    $moduloedv=$userdetails->workshop_edv;
                    if($moduloedv>0){ $moduloedvChk = 'checked';}
  
        }

        if(isset($_POST['moduloprotecao'])){
            //Update Modulos
            $fields=array('capacitacao_crianca'=>'1');
            $db->update('users',$userId,$fields);
            $successes[]='Modulo atualizado.';

            }
        else{
                    $fields=array('capacitacao_crianca'=>'0');
                    $db->update('users',$userId,$fields);
                    $successes[]='Modulo atualizado.';

                    $moduloprotecao=$userdetails->capacitacao_crianca;
                    if($moduloprotecao>0){ $moduloprotecaoChk = 'checked';}
  
        }

  
  
  
// moduloead
// moduloedv
// moduloprotecao
  
  
  
  
  
  
  
  
  
  
  
  
  
  
        if ($userdetails->nampcdesde != $_POST['datepicker1']){
                $nampcdesde = date('Y-m-d H:i:s',strtotime(Input::get("datepicker1")));

                $fields=array('nampcdesde'=>$nampcdesde);
                $db->update('users',$userId,$fields);
                $successes[]='Adesão atualizada.';
            }
        else{
                $nampcdesde=$userdetails->nampcdesde;
        }





        if(!empty($_POST['password'])) {
            $validation->check($_POST,array(
                'old' => array(
                    'display' => 'Old Password',
                    'required' => true,
                ),
                'password' => array(
                    'display' => 'New Password',
                    'required' => true,
                    'min' => $settings->min_pw,
                'max' => $settings->max_pw,
                ),
                'confirm' => array(
                    'display' => 'Confirm New Password',
                    'required' => true,
                    'matches' => 'password',
                ),
            ));
            foreach ($validation->errors() as $error) {
                $errors[] = $error;
            }
            if (!password_verify(Input::get('old'),$user->data()->password)) {
                foreach ($validation->errors() as $error) {
                    $errors[] = $error;
                }
                $errors[]='There is a problem with your password.';
            }
            if (empty($errors)) {
                //process
                $new_password_hash = password_hash(Input::get('password'),PASSWORD_BCRYPT,array('cost' => 12));
                $user->update(array('password' => $new_password_hash,),$user->data()->id);
                $successes[]='Password updated.';
            }
        }
    
        header('Location: ' . 'user_settings.php?type=successes', true, '303');
        //die();



}else{
    $displayname=$userdetails->username;
    $fname=$userdetails->fname;
    $lname=$userdetails->lname;
    $email=$userdetails->email;
    $whats=$userdetails->whats;
    $telefone1=$userdetails->telefone1;
    $telefone2=$userdetails->telefone2;
    $emailsecundario=$userdetails->emailsecundario;
    

    #Data de Ingresso na MPC
    $time1 = strtotime($userdetails->nampcdesde);
    $myFormatForView1 = date("d/m/Y", $time1);
    $nampcdesde=$myFormatForView1;

    #Data nascimento
    $time = strtotime($userdetails->nascimento);
    $myFormatForView = date("d/m/Y", $time);
    $nascimento=$myFormatForView;

    #Configura vizualização de modulos
    $modulo1=$userdetails->modulo1;
    $modulo2=$userdetails->modulo2;
    $moduloead=$userdetails->ead;
    $moduloedv=$userdetails->workshop_edv;
    $moduloprotecao=$userdetails->capacitacao_crianca;
  
    if($modulo1>0){ $modulo1Chk = 'checked';}
    if($modulo2>0){ $modulo2Chk = 'checked';}
    if($moduloead>0){ $moduloeadChk = 'checked';}
    if($moduloedv>0){ $moduloedvChk = 'checked';}
    if($moduloprotecao>0){ $moduloprotecaoChk = 'checked';}
  
  
  

    $idtipo=$userdetails->idtipo;
    $idcidade=$userdetails->idcidade;


}



    //Cidades e Funcoes
    $tbtipoUsuario = $db->query("SELECT * FROM tipousuario order by nome");
    $selectTipo = "";
    foreach ($tbtipoUsuario->results() as $row) {

        $selected = "";
        if($row->id == $user->data()->idtipo){$selected = "selected";}
      
      $nome_funcao =  utf8_encode($row->nome);

        $selectTipo = $selectTipo . "<option {$selected}  value={$row->id}>  {$nome_funcao} </option>";

        //$errors[] = $error;
        //dump($row);
    }

$selectTipo = "<option value=''> Escolha uma função </option>" . $selectTipo;
    //dump($selectTipo);

    $tbcidades = $db->query("SELECT * FROM cidades  where status = 'ativo' order by nome_cidade");
    $selectCidade = "";
    foreach ($tbcidades->results() as $row) {

        $selected = "";

        if($row->id == $user->data()->idcidade){$selected = "selected";}
        $nome_cidade = utf8_encode($row->nome_cidade);
        $selectCidade = $selectCidade . "<option {$selected}  value={$row->id}> 
        {$nome_cidade} </option>";

        //$errors[] = $error;
        //dump($row);
    }
    $selectCidade = "<option value=''> Escolha uma cidade </option>" . $selectCidade;
    //dump($selectCidade);
    //dump($tbcidades);
    //exit;


?>
 <form name='updateAccount' action='user_settings.php' method='post'>
        <div class="block-header">
            <h2>ATUALIZAÇÃO DE CADASTRO</h2>
            <span class="bg-danger"><?=display_errors($errors);?></span>
            <span><?=display_successes($successes);?></span>
        </div>
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                       
                    <div class="body">
                        <div class="row clearfix"> 
                        

                        <div class="header">
                          <h2>
                              INFORMAÇÕES GERAIS
                              <small> Esse é o seu cadastro! Aqui é onde os dados pessoais, que constarão em seu relatório ministerial devem ser agendados.Tambem serão mostrados na agenda do Site da MPC seu telefone, cidade, nome e contato. <b>Deixe sempre atualizado!</b></small>
                          </h2>
                        </div>   
                        <br> 



<!-- 
                        <div class="row">
                            <div class="col-md-4">                           
                                <label for="publicoestimado">
                                    Quantas pessoas participarão?
                                </label>
                                <input class="form-control" id="publicoestimado" name="publicoestimado" />
                            </div>
                        </div>
 -->


                                <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    
                                    <label>Função na MPC</label>                                   
                                    <select  class='form-control show-tick' id="idtipo" name="idtipo">
                                      <?=$selectTipo?>  
                                    </select>  
                                </div>
                                  
                                </div>
                                </div>

                                <div class="col-sm-6">                         
                                
                                <div class="form-group">
                                <div class="form-line">
                                   
                                    <label>Cidade que serve</label>
                                                        
                                    <select class='form-control' id="idcidade" name="idcidade">
                                    <?=$selectCidade?>  
                                    </select>
                                </div>
                             
                                </div>


                            </div>



                                <div class="col-sm-6">

                                  <!--   <div class="form-group">
                                       <div class="form-line"> -->
                                        <label>Nome de Usuário (Não pode ser alterado)</label>
                                        <?php if (($settings->change_un == 0) || (($settings->change_un == 2) && ($user->data()->un_changed == 1)) ) {
                                            echo "<input  class='form-control' type='text' name='username' value='$displayname' readonly/>";
                                        }else{
                                            echo "<input  class='form-control' type='text' name='username' value='$displayname'>";
                                        }
                                        ?>
                                        <!-- </div> -->
                                    </div>

                                    <div class="col-sm-6">   
<!-- 
                                    <div class="form-group">
                                        <div class="form-line">
 -->                                    <label>Nome</label>
                                        <input  class='form-control' type='text' name='fname' value='<?=$fname?>' />
                                        <!-- </div> -->
                                    </div>


                                     <div class="col-sm-6">  
                                   <!--  <div class="form-group">
                                     <div class="form-line">    -->
                                    <label>Sobrenome</label>
                                    <input  class='form-control' type='text' name='lname' value='<?=$lname?>' />
                                       <!-- </div> -->
                                    </div>


                                      <div class="col-sm-6">  
                                     <!-- <div class="form-group">
                                     <div class="form-line"> -->   
                                        <label>Email</label>
                                        <input class='form-control' type='text' name='email'  id="email" value='<?=$email?>' />
                                       <!-- </div> -->
                                    </div>



                                     <div class="col-sm-6">  

                                  <!--    <div class="form-group">
                                        <div class="form-line"> -->   
                                            <label>Whats</label>
                                            <input class='form-control' type='text' name='whats' id="whats" value='<?=$whats?>' />
                                       <!-- </div> -->
                                    </div>

<!-- </div> -->









                                            <div class="col-md-6">
                                                  <label class="control-label" for="tel1">Telefone principal</label>  
                                                  <input id="tel1" name="tel1" type="text" placeholder="" class="form-control input-md" value='<?=$telefone1?>' >
                                            </div>

                                            <div class="col-md-6">
                                              <label class=" control-label" for="tel2">Telefone secundario</label>  
                                              <input id="tel2" name="tel2" type="text" placeholder="" class="form-control input-md" value='<?=$telefone2?>'>  
                                            </div>

                          

                                            
                                                <!-- Appended Input-->
                                                <div class="col-md-6">
                                                  <label class=" control-label" for="email2">2° Email</label>
                                                  <input id="email2" name="email2" class="form-control" placeholder="placeholder" type="text" value='<?=$emailsecundario?>'>     
                                                </div>
                                                                        
                                                <div class="col-md-6">
                                                <label class=" control-label" for="desde">Na MPC desde</label>  
                                                          <input class="datepicker form-control" type="text" id="datepicker1" name="datepicker1" value='<?=$nampcdesde?>'>
                                                 
                                                </div> 



                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">                                  
                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingTwo_17">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false"
                                                       aria-controls="collapseTwo_17">
                                                        <i class="material-icons">forum</i> 
                                                        Formação Básica
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_17">
                                                <div class="panel-body">

                        
                        <div class="col-md-6">
    

                                <div class="row">
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox" name="modulo1" id="modulo1"   <?php echo $modulo1Chk?> >
                                        <span class="lever"></span>Fez Modulo 1</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox"   name="modulo2" id="modulo2"   <?php echo $modulo2Chk?> >
                                        <span class="lever"></span>Fez Modulo 2</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox"   name="moduloead" id="moduloead"   <?php echo $moduloeadChk?> >
                                        <span class="lever"></span> EAD de Capacitação de Líderes da MPC</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox"   name="moduloedv" id="moduloedv"   <?php echo $moduloedvChk?> >
                                        <span class="lever"></span>Workshop EdV</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="switch">
                                    <label>NÃO<input type="checkbox"   name="moduloprotecao" id="moduloprotecao"   <?php echo $moduloprotecaoChk?> >
                                        <span class="lever"></span>Capacitação sobre Proteção à Criança e ao Adolescente</label>
                                    </div>
                                </div> 
        
                            </div>
                                                   
                                                </div>
                                            </div>
                                        </div>



<!--                                         
<div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingThree_17">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseThree_17" aria-expanded="false"
                                                       aria-controls="collapseThree_17">
                                                        <i class="material-icons">picture_in_picture_alt</i> Função & Sustento
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_17">
                                                <div class="panel-body">
                                                      <div class="col-md-6">

                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Recebe Sustento pela MPC Brasil ?</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>


                                                    </div>


                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Via Cidade?</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <select >  
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Via Estadual?</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <select >  
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Via Regional?</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <select >  
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Via Ministério NAcional?</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <select >  
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>                                                    

                                                    <div class="row clearfix">
                                                        <div class="col-xs-9">
                                                        <label>Forma de Sustento</label>    

                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <select >  
                                                                    <option></option>
                                                                    <option>obreiro voluntário</option>
                                                             <option>sustento somente via MPC</option>
                                                            <option>sustento somente via REDE PARCEIROS\</option>
                                                            <option>sustento misto (MPC + REDE) </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div> -->


<!--                                     
<div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingOne_17">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17">
                                                      <i class="material-icons">done_all</i> 
                                                            Check-List Documentação
                                                        </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_17" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne_17">
                                                <div class="panel-body">
                                                  
                                                    <div class="row clearfix">
                                                        <div class="col-xs-3 ol-sm-3 col-md-3 col-lg-3">
                                                        <label>Termo de Adesão</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-3 ol-sm-3 col-md-3 col-lg-3">
                                                        <label>Referências</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-3 ol-sm-3 col-md-3 col-lg-3">
                                                        <label>Leitura do Código de Ética</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-3 ol-sm-3 col-md-3 col-lg-3">
                                                        <label>Declaração de Proteção</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-xs-3 ol-sm-3 col-md-3 col-lg-3">
                                                        <label>Certidão de Antecedentes Criminais</label>    
                                                            <div class="switch">
                                                                <label>NÃO<input type="checkbox" name="termoadesao" id="termoadesao"  >
                                                                <span class="lever"></span>SIM</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-9 ol-sm-9 col-md-9 col-lg-9">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple />
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

 -->

                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingFour_17">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseFour_17" aria-expanded="false"
                                                       aria-controls="collapseFour_17">
                                                        <i class="material-icons">folder_shared</i> Mudar senha atual
                                                    
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_17">
                                                

                                                <div class="panel-body">
                                                 
                                            

                                                   <!-- <div class="form-group"> -->
                                                        <label>Senha antiga (necessário para trocar a senha)</label>
                                                        <input class='form-control' type='password' name='old' />
                                                    <!-- </div> -->

                                                    <!-- <div class="form-group"> -->
                                                        <label>Nova Senha (<?=$settings->min_pw?> cracteres minimos, <?=$settings->max_pw?> máximos.)</label>
                                                        <input class='form-control' type='password' name='password' />
                                                    <!-- </div> -->

                                                    <!-- <div class="form-group"> -->
                                                        <label>Confirme sua Senha</label>
                                                        <input class='form-control' type='password' name='confirm' />
                                                    <!-- </div> -->


                                    

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                  
                  

                        <input type="hidden" name="csrf" value="<?=Token::generate();?>" />
                        <input class='btn btn-success btn-lg' type='submit' value='Confirmar' class='submit' />
                        <a class="btn btn-info btn-lg" href="account.php">Cancelar</a>
                 

                    <?php
                    if(isset($user->data()->oauth_provider) && $user->data()->oauth_provider != null){
                        echo "<strong>NOTE:</strong> If you originally signed up with your Google/Facebook account, you will need to use the forgot password link to change your password...unless you're really good at guessing.";
                    }
                    ?>

                </div>
                      </div>

</div>
</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->

    </form>





<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>



<script type="text/javascript">
//alert('aa');

$('#datepicker1').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY', time: false});
$('#datanascimento').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY',time: false});

    //Masked Input ============================================================================================================================
    //var $demoMaskedInput = $('.demo-masked-input');
    //Mobile Phone Number
    $('#whats').inputmask('+99 (99) [9]9999-9999',{ placeholder: '+__ (__) ____-____' });
    //Phone Number
    $('#tel1').inputmask('+99 (99) [9]9999-9999',{ placeholder: '+__ (__) ____-____' });
    $('#tel2').inputmask('+99 (99) [9]9999-9999',{ placeholder: '+__ (__) ____-____' });
    $('#email').inputmask({ alias: "email" });
    $('#email2').inputmask({ alias: "email" });
        

</script>

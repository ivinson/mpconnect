<?php
  ob_start();
  header('Content-Type: text/html; charset=utf-8');
  require_once 'init.php';
  $db = DB::getInstance();



// $string="olá à mim! ñ";
function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}
// echo tirarAcentos($string);

  //Consultado via ajax pra validar cpf 
  //cadastro_debora_aberto.php?act=verificacpf&cpf=225.591.858-732
  if( $_REQUEST['act'] == 'verificacpf'){
   
    $total = $db->query("select count(*) as existe from deboras where cpf like '".$_REQUEST['cpf'] ."'")->results()[0]->existe;
    if($total > 0){ 
      
      
      echo json_decode($total)  ;
     
    }else{
      
      echo json_decode($total)  ;

    }
   
   die();
 }
  
  
// ***********************************







if(!empty($_POST)){  
  //   $datefim = strtr(Input::get("dtfim") , '/', '-');
  //   echo " <br> -- ". date('Y-m-d', strtotime($dateinicio));
  //   echo " <br> -- ". date('Y-m-d', strtotime($datefim));
  //   $date = date("Y-m-d H:i:s");
  //   echo Input::get("dtinicio") . ' 00:00:00';
  //   echo "<br>";
  //   $dt_nasc = strtr(Input::get("dt_nasc_cad") , '/', '-');
  $dt_nasc = date('Y-m-d',strtotime(strtr(Input::get("dt_nasc_cad") , '/', '-')));  
  
//   $val = "á|â|à|å|ä ð|é|ê|è|ë í|î|ì|ï ó|ô|ò|ø|õ|ö ú|û|ù|ü æ ç ß abc ABC 123";
//   echo iconv('UTF-8','ASCII//TRANSLIT',$val); 
  
  $thread = array(            
      //'nome'             => date('Y-m-d', strtotime($dateinicio)),
//       'nome'              =>  htmlspecialchars( Input::get('nome_cad'), ENT_NOQUOTES, "UTF-8"),
//       'nome'              =>  iconv('UTF-8','ASCII//TRANSLIT',Input::get('nome_cad')),
//       'nome'              =>  tirarAcentos((utf8_encode(Input::get('nome_cad')),
      'nome'              =>  tirarAcentos($_POST['nome_cad']),
      'coordenadora'      => Input::get('coordenadora_cad'),    
      'endereco'          => tirarAcentos($_POST['endereco_cad']),
      'bairro'            => Input::get('bairro_cad'),
      'cep'               => Input::get('cep_cad'),
      'cidade'            =>  tirarAcentos($_POST['cidade_cad']),
      'estado'            =>  tirarAcentos($_POST['estado_cad']),
      'telefone'          => Input::get('telefone_cad'),
      'email'             => Input::get('email_cad'),
      'dt_nascimento'     => $dt_nasc, 
    //   'dt_nascimento'     => Input::get('dt_nasc_cad'),
      'igreja'            => tirarAcentos($_POST['igreja_cad']),
      'nome_pastor'       => tirarAcentos($_POST['nome_pastor_cad']),
      'telefone_igreja'   => Input::get('telefone_igreja_cad'),
      'email_igreja'      => Input::get('email_igreja_cad'),
      'dt_cadastro'       => date("Y-m-d H:i:s"),
    //   'dt_cadastro'       => Input::get('data_de_cadastro_cad'),
      'contr_proj_sinfonia'  => Input::get('proj_sinfonia'),
      'projeto_geracao'    => Input::get('projeto_geracao'),
      'profissao'          => Input::get('profissao_cad'),
      'status'             => 'ativo',
      'cpf'                => Input::get('cpf_cad')
  );

    
//     dump($thread); 
//     die();
 
  
    // //   echo "get id" . $_GET['id'];

    //   if(!empty($_GET['id'])){
    //       //Atualiza cidade
    //       $iid =  $db->update('cidades',$_GET['id'],$thread);  
    //       Redirect::to('listar_cidades.php?msg=<h1>Atualizado com sucesso</h1> ->' . $iid );    
    //     echo 'Atualiza';
    //   }else{
        //Insere uma nova cidade
  mysql_set_charset("utf8");
    $iid =  $db->insert('deboras',$thread);
    Redirect::to('https://mpc.org.br/mpconnect/users/cadastro_debora_aberto.php?msg=<br><br><h3>Suas informações foram incluidas com sucesso</h3>     Escreva ou ligue para a coordenadora de seu Estado para saber<br> onde há uma reunião de oração do Desperta Débora proxima de você.     ' );    
  
//     echo 'Incluida';
    //   }
  
}



if(!empty($_GET)){
  
    echo $_GET['msg'] ;
  echo 'Por favor, 
    clique aqui em 
    
   <a href="https://www.despertadebora.com.br/contato-lideranca"> Contato </a>';
    echo '<center>     <img src="https://mpc.org.br/mpconnect/users/images/concluido.jpeg" /> </center>';
  
  
    die();
  
  
}








?>
  <?php require_once $abs_us_root . $us_url_root . 'users/helpers/helpers.php'; ?>
  <?php require_once $abs_us_root . $us_url_root . 'users/includes/user_spice_ver.php'; ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (file_exists($abs_us_root . $us_url_root . 'usersc/includes/head_tags.php')) {
        require_once $abs_us_root . $us_url_root . 'usersc/includes/head_tags.php';
    }
    ?>
      <title>MPC Connect - Sistema Administrativo de envio de ralatórios </title>
      <!-- Favicon-->
      <link rel="icon" href="favicon.ico" type="image/x-icon">
      <link rel="manifest" href="<?= $us_url_root ?>manifest.json">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!-- Bootstrap Core Css -->
      <link href="<?= $us_url_root ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
      <!-- Waves Effect Css -->
      <link href="<?= $us_url_root ?>plugins/node-waves/waves.css" rel="stylesheet" />
      <!-- Animation Css -->
      <link href="<?= $us_url_root ?>plugins/animate-css/animate.css" rel="stylesheet" />
      <!-- Morris Chart Css-->
      <link href="<?= $us_url_root ?>plugins/morrisjs/morris.css" rel="stylesheet" />
      <!-- Bootstrap Material Datetime Picker Css -->
      <link href="<?= $us_url_root ?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
      <!-- Wait Me Css -->
      <link href="<?= $us_url_root ?>plugins/waitme/waitMe.css" rel="stylesheet" />
      <!-- Bootstrap Select Css -->
      <link href="<?= $us_url_root ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
      <!-- Custom Css -->
      <link href="<?= $us_url_root ?>css/style.css" rel="stylesheet">
      <!-- Custom Css -->
      <link href="<?= $us_url_root ?>/users/css/custom.css" rel="stylesheet">
      <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
      <link href="<?= $us_url_root ?>css/themes/all-themes.css" rel="stylesheet" />
  </head>

  <style>
    .sidebar .user-info {
/*       padding: 13px 15px 12px 15px; */
      white-space: nowrap;
      position: relative;
      border-bottom: 1px solid #e9e9e9;
      background: #3f51b5 !Important;
      background: indigo !Important;
      /* background: #88aa89 !Important; */
      height: 150px;
    }

    .my-card {
      /* position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%; */
    }

    a:hover {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
    }

    .form-group .form-line {
      width: 100%;
      position: relative;
      border-bottom: 1px solid #ddd;
    }

    .form-group .form-line:after {
      content: '';
      position: absolute;
      left: 0;
      width: 100%;
      height: 0;
      bottom: -1px;
      -moz-transform: scaleX(0);
      -ms-transform: scaleX(0);
      -o-transform: scaleX(0);
      -webkit-transform: scaleX(0);
      transform: scaleX(0);
      -moz-transition: 0.25s ease-in;
      -o-transition: 0.25s ease-in;
      -webkit-transition: 0.25s ease-in;
      transition: 0.25s ease-in;
      border-bottom: 1px solid #777;
    }

    .sidebar .user-info {
/*       padding: 13px 15px 12px 15px; */
      white-space: nowrap;
      position: relative;
      border-bottom: 1px solid #e9e9e9;
      background: #3f51b5 !Important;
      background: indigo !Important;
      /* background: #88aa89 !Important; */
      height: 150px;
    }
    
    
    
    
    
.container-fluid {
    padding-right: 0px;
    padding-left: 0px;
    margin-right: 0px;
    margin-left: 0px;
}    
    
    
    
    
  </style>

  <body class="theme-indigo">
    <section class="content" style="margin-left: 0px; margin-top: 0px;">
      <div class="container-fluid">
        <div class="container-fluid">
           

                       
                       
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"   style="
    padding-left: 0px;
    padding-right: 0px;
">
            <div class="card">
              <div class="header bg-orange">
                
                <h1>
                  DESPERTA DÉBORA
                  (CADASTRO NACIONAL)
                  <br>
                  <small>
Ao concluir esse cadastro, estou formalizando o meu compromisso de orar 
                    15 minutos, diariamente,
                    por meu filho e por uma Geração Comprometida com Deus
                  </small>
                </h1>
                <br>
                <br>
                
              </div>
             <br> 

                <form accept-charset="utf-8" action="cadastro_debora_aberto.php"  method='post'> 
<div class="row " style="
    padding-left: 40px;
    padding-right: 40px;
">
  <div class="col-sm-8">
    <label for="cpf_cad">DIGITE SEU CPF</label>
    <p>
      O seu CPF é para evitar que seu cadastro seja repetido. Ele permanecerá em total sigilo.
    </p>
    <div class="form-group">
<!--       <div class="form-line"> -->
        <input required type="text" id="cpf_cad" name="cpf_cad" class="form-control" placeholder="Digite seu CPF">
<!--       </div> -->
    </div>
  </div>
  <div class="col-sm-4">
    <a class="btn btn-block btn-success btn-lg m-t-15 waves-effect" href="javascript:validacpf();"> PROSSEGUIR </a>
    <br>
  </div>
</div>
              
              
              

              <div style="display:none;" id="cadastro" class="body">
                  <div class="body">


<!--                     <form> -->
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                         <label for="nome_cad">Nome *</label>
                        <div class="form-group">
                          <div class="form-line">
                             <input required type="text" id="nome_cad" name="nome_cad" class="form-control" placeholder="Digite seu Nome">
                          </div>
                        </div>
                      </div>
                    </div>
                      
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="coordenadora_cad">É Coordenadora? *</label>
                        <div class="form-group form-float">
                          <div class="demo-radio-button">
                            
                            <input checked required  value="Coordenadora Regional" name="coordenadora_cad" type="radio" class="with-gap" id="coordenadora_cad1">
                            <label for="coordenadora_cad1">Coordenadora Regional</label>
                            
                            <input value="Coordenadora Estadual" name="coordenadora_cad" type="radio" id="coordenadora_cad2" class="with-gap">
                            <label for="coordenadora_cad2">Coordenadora Estadual</label> 
                            
                            <input value="Coordenadora de Cidade" name="coordenadora_cad" type="radio" id="coordenadora_cad3" class="with-gap">
                            <label for="coordenadora_cad3">Coordenadora de Cidade</label> 
                            
                            <input value="Coordenadora de parte da Cidade" name="coordenadora_cad" type="radio" id="coordenadora_cad4" class="with-gap">
                            <label for="coordenadora_cad4">Coordenadora de parte da Cidade</label> 
                            
                            <input value="Coordenadora de Igreja" name="coordenadora_cad" type="radio" id="coordenadora_cad5" class="with-gap">
                            <label for="coordenadora_cad5">Coordenadora de Igreja</label> 
                            
                            <input value="Debora" name="coordenadora_cad" type="radio" id="coordenadora_cad6" class="with-gap">
                            <label for="coordenadora_cad6">Débora</label> 
                            
                            
                            
<!--                             <input type="radio" name="coordenadora_cad" value="Coordenadora Regional"> Coordenadora Regional   -->
<!--                             <input type="radio" name="coordenadora_cad" value="Coordenadora Estadual"> Coordenadora Estadual -->
<!--                             <input type="radio" name="coordenadora_cad" value="Coordenadora de Cidade"> Coordenadora de Cidade -->
<!--                             <input type="radio" name="coordenadora_cad" value="Coordenadora de parte da Cidade"> Coordenadora de parte da Cidade -->
<!--                             <input type="radio" name="coordenadora_cad" value="Coordenadora de Igreja"> Coordenadora de Igreja -->
<!--                             <input type="radio" name="coordenadora_cad" value="Debora"> Débora -->
                            
                            
                            
                            
                            
                          </div>
                        </div>
                      </div>
                    </div>

                      <div class="row clearfix">
                        
                        <div class="col-sm-4">
                          <label for="cep_cad">CEP</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text"  name="cep_cad" id="cep_cad" class="form-control" placeholder="Digite seu CEP">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-8">
                          <label for="endereco_cad">Endereço</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input  type="text" id="endereco_cad" name="endereco_cad" class="form-control" placeholder="Digite seu Endereço">
                            </div>
                          </div>
                        </div>
                        
                      </div>


                      <div class="row clearfix">

                        <div class="col-sm-4">
                          <label for="bairro_cad">Bairro</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input   type="text" id="bairro_cad" name="bairro_cad" class="form-control" placeholder="Digite seu Bairro">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <label for="cidade_cad">Cidade*</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input  required  type="text" name="cidade_cad" id="cidade_cad" class="form-control" placeholder="Digite sua Cidade">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <label for="estado_cad">Estado*</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input   required type="text" name="estado_cad" id="estado_cad" class="form-control" placeholder="Digite seu Estado">
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="row clearfix">
                      <div class="col-sm-3">
                        <label for="telefone_cad">Telefone Celular*</label>
                        <div class="form-group">
                          <div class="form-line">                           
                            <input  required type="text" name="telefone_cad" id="telefone_cad" class="form-control" placeholder="(__) _____-____">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="email_cad">Email *</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" name="email_cad" id="email_cad" class="form-control" placeholder="Digite seu Email ">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <label for="dt_nasc_cad">Data de Nascimento </label>
                        <div class="form-group">
                          <div class="form-line">
                           <input    type="text" name="dt_nasc_cad" id="dt_nasc_cad" class="form-control" placeholder="__/__/____">
                          </div>
                        </div>
                      </div>
                    </div>

                      
                      <div class="row clearfix">
                      <div class="col-sm-6">
                        <label for="igreja_cad">Igreja *</label>
                        <div class="form-group ">
                          <div class="form-line">
                            <input  required type="text" name="igreja_cad" id="igreja_cad" class="form-control" placeholder="Digite sua Igreja">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="nome_pastor_cad">Nome do Pastor *</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input   type="text" name="nome_pastor_cad" id="nome_pastor_cad" class="form-control" placeholder="Digite o Nome do Pastor">
                          </div>
                        </div>
                      </div>
                    </div>
                      

                      <div class="row clearfix">
                      <div class="col-sm-6">
                        <label for="telefone_igreja_cad">Telefone da Igreja </label>
                        <div class="form-group ">
                          <div class="form-line">
                            <input type="text"  name="telefone_igreja_cad" id="telefone_igreja_cad" class="form-control" placeholder="(__) ____-____">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="email_igreja_cad">Email da Igreja </label>
                        <div class="form-group ">
                          <div class="form-line">
                           <input type="text" name="email_igreja_cad" id="email_igreja_cad" class="form-control" placeholder="Digite o Email da Igreja">
                          </div>
                        </div>
                      </div>
                    </div>
                                                               
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label><b>Contribui com o Projeto Sinfonia de Amor?</b> *</label>
                        <br> 
                        O "Projeto Sinfonia de Amor" é uma contribuição espontânea de foro individual de cada "Débora" que assume uma contribuição mensal como oferta ao ministério Desperta Débora. O valor e a forma de pagamento é estipulada pela própria "Débora". Qualquer interesse entre em contato com a Iara (19) 99718-4879.
                        <br><br>
                        <div class="form-group form-float">
                          <div class="demo-radio-button">
                            <input value="on" name="proj_sinfonia" type="radio" class="with-gap" id="contri_proj_sinf_1_cad">
                            <label for="contri_proj_sinf_1_cad">Sim</label>
                            <input value="off" name="proj_sinfonia" type="radio" id="contri_proj_sinf_2_cad" class="with-gap">
                            <label checked   for="contri_proj_sinf_2_cad">Não</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label><b>Você gostaria de "adotar" em oração um jovem da "Geração compromisso" ?</b> *</label>
                        <br>
                         
                            Desde a criação do ministério “Desperta Débora”,em 1995,  mulheres de todo o Brasil e vários outros países, se levantam todos os dias , 
                              durante 15 minutos, para interceder em favor da juventude brasileira. Um dos nossos principais motivos de oração é para que o Senhor 
                              levante jovens verdadeiramente comprometidos com Deus,
                              Sua Palavra e Sua obra e para que o Senhor fortaleça e abençoe essa “Geração Compromisso” a começar por seus filhos.
                         <br><br>
                        <div class="form-group form-float">
                          <div class="demo-radio-button">
                            <input value="on" name="projeto_geracao" type="radio" class="with-gap" id="projeto_geracao1">
                            <label for="projeto_geracao1">Sim</label>
                            <input value="off" name="projeto_geracao" type="radio" id="projeto_geracao2" class="with-gap">
                            <label checked   for="projeto_geracao2">Não</label>
                          </div>
                          <div>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="profissao_cad">Profissão</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" name="profissao_cad" id="profissao_cad" class="form-control" placeholder="Digite sua Profissão">
                          </div>
                        </div>
                      </div>
                    </div>
                    
     
                    <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="data_de_cadastro_cad">Data de Cadastro</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" name="data_de_cadastro_cad" 
                                   id="data_de_cadastro_cad" class="form-control" placeholder="<?=date("d-m-Y") ?>" disabled>
                          </div>
                        </div>
                      </div>
                    </div>                      
                    
                                    
<!--                     </form> -->


                    <button type="subset" class="btn btn-block btn-success btn-lg m-t-15 waves-effect">SALVAR MEUS DADOS</button>

                  </div>

                </form>

                
                <center>
          <div class="col-6">           
            <img src="images/dd.jpg"/>              
             
            <img src="images/mb.png"/>              
          </div> 
              </center>
              

              
              </div>
            </div>
          </div>
        </div>

        <!-- Nao retirar -->
        <div class="menu" style="display:none;">
          <ul class="list">
            <li class="active"></li>
          </ul>
        </div>

        <!-- footers -->
        <?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

        <!-- Place any per-page javascript here -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
        <?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

        <script type="text/javascript">
//           $('#dtinicio').bootstrapMaterialDatePicker({
//             format: 'DD/MM/YYYY',
//             time: false
//           });


//           $('#dtfim').bootstrapMaterialDatePicker({
//             format: 'DD/MM/YYYY',
//             time: false
//           });


//           $('#dt_nasc_cad').bootstrapMaterialDatePicker({
//             format: 'DD/MM/YYYY',
//             time: false
//           });


//           $('#data_de_cadastro_cad').bootstrapMaterialDatePicker({
//             format: 'DD/MM/YYYY',
//             time: false
//           });


          $('#dt_nasc_cad').inputmask('99/99/9999', {
            placeholder: '__/__/____'
          });          
          
          
          $('#telefone_cad').inputmask('(99) [9]9999-9999', {
            placeholder: '(__) _____-____'
          });


          $('#telefone_igreja_cad').inputmask('(99) 9999-9999', {
            placeholder: '(__) ____-____'
          });


          $('#cep_cad').inputmask('99999-999', {
            placeholder: '_____-___'
          });

          $('#cpf_cad').inputmask('999.999.999-99', {
            placeholder: '___.___.___-__'
          });

          

        </script>


        <!-- Adicionando JQuery -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <!-- Adicionando Javascript -->
        <script type="text/javascript">
          $(document).ready(function() {

            function limpa_formulário_cep() {
              // Limpa valores do formulário de cep.
              $("#endereco_cad").val("");
              $("#bairro_cad").val("");
              $("#cidade_cad").val("");
              $("#estado_cad").val("");
              //                 $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep_cad").blur(function() {

              //Nova variável "cep" somente com dígitos.
              var cep = $(this).val().replace(/\D/g, '');

              //Verifica se campo cep possui valor informado.
              if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                  //Preenche os campos com "..." enquanto consulta webservice.
                  $("#endereco_cad").val("...");
                  $("#bairro_cad").val("...");
                  $("#cidade_cad").val("...");
                  $("#estado_cad").val("...");
                  //                         $("#ibge").val("...");

                  //Consulta o webservice viacep.com.br/
                  $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                      //Atualiza os campos com os valores da consulta.
                      $("#endereco_cad").val(dados.logradouro);
                      $("#bairro_cad").val(dados.bairro);
                      $("#cidade_cad").val(dados.localidade);
                      $("#estado_cad").val(dados.uf);
                      //                                 $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                      //CEP pesquisado não foi encontrado.
                      limpa_formulário_cep();
                      alert("CEP não encontrado.");
                    }
                  });
                } //end if.
                else {
                  //cep é inválido.
                  limpa_formulário_cep();
                  alert("Formato de CEP inválido.");
                }
              } //end if.
              else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
              }
            });
          });
          
          
          
          
          /**
          
          */
          function validacpf(){
            

            
            if($('#cpf_cad').val() != ''){
             $.get("cadastro_debora_aberto.php?act=verificacpf&cpf="+$('#cpf_cad').val(), function(resultado){
//                   $("#mensagem").html(resultado);
               
//                alert(resultado);
               if(resultado > 0 ){
                  $('#cadastro').hide();
                  alert('CPF JÁ EXISTE! FALAR COM SUA REGIONAL.');
               }else{
                  $('#cadastro').show();
                 
               }
               
             })
            
            
            
          }else{
            alert('NECESSÁRIO DIGITAR UM CPF VÁLIDO.')
            
          }

          }
          
          
          
        </script>





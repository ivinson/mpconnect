<?php
  ob_start();
  header('X-Frame-Options: SAMEORIGIN');
  require_once 'init.php';
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
      padding: 13px 15px 12px 15px;
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
      padding: 13px 15px 12px 15px;
      white-space: nowrap;
      position: relative;
      border-bottom: 1px solid #e9e9e9;
      background: #3f51b5 !Important;
      background: indigo !Important;
      /* background: #88aa89 !Important; */
      height: 150px;
    }
  </style>

  <body class="theme-indigo">
    <section class="content" style="margin-left: 0px; margin-top: 0px;">
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

              <div class="header bg-deep-purple">
                <br>
                <br>
                <br>
                <h2>
                  CADASTRO NACIONAL
                  <small>Desperta Débora</small>
                </h2>
                <br>
                <br>
                <br>
              </div>

              <div class="body">
                <form>
                  <div class="body">


<!--                     <form> -->
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                         <label for="nome_cad">Nome *</label>
                        <div class="form-group">
                          <div class="form-line">
                             <input type="text" id="nome_cad" class="form-control" placeholder="Digite seu Nome">
                          </div>
                        </div>
                      </div>
                    </div>
                      
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="coordenadora_cad">É Coordenadora? *</label>
                        <div class="form-group">
                       
                          <div class="demo-radio-button ">

                            <input name="coordenadora" type="radio" class="with-gap" id="coordenadora_1_cad">
                            <label for="coordenadora_1_cad">Sim</label>

                            <input name="coordenadora" type="radio" id="coordenadora_2_cad" class="with-gap">
                            <label for="coordenadora_2_cad">Não</label>
                          </div>
                        </div>
                      </div>
                    </div>

                      <div class="row clearfix">
                        
                        <div class="col-sm-4">
                          <label for="cep_cad">CEP</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="cep_cad" class="form-control" placeholder="Digite seu CEP">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-8">
                          <label for="endereco_cad">Endereço</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="endereco_cad" class="form-control" placeholder="Digite seu Endereço">
                            </div>
                          </div>
                        </div>
                        
                      </div>


                      <div class="row clearfix">

                        <div class="col-sm-4">
                          <label for="bairro_cad">Bairro</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="bairro_cad" class="form-control" placeholder="Digite seu Bairro">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <label for="cidade_cad">Cidade</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="cidade_cad" class="form-control" placeholder="Digite sua Cidade">
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <label for="estado_cad">Estado</label>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" id="estado_cad" class="form-control" placeholder="Digite seu Estado">
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="row clearfix">
                      <div class="col-sm-3">
                        <label for="telefone_cad">Telefone Celular*</label>
                        <div class="form-group">
                          <div class="form-line">                           
                            <input type="text" id="telefone_cad" class="form-control" placeholder="(__) _____-____">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="email_cad">Email *</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" id="email_cad" class="form-control" placeholder="Digite seu Email ">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <label for="dt_nasc_cad">Data de Nascimento *</label>
                        <div class="form-group">
                          <div class="form-line">
                           <input type="text" id="dt_nasc_cad" class="form-control" placeholder="__/__/____">
                          </div>
                        </div>
                      </div>
                    </div>

                      
                      <div class="row clearfix">
                      <div class="col-sm-6">
                        <label for="igreja_cad">Igreja *</label>
                        <div class="form-group ">
                          <div class="form-line">
                            <input type="text" id="igreja_cad" class="form-control" placeholder="Digite sua Igreja">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="nome_pastor_cad">Nome do Pastor *</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" id="nome_pastor_cad" class="form-control" placeholder="Digite o Nome do Pastor">
                          </div>
                        </div>
                      </div>
                    </div>
                      

                      <div class="row clearfix">
                      <div class="col-sm-6">
                        <label for="telefone_igreja_cad">Telefone da Igreja *</label>
                        <div class="form-group ">
                          <div class="form-line">
                            <input type="text" id="telefone_igreja_cad" class="form-control" placeholder="(__) ____-____">
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <label for="email_igreja_cad">Email da Igreja *</label>
                        <div class="form-group ">
                          <div class="form-line">
                           <input type="text" id="email_igreja_cad" class="form-control" placeholder="Digite o Email da Igreja">
                          </div>
                        </div>
                      </div>
                    </div>
                      
                    
                    <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="data_de_cadastro_cad">Data de Cadastro</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" id="data_de_cadastro_cad" class="form-control" placeholder="25/09/2019" disabled>
                          </div>
                        </div>
                      </div>
                    </div>  
                      
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label>Contribui com o Projeto Sinfonia? *</label>
                        <div class="form-group form-float">
                          <div class="demo-radio-button">
                            <input name="proj_sinfonia" type="radio" class="with-gap" id="contri_proj_sinf_1_cad">
                            <label for="contri_proj_sinf_1_cad">Sim</label>
                            <input name="proj_sinfonia" type="radio" id="contri_proj_sinf_2_cad" class="with-gap">
                            <label for="contri_proj_sinf_2_cad">Não</label>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                      
                      <div class="row clearfix">
                      <div class="col-sm-12">
                        <label for="profissao_cad">Profissão</label>
                        <div class="form-group">
                          <div class="form-line">
                            <input type="text" id="profissao_cad" class="form-control" placeholder="Digite sua Profissão">
                          </div>
                        </div>
                      </div>
                    </div>
                                    
<!--                     </form> -->


                    <button type="button" class="btn btn-block btn-success btn-lg m-t-15 waves-effect">SALVAR MEUS DADOS</button>

                  </div>

                </form>
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
          $('#dtinicio').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            time: false
          });


          $('#dtfim').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            time: false
          });


          $('#dt_nasc_cad').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            time: false
          });


          $('#data_de_cadastro_cad').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            time: false
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

          


          //   =======================================================================================



          //     var fnumero_cad = $('#numero_cad').val();
          //     var fnome_cad = encodeURIComponent($('#nome_cad').val());
          //     var fcoordenadora_1_cad = encodeURIComponent($('#fcoordenadora_1_cad').val());
          //     var fcoordenadora_2_cad = encodeURIComponent($('#fcoordenadora_2_cad').val());
          //     var fendereco_cad = encodeURIComponent($('#fendereco_cad').val());
          //     var fbairro_cad = encodeURIComponent($('#fbairro_cad').val());
          //     var fcep_cad = $('#fcep_cad').val();
          //     var fcidade_cad = encodeURIComponent($('#fcidade_cad').val());
          //     var festado_cad = encodeURIComponent($('#festado_cad').val());
          //     var ftelefone_cad = encodeURIComponent($('#ftelefone_cad').val());
          //     var femail_cad = encodeURIComponent($('#femail_cad').val());
          //     var fdt_nasc_cad = encodeURIComponent($('#fdt_nasc_cad').val());
          //     var figreja_cad = encodeURIComponent($('#figreja_cad').val());
          //     var fnome_pastor_cad = encodeURIComponent($('#fnome_pastor_cad').val());
          //     var ftelefone_igreja_cad = encodeURIComponent($('#ftelefone_igreja_cad').val());
          //     var femail_igreja_cad = encodeURIComponent($('#femail_igreja_cad').val());
          //     var fdata_de_cadastro_cad = encodeURIComponent($('#fdata_de_cadastro_cad').val());
          //     var fcontri_proj_sinf_1_cad = encodeURIComponent($('#fcontri_proj_sinf_1_cad').val());
          //     var fcontri_proj_sinf_2_cad = encodeURIComponent($('#fcontri_proj_sinf_2_cad').val());
          //     var fprofissao_cad = encodeURIComponent($('#fprofissao_cad').val());

          //   =======================================================================================

          //     $.ajax({
          //       url: "",
          //       type: "POST",
          //       data:

          //         "customer_id=" + customer_id +
          //         "&inputnomecliente=" + inputnomecliente +
          //         "&ftelefone=" + ftelefone +


          //         "fnumero_cad=" + fnumero_cad +
          //         "&fnome_cad=" + fnome_cad +
          //         "&fcoordenadora_1_cad=" + fcoordenadora_1_cad +
          //         "&fcoordenadora_2_cad=" + fcoordenadora_2_cad +
          //         "&fendereco_cad=" + fendereco_cad +
          //         "&fbairro_cad=" + fbairro_cad +
          //         "&fcep_cad=" + fcep_cad +
          //         "&fcidade_cad=" + fcidade_cad +
          //         "&festado_cad=" + festado_cad +
          //         "&ftelefone_cad=" + ftelefone_cad +
          //         "&femail_cad=" + femail_cad +
          //         "&fdt_nasc_cad=" + fdt_nasc_cad +
          //         "&figreja_cad=" + figreja_cad +
          //         "&fnome_pastor_cad=" + fnome_pastor_cad +
          //         "&ftelefone_igreja_cad=" + ftelefone_igreja_cad +
          //         "&femail_igreja_cad=" + femail_igreja_cad +
          //         "&fdata_de_cadastro_cad=" + fdata_de_cadastro_cad +
          //         "&fcontri_proj_sinf_1_cad=" + fcontri_proj_sinf_1_cad +
          //         "&fcontri_proj_sinf_2_cad=" + fcontri_proj_sinf_2_cad +
          //         "&fprofissao_cad=" + fprofissao_cad




          //   =========================================================================   

          //       $.ajax({
          //         url: "",
          //         type: "POST",
          //         data: "id=" + item,
          //         dataType: "json"
          //       }).done(function(resposta) {
          //         //             console.log(resposta);
          //         for (var i = 0; i < resposta.length; i++) {


          //           $('#numero_cad').val($('<div />').html(resposta[i].numero).text());
          //           $('#nome_cad').val($('<div />').html(resposta[i].nome).text()));

          //         $('#fcoordenadora_1_cad').val($('<div />').html(resposta[i].coordenadora).text())); $('#fcoordenadora_2_cad').val($('<div />').html(resposta[i].coordenadora).text()));

          //       $('#fendereco_cad').val($('<div />').html(resposta[i].endereco).text())); $('#fbairro_cad').val($('<div />').html(resposta[i].bairro).text()));
          //     $('#fcep_cad').val($('<div />').html(resposta[i].cep).text());
          //     $('#fcidade_cad').val($('<div />').html(resposta[i].cidade).text()));
          //     $('#festado_cad').val($('<div />').html(resposta[i].estado).text()));
          //     $('#ftelefone_cad').val($('<div />').html(resposta[i].telefone).text()));
          //     $('#femail_cad').val($('<div />').html(resposta[i].email).text()));
          //     $('#fdt_nasc_cad').val($('<div />').html(resposta[i].dt_nascimento).text()));
          //     $('#figreja_cad').val($('<div />').html(resposta[i].igreja).text()));
          //     $('#fnome_pastor_cad').val($('<div />').html(resposta[i].nome_pastor).text()));
          //     $('#ftelefone_igreja_cad').val($('<div />').html(resposta[i].telefone_igreja).text()));
          //     $('#femail_igreja_cad').val($('<div />').html(resposta[i].email_igreja).text()));
          //     $('#fdata_de_cadastro_cad').val($('<div />').html(resposta[i].dt_cadastro).text()));

          //     $('#fcontri_proj_sinf_1_cad').val($('<div />').html(resposta[i].contr_proj_sinfonia).text()));
          //     $('#fcontri_proj_sinf_2_cad').val($('<div />').html(resposta[i].contr_proj_sinfonia).text()));

          //     $('#fprofissao_cad').val($('<div />').html(resposta[i].profissao).text()));





          // // =====================  nome no programa =====================================  
          //   numero_cad
          //   nome_cad
          //   coordenadora_1_cad
          //   coordenadora_2_cad
          //   endereco_cad
          //   bairro_cad
          //   cep_cad
          //   cidade_cad
          //   estado_cad
          //   telefone_cad
          //   email_cad
          //   dt_nasc_cad
          //   igreja_cad
          //   nome_pastor_cad
          //   telefone_igreja_cad
          //   email_igreja_cad
          //   data_de_cadastro_cad
          //   contri_proj_sinf_1_cad
          //   contri_proj_sinf_2_cad
          //   profissao_cad



          // // =====================  nome no banco de dados (debora) =====================================
          // id 
          // numero
          // nome 
          // coordenadora 
          // endereco
          // bairro 
          // cep 
          // cidade
          // estado 
          // telefone 
          // email 
          // dt_nascimento 
          // igreja 
          // nome_pastor 
          // telefone_igreja 
          // email_igreja 
          // dt_cadastro
          // contr_proj_sinfonia 
          // profissao
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
        </script>





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
    
    
    <!--     Data Tables    -->  

    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
 
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    
    
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
                   
                    
                                       
                    
                    
<!--                     ============================================================== -->
                    
                    
                    
                    
                    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                      
                      
<!--                         <div class="header">
                            <h2>
                                BASIC EXAMPLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> -->
                      
                      
                      
                        <div class="body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                  <div class="row">
<!--                                     <div class="col-sm-6">
                                      <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>Show 
                                          <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                          </select> entries</label>
                                      </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                      <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>Search:<input type="search" id="myInput" class="form-control" placeholder="" aria-controls="DataTables_Table_0"></label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 176px;">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 285px;">Position</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 129px;">Office</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 62px;">Age</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 121px;">Start date</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 100px;">Salary</th></tr>
                                    </thead>
                                        
<!--                                     <tfoot>
                                        <tr><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Position</th><th rowspan="1" colspan="1">Office</th><th rowspan="1" colspan="1">Age</th><th rowspan="1" colspan="1">Start date</th><th rowspan="1" colspan="1">Salary</th></tr>
                                    </tfoot> -->
                                        
                                        
                                    <tbody id="myTable">
                                        
          
                                        
                                        
                                    <tr role="row" class="odd">
                                            <td class="sorting_1">Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                        </tr><tr role="row" class="even">
                                            <td class="sorting_1">Angelica Ramos</td>
                                            <td>Chief Executive Officer (CEO)</td>
                                            <td>London</td>
                                            <td>47</td>
                                            <td>2009/10/09</td>
                                            <td>$1,200,000</td>
                                        </tr><tr role="row" class="odd">
                                            <td class="sorting_1">Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr><tr role="row" class="even">
                                            <td class="sorting_1">Bradley Greer</td>
                                            <td>Software Engineer</td>
                                            <td>London</td>
                                            <td>41</td>
                                            <td>2012/10/13</td>
                                            <td>$132,000</td>
                                        </tr><tr role="row" class="odd">
                                            <td class="sorting_1">Brenden Wagner</td>
                                            <td>Software Engineer</td>
                                            <td>San Francisco</td>
                                            <td>28</td>
                                            <td>2011/06/07</td>
                                            <td>$206,850</td>
                                        </tr><tr role="row" class="even">
                                            <td class="sorting_1">Brielle Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2012/12/02</td>
                                            <td>$372,000</td>
                                        </tr><tr role="row" class="odd">
                                            <td class="sorting_1">Bruno Nash</td>
                                            <td>Software Engineer</td>
                                            <td>London</td>
                                            <td>38</td>
                                            <td>2011/05/03</td>
                                            <td>$163,500</td>
                                        </tr><tr role="row" class="even">
                                            <td class="sorting_1">Caesar Vance</td>
                                            <td>Pre-Sales Support</td>
                                            <td>New York</td>
                                            <td>21</td>
                                            <td>2011/12/12</td>
                                            <td>$106,450</td>
                                        </tr><tr role="row" class="odd">
                                            <td class="sorting_1">Cara Stevens</td>
                                            <td>Sales Assistant</td>
                                            <td>New York</td>
                                            <td>46</td>
                                            <td>2011/12/06</td>
                                            <td>$145,600</td>
                                        </tr><tr role="row" class="even">
                                            <td class="sorting_1">Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr></tbody>
                                </table></div></div>
                                  
                                  
<!--                                   <div class="row">
                                    <div class="col-sm-5">
                                      <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div>
                                  </div> -->
                                  
                                  
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    
                    

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
        
        
         
<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  

  
</script>





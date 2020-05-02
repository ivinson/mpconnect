

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

    
    <!-- Favicon-->
<!--     <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="manifest" href="/manifest.json"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="/mpconnect/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <!-- Waves Effect Css -->
    <link href="/mpconnect/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/mpconnect/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/mpconnect/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="/mpconnect/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="/mpconnect/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="/mpconnect/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/mpconnect/css/style.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="http://app.mpc.org.br/users/css/custom.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/mpconnect/css/themes/all-themes.css" rel="stylesheet" />

    
    
    
   <title>Teste - Tela Débora - MPC </title>

      </head>
  
  
  <style>
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
  </style>


<style>
    /* .theme-blue-grey .navbar {
        background-color: #577b59 !Important;
    } */

    .sidebar .user-info {
        padding: 13px 15px 12px 15px;
        white-space: nowrap;
        position: relative;
        border-bottom: 1px solid #e9e9e9;
        background: #3f51b5  !Important;
        background: indigo  !Important;
        /* background: #88aa89 !Important; */
        height: 150px;
    }
</style>

<!-- <body class="theme-blue-grey"> -->

  
  

 <body class="theme-indigo">     
    
   
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info --> 
            
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        
                    </li>                   
                </ul>
        </div>
           
        </aside>
        <!-- #END# Left Sidebar -->

    </section>
    
    

  
   <div class="container-fluid"> 
  
  
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="card">
      <div class="header bg-deep-purple">
        <h2>
          CADASTRO NACIONAL
          <small>Desperta Débora</small>
        </h2>

      </div>
      <div class="body">
        <form>
          <div class="body">

            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="numero_cad" class="form-control">
                    <label class="form-label font-italic col-black">Número</label>
                  </div>
                </div>
              </div>
            </div>


            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="nome_cad" class="form-control">
                    <label class="form-label font-italic col-black">Nome *</label>
                  </div>
                </div>
              </div>
            </div>



            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-float">
                  <p class="font-italic col-black">É Coordenadora? *</p>
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
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="cep_cad" class="form-control">
                    <label class="form-label font-italic col-black">CEP</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-8">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="endereco_cad" class="form-control">
                    <label class="form-label font-italic col-black">Endereço</label>
                  </div>
                </div>
              </div>

            </div>


            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="bairro_cad" class="form-control">
                    <label class="form-label font-italic col-black">Bairro</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="cidade_cad" class="form-control">
                    <label class="form-label font-italic col-black">Cidade *</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="estado_cad" class="form-control">
                    <label class="form-label font-italic col-black">Estado *</label>
                  </div>
                </div>
              </div>

            </div>



            <div class="row clearfix">

              <div class="col-sm-3">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="telefone_cad" class="form-control">
                    <label class="form-label font-italic col-black">Telefone Celular *</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="email_cad" class="form-control">
                    <label class="form-label font-italic col-black">Email</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="dt_nasc_cad3" class="form-control">
                    <label class="form-label font-italic col-black">Data de Nascimento</label>
                  </div>
                </div>
              </div>
            </div>



            <div class="row clearfix">
              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="igreja_cad" class="form-control">
                    <label class="form-label font-italic col-black">Igreja *</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="nome_pastor_cad" class="form-control">
                    <label class="form-label font-italic col-black">Nome do Pastor *</label>
                  </div>
                </div>
              </div>

            </div>



            <div class="row clearfix">
              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="telefone_igreja_cad" class="form-control">
                    <label class="form-label font-italic col-black">Telefone da Igreja</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="email_igreja_cad" class="form-control">
                    <label class="form-label font-italic col-black">Email da Igreja</label>
                  </div>
                </div>
              </div>
            </div>


            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="data_de_cadastro_cad3" class="form-control">
                    <label class="form-label font-italic col-black">Data de Cadastro</label>
                  </div>
                </div>
              </div>
            </div>


            <!--                                 <div class="row clearfix">
                                    <div class="col-sm-12">
                                      <div class="form-group form-float">
                                          <div class="form-line">

                                          <p class="font-italic col-black">Contribui com o Projeto Sinfonia?*</p>                                   
                                          <select  class='form-control show-tick' id="contribui_proj_sinf_cad" name="contribui_proj_sinf_cad">
                                            <option value=""> Escolha uma opção </option>
                                            <option value="s"> Sim </option>
                                            <option value="n"> Não </option>
                                          </select>  
                                      </div>
                                    </div>
                                  </div>
                                </div> -->

            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-float">
                  <p class="font-italic col-black">Contribui com o Projeto Sinfonia? *</p>
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
                <div class="form-group form-float">
                  <div class="form-line">
                    <input type="text" id="profissao_cad" class="form-control">
                    <label class="form-label font-italic col-black">Profissão</label>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" class="btn btn-block btn-success btn-lg m-t-15 waves-effect">Gravar</button>

            
          </div>

        </form>
      </div>
    </div>
    
  </div>
     
  </div>
  
  
  

    
    
    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    
    
    <script>
    
      
    $('#dtinicio').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      time: false
    });
    
    
    $('#dtfim').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      time: false
    });


    $('#dt_nasc_cad3').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      time: false
    });
    
    
    $('#data_de_cadastro_cad3').bootstrapMaterialDatePicker({
      format: 'DD/MM/YYYY',
      time: false
    });


    $('#telefone_cad').inputmask('(99) [9]9999-9999', {
      placeholder: '(__) _____-____'
    });
    
    
    $('#telefone_igreja_cad').inputmask('(99) 9999-9999', {
      placeholder: '(__) ____-____'
    });


    $('#cep_cad').inputmask('99999-9999', {
      placeholder: '_____-___'
    });

    
    </script>
    
    
    
    <!-- Jquery Core Js -->
    <script src="/mpconnect/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="/mpconnect/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="/mpconnect/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="/mpconnect/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="/mpconnect/plugins/node-waves/waves.js"></script>

   
    <!-- Autosize Plugin Js -->
    <script src="/mpconnect/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="/mpconnect/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="/mpconnect/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="/mpconnect/js/admin.js"></script>

    <script src="/mpconnect/js/pages/forms/basic-form-elements.js"/></script> 
    
    <!-- Input Mask Plugin Js -->
    <script src="/mpconnect/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>    

     <!-- <script src="<?=$us_url_root?>js/pages/index.js"/></script>  -->

    <!-- Demo Js -->
    <script src="/mpconnect/js/demo.js"></script>
    
    
    
    
    
    
    
    
  </body>
</html>



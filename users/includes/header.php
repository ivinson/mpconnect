<?php
ob_start();
header('X-Frame-Options: SAMEORIGIN');
?>
<?php require_once $abs_us_root . $us_url_root . 'users/helpers/helpers.php'; ?>
<?php require_once $abs_us_root . $us_url_root . 'users/includes/user_spice_ver.php'; ?>


<?php
 //check for a custom page
$currentPage = currentPage();
if (isset($_GET['err'])) {
    $err = Input::get('err');
}

if (isset($_GET['msg'])) {
    $msg = Input::get('msg');
}

if (file_exists($abs_us_root . $us_url_root . 'usersc/' . $currentPage)) {
    if (currentFolder() != 'usersc') {
        $url = $us_url_root . 'usersc/' . $currentPage;
        if (isset($_GET)) {
            $url .= '?'; //add initial ?
            foreach ($_GET as $key => $value) {
                $url .= '&' . $key . '=' . $value;
            }
        }
        Redirect::to($url);
    }
}

$db = DB::getInstance();
$settingsQ = $db->query("Select * FROM settings");
$settings = $settingsQ->first();

//dealing with logged in users
if ($user->isLoggedIn() && !checkMenu(2, $user->data()->id)) {
    if (($settings->site_offline == 1) && (!in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')) {
        //:: force logout then redirect to maint.page
        $user->logout();
        Redirect::to($us_url_root . 'users/maintenance.php');
    }
}

//deal with guests
if (!$user->isLoggedIn()) {
    if (($settings->site_offline == 1) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')) {
        //:: redirect to maint.page
        Redirect::to($us_url_root . 'users/maintenance.php');
    }
}

//notifiy master_account that the site is offline
if ($user->isLoggedIn()) {
    if (($settings->site_offline == 1) && (in_array($user->data()->id, $master_account)) && ($currentPage != 'login.php') && ($currentPage != 'maintenance.php')) {
        err("<br>Maintenance Mode Active");
    }
}

if ($settings->glogin == 1 && !$user->isLoggedIn()) {
    require_once $abs_us_root . $us_url_root . 'users/includes/google_oauth.php';
}

if ($settings->force_ssl == 1) {

    if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
        // if request is not secure, redirect to secure url
        $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        Redirect::to($url);
        exit;
    }
}

//if track_guest enabled AND there is a user logged in
if ($settings->track_guest == 1 && $user->isLoggedIn()) {
    if ($user->isLoggedIn()) {
        $user_id = $user->data()->id;
    } else {
        $user_id = 0;
    }
    new_user_online($user_id);
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!--     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
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
<!--     <link href="<?= $us_url_root ?>plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" /> -->

    <!-- Custom Css -->
    <link href="<?= $us_url_root ?>css/style.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="https://app.mpc.org.br/users/css/custom.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= $us_url_root ?>css/themes/all-themes.css" rel="stylesheet" />


</head>

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
<body class="theme-indigo" >




    <!-- Page Loader -->
    <!--     <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar" style="background: indigo !important;">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a> -->
                <a href="javascript:void(0);" class="bars" style="font-size:48px !important;"></a>
                <a class="navbar-brand" href="index.php">
                    <img style="padding-left: 20px;"   class="img-responsive" src="<?= $us_url_root ?>users/images/logo.png" alt="SISTEMA INTERNO DA MPC BRASIL" />

                    SISTEMA INTERNO DA MPC BRASIL</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">

            </div>
        </div>
    </nav>
    <!-- #Top Bar -->



    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->

            <?php 

            $raw = date_parse($user->data()->nampcdesde);
            $signupdate = $raw['month'] . "/" . $raw['year'];
            //$signupdate = $raw['month']."/".$raw['year'];

            ?>

            <div class="user-info">
                <div class="image">
                    <!--                     <img src="images/user.png" width="48" height="48" alt="User" /> -->
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?= ucfirst($user->data()->username) ?></div>
                    <div class="email">Veterano desde : <?= $signupdate ?></div>
                    <div class="btn-group-vertical btn user-helper-dropdown">
                        <a style="color: white !important;" href="<?= $us_url_root ?>users/logout.php"><i class="material-icons">exit_to_app</i>SAIR</a></li>

                    </div>

                    <!--                     <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div> -->
                </div>
                <br><br><br><br>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">


            <?
                if( checkMenu(3, $user->data()->id)){
                  
                  ?>
                  
                                    
                      <li>
                        <a href="<?= $us_url_root ?>users/listagem_deboras.php">
                            <i class="material-icons">map</i>
                            <span>Desperta Déboras</span>
                        </a>
                    </li>       
                  
                  
                  <?
                  
                } 

             ?>                  
                  
                  
                  
                    <li class="active">
                        <a href="<?= $us_url_root ?>users/account.php">
                            <i class="material-icons">timeline</i>
                            <span>Atividades da Minha Cidade</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $us_url_root ?>users/view_all_users.php">
                            <i class="material-icons">face</i>
                            <span>Contatos</span>
                        </a>
                    </li>
                  <li>
                      <a href="<?= $us_url_root ?>users/cidades_all.php">
                            <i class="material-icons">location_city</i>
                            <span>Cidades</span>
                        </a>
                  </li>
                  
                  <li>
                      <a href="<?= $us_url_root ?>users/atividades_semana.php">
                            <i class="material-icons">notifications</i>
                            <span>Atividades da Semana</span>
                        </a>
                  </li>



                    <li >
                        <a href="<?= $us_url_root ?>users/agendamento.php">
                            <i class="material-icons">schedule</i>
                            <span>Agendamentos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= $us_url_root ?>users/feedback_atividades_ministeriais.php">
                            <i class="material-icons">assignment_turned_in</i>
                            <span>Feedback Atividades</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= $us_url_root ?>users/relatorios_cidade.php">
                            <i class="material-icons">assignment_turned_in</i>
                            <span>Meus Relatórios </span>
                        </a>
                    </li>
                    
               <!-- Hamburger menu link -->
               <?php if (( $user->data()->idtipo == '4')  or  ( $user->data()->idtipo == '13')) {  // ?>                    
                    <li>
                        <a href="<?= $us_url_root ?>users/relatorios_regionais.php">
                            <i class="material-icons">list</i>
                            <span>Relatórios Regionais</span>
                        </a>
                    </li>
                    <?php } ?> 


                    
                    <li>
                        <a href="<?= $us_url_root ?>users/user_settings.php">
                            <i class="material-icons">account_circle</i>
                            <span>Meu Cadastro</span>
                        </a>
                    </li>



                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">cloud_download</i>
                            <span>Banco de Recursos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href=href="<?= $us_url_root ?>users/pi_ministerios.php">
                                    <span>Ministérios</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Novas Cidades</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Administrativo&Apoio</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Liderança de Equipe</span>
                                </a>

                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Comunicação</span>
                                </a>

                            </li>
                        </ul>
                    </li> -->

                    <!-- http://app.mpc.org.br/users/relatorios_regionais.php
                     -->


                    <?php if ($user->isLoggedIn()) { ?>




                    <!-- Hamburger menu link -->
                    <?php if (checkMenu(2, $user->data()->id)) {  //


                        // is user an admin 
                        ?>

                    <li class="header">ADMIN</li>
                  
                      <li>
                        <a href="<?= $us_url_root ?>users/listar_cidades.php">
                            <i class="material-icons">map</i>
                            <span>Cidades</span>
                        </a>
                    </li>                
                                                                   
                  
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>Cadastros</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?= $us_url_root ?>tipousuario/index.php">
                                    <span>Tipos de Usuario</span>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li>
                        <a href="<?= $us_url_root ?>users/admin.php">
                            <i class="material-icons">account_circle</i>
                            <span>Admin DashBoard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= $us_url_root ?>users/messages.php">
                            <i class="material-icons">mail </i>
                            <span>Mensagens</span>
                            <?php if ($settings->messaging == 1) { ?>
                            <span class="badge"> <?= $msgC ?></span>
                            <?php 
                        } ?>


                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?= $us_url_root ?>users/view_all_users.php">
                            <i class="material-icons">face</i>
                            <span>Contatos</span>
                        </a>
                    </li> -->

                    </li>



                    <?php 
                }
            }
            ?>









                    <li class="divider"></li>
                    <li class="header"><a href="<?= $us_url_root ?>users/logout.php"><i class="fa fa-fw fa-sign-out"></i> Sair</a></li> <!-- regular Logout menu link -->
                    <!-- close tag for User dropdown menu -->
                    <!-- <li class="hidden-sm hidden-md hidden-lg"><a href="<?= $us_url_root ?>users/logout.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a></li> regular Hamburger logout menu link -->

                </ul>












            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!--             <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">MPC BRASIL - ivicomm.net </a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.2
                </div>
            </div> -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
        <div class="container-fluid"> 
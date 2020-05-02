<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
if(isset($_SESSION)){session_destroy();}
?>
<?php require_once 'init.php'; ?>
<?php //require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/helpers/helpers.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/user_spice_ver.php'; ?>

<?php //require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php


$db = DB::getInstance();
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
$error_message = '';
if (@$_REQUEST['err']) $error_message = $_REQUEST['err']; // allow redirects to display a message
$reCaptchaValid=FALSE;
 
if (Input::exists()) {
    $token = Input::get('csrf');
    if(!Token::check($token)){
        die('Token doesn\'t match!');
    }
    //Check to see if recaptcha is enabled
    if($settings->recaptcha == 1){
        require_once 'includes/recaptcha.config.php';
 
        //reCAPTCHA 2.0 check
        $response = null;
 
        // check secret key
        $reCaptcha = new ReCaptcha($privatekey);
 
        // if submitted check response
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
        }
        if ($response != null && $response->success) {
            $reCaptchaValid=TRUE;
 
        }else{
            $reCaptchaValid=FALSE;
            $error_message .= 'Please check the reCaptcha.';
        }
    }else{
        $reCaptchaValid=TRUE;
    }
 
    if($reCaptchaValid || $settings->recaptcha == 0){ //if recaptcha valid or recaptcha disabled
 
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('display' => 'Username','required' => true),
            'password' => array('display' => 'Password', 'required' => true)));
 
        if ($validation->passed()) {
            //Log user in
 
            $remember = (Input::get('remember') === 'on') ? true : false;
            $user = new User();
            $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
            if ($login) {
                # if user was attempting to get to a page before login, go there
                $dest = sanitizedDest('dest');
                if (!empty($dest)) {
                    Redirect::to($dest);
                } elseif (file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')) {
                   
                    # if site has custom login script, use it
                    # Note that the custom_login_script.php normally contains a Redirect::to() call
                    require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
                } else {
                    if (($dest = Config::get('homepage')) ||
                            ($dest = 'account.php')) {
                        #echo "DEBUG: dest=$dest<br />\n";
                        #die;
                        Redirect::to($dest);
                    }
                }
            } else {
                $error_message .= 'Log in failed. Please check your username and password and try again.';
            }
        } else{
            $error_message .= '<ul>';
            foreach ($validation->errors() as $error) {
                $error_message .= '<li>' . $error . '</li>';
            }
            $error_message .= '</ul>';
        }
    }
}
if (empty($dest = sanitizedDest('dest'))) {
  $dest = '';
}
 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
  <link rel="manifest" href="<?=$us_url_root?>manifest.json">
    <!-- Favicon-->
    <link rel="icon" href="<?=$us_url_root?>/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=$us_url_root?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=$us_url_root?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=$us_url_root?>plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=$us_url_root?>css/style.css" rel="stylesheet">


<style>

.body {
    background-color: #4b0082 !important;
}

.text-color-white {
    color: #fff !important;
}

</style>


</head>






<body class="login-page">

<br>
<br>
<br>
<br>
    <div class="login-box">
<!-- <body class="login-page">
    <div class="login-box"> -->
        <div class="logo">
            <center><img src="<?=$us_url_root?>users/images/logo.png"> </center><br>
            <p><small>MPC Brasil - 65 Anos  </small> </p>
        </div>
        <div style="padding: 20px !important;">
        <!-- <div class="card"> -->










            <div class="body">
                <form id="sign_in" method="POST" action="login.php">
                    <div class="msg text-color-white">
                        <!-- Sign in to start your session -->
                    </div>
                    <div class="input-group ">
                        <span class="input-group-addon">
                            <i class="material-icons text-color-white">person</i>
                        </span>
                        <div class="form-line">
                            <input  class="form-control" type="text" 
                            name="username" id="username" placeholder="Username/Email" required autofocus>

                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons text-color-white">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control"  name="password" id="password"  placeholder="Password" required autocomplete="off">
                        </div>
                        <div>
                            <?php
                            if($settings->recaptcha == 1){
                            ?>
                            <div class="form-group">
                            <label>Please check the box below to continue</label>
                            <div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
                            </div>
                            <?php } ?>
                                                      

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember" class="filled-in ">

                            <label  class="text-color-white" for="remember">Lembrar senha </label>
                        </div>
                        <div class="col-xs-4">
                            <input type="hidden" name="csrf" value="<?=Token::generate(); ?>">
                            <button class="btn btn-block bg-indigo waves-effect" type="submit">ENTRAR</button>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 "> <center>
                            <br>
                            <a  class="text-color-white " style="font-size: 20px;" href="join.php">Quero me cadastrar</a>
                            </center>
                        </div>
<!--                         <div class="col-xs-6 align-right">
                            <a href="forgot_password.php">Já esqueci minha senha</a>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?=$us_url_root?>/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=$us_url_root?>/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=$us_url_root?>/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=$us_url_root?>/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?=$us_url_root?>/js/admin.js"></script>
    <script src="<?=$us_url_root?>/js/pages/examples/sign-in.js"></script>
</body>

</html>
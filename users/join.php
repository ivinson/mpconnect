<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
ini_set("allow_url_fopen", 1);
?>
<?php require_once 'init.php'; ?>
<?php //require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php //require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/helpers/helpers.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/user_spice_ver.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php


$db = DB::getInstance();
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();
if($settings->recaptcha == 1 || $settings->recaptcha == 2){
	require_once("includes/recaptcha.config.php");
}
//There is a lot of commented out code for a future release of sign ups with payments
$form_method = 'POST';
$form_action = 'join.php';
$vericode = rand(100000,999999);

$form_valid=FALSE;

//Decide whether or not to use email activation
$query = $db->query("SELECT * FROM email");
$results = $query->first();
$act = $results->email_act;

//Opposite Day for Pre-Activation - Basically if you say in email
//settings that you do NOT want email activation, this lists new
//users as active in the database, otherwise they will become
//active after verifying their email.
if($act==1){
	$pre = 0;
} else {
	$pre = 1;
}

$token = Input::get('csrf');
if(Input::exists()){
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
}

$reCaptchaValid=FALSE;

if(Input::exists()){

	$username = Input::get('username');
	$fname = Input::get('fname');
	$lname = Input::get('lname');
	$email = Input::get('email');
	$agreement_checkbox = Input::get('agreement_checkbox');

	if ($agreement_checkbox=='on'){
		$agreement_checkbox=TRUE;
	}else{
		$agreement_checkbox=FALSE;
	}

	$db = DB::getInstance();
	$settingsQ = $db->query("SELECT * FROM settings");
	$settings = $settingsQ->first();
	$validation = new Validate();
	$validation->check($_POST,array(
	  'username' => array(
		'display' => 'Username',
		'required' => true,
		'min' => $settings->min_un,
		'max' => $settings->max_un,
		'unique' => 'users',
	  ),
	  'fname' => array(
		'display' => 'First Name',
		'required' => true,
		'min' => 2,
		'max' => 35,
	  ),
	  'lname' => array(
		'display' => 'Last Name',
		'required' => true,
		'min' => 2,
		'max' => 35,
	  ),
	  'email' => array(
		'display' => 'Email',
		'required' => true,
		'valid_email' => true,
		'unique' => 'users',
	  ),

	  'password' => array(
		'display' => 'Password',
		'required' => true,
		'min' => $settings->min_pw,
		'max' => $settings->max_pw,
	  ),
	  'confirm' => array(
		'display' => 'Confirm Password',
		'required' => true,
		'matches' => 'password',
	  ),
	));

	//if the agreement_checkbox is not checked, add error
	if (!$agreement_checkbox){
		$validation->addError(["Por favor, você só pode se registrar depois de ler os termos de uso"]);
	}

	if($validation->passed() && $agreement_checkbox){
		//Logic if ReCAPTCHA is turned ON
	if($settings->recaptcha == 1 || $settings->recaptcha == 2){
			require_once("includes/recaptcha.config.php");
			//reCAPTCHA 2.0 check
			$response = null;

			// check secret key
			$reCaptcha = new ReCaptcha($privatekey);

			// if submitted check response
			if ($_POST["g-recaptcha-response"]) {
				$response = $reCaptcha->verifyResponse(
					$_SERVER["REMOTE_ADDR"],
					$_POST["g-recaptcha-response"]);
			}
			if ($response != null && $response->success) {
				// account creation code goes here
				$reCaptchaValid=TRUE;
				$form_valid=TRUE;
			}else{
				$reCaptchaValid=FALSE;
				$form_valid=FALSE;
				$validation->addError(["Please check the reCaptcha box."]);
			}

		} //else for recaptcha

		if($reCaptchaValid || $settings->recaptcha == 0){

			//add user to the database
			$user = new User();
			$join_date = date("Y-m-d H:i:s");
			$params = array(
				'fname' => Input::get('fname'),
				'email' => $email,
				'vericode' => $vericode,
			);

			if($act == 1) {
				//Verify email address settings
				$to = rawurlencode($email);
				$subject = 'Welcome to '.$settings->site_name;
				$body = email_body('_email_template_verify.php',$params);
				email($to,$subject,$body);
			}
			try {
				// echo "Trying to create user";
				$user->create(array(
					'username' => Input::get('username'),
					'fname' => Input::get('fname'),
					'lname' => Input::get('lname'),
					'email' => Input::get('email'),
					'password' =>
					password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
					'permissions' => 1,
					'account_owner' => 1,
					'stripe_cust_id' => '',
					'join_date' => $join_date,
					'company' => Input::get('company'),
					'email_verified' => $pre,
					'active' => 1,
					'vericode' => $vericode,
				));
			} catch (Exception $e) {
				die($e->getMessage());
			}
			Redirect::to($us_url_root.'users/joinThankYou.php');
		}

	} //Validation and agreement checbox
} //Input exists

?>
<?php header('X-Frame-Options: DENY'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title></title>
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
    <!-- Jquery Core Js -->
    <script src="<?=$us_url_root?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=$us_url_root?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=$us_url_root?>plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=$us_url_root?>plugins/jquery-validation/jquery.validate.js"></script>

    <script src="<?=$us_url_root?>js/pages/examples/sign-up.js"></script>

</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <center><img src="<?=$us_url_root?>users/images/logo.png"> </center><br>
            <p><small>MPC Brasil - 65 Anos  </small> </p>
        </div>
        <div class="card">
        	<div class="body">
				<?php
				if($settings->glogin==1 && !$user->isLoggedIn()){
				require_once $abs_us_root.$us_url_root.'users/includes/google_oauth_login.php';
				}
				if($settings->fblogin==1 && !$user->isLoggedIn()){
				require_once $abs_us_root.$us_url_root.'users/includes/facebook_oauth.php';
				}
				require 'views/_join.php';
				?>
			</div>
		</div>
	</div>


    <!-- Custom Js -->
    <script src="<?=$us_url_root?>js/admin.js"></script>
    <script src="<?=$us_url_root?>js/pages/examples/sign-in.js"></script>
</body>

</html>



<?php if($settings->recaptcha == 1 || $settings->recaptcha == 2){ ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php } ?>


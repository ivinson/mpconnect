<?php
	require_once 'users/init.php';
	if (!securePage($_SERVER['PHP_SELF'])){die();}
	
	if($user->isLoggedIn()) {

		Redirect::to($us_url_root."users/account.php");
	} else {
			Redirect::to($us_url_root."users/login.php");
	};
?>

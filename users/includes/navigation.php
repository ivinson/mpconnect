<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

Feb 02 2016 - Ported US3.2.1 top-nav

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

if(!isset($db)){
	$db = DB::getInstance();
}


// Signup
$lang = array_merge($lang,array(
	"SIGNUP_TEXT"			=> "Registrar",
	"SIGNUP_BUTTONTEXT"		=> "Registre-me",
	"SIGNUP_AUDITTEXT"		=> "Registrado",
	));

// Signin
$lang = array_merge($lang,array(
	"SIGNIN_FAIL"			=> "** LOGIN Falhou!**",
	"SIGNIN_TITLE"			=> "Por favor, faça seu login",
	"SIGNIN_TEXT"			=> "Logar",
	"SIGNOUT_TEXT"			=> "Sair",
	"SIGNIN_BUTTONTEXT"		=> "Login",
	"SIGNIN_AUDITTEXT"		=> "Logado em",
	"SIGNOUT_AUDITTEXT"		=> "Deslogado em",
	));

//Navigation
$lang = array_merge($lang,array(
	"NAVTOP_HELPTEXT"		=> "Ajuda",
	));

$query = $db->query("SELECT * FROM email");
$results = $query->first();

//Value of email_act used to determine whether to display the Resend Verification link
$email_act=$results->email_act;

?>


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

Special thanks to John Bovey for the password strenth feature.
*/
?>

<?php
if (!$form_valid && Input::exists()){
	echo display_errors($validation->errors());
}
?>

<form class="form-signup" action="<?=$form_action;?>" method="<?=$form_method;?>" id="payment-form">

	<!-- <h2 class="form-signin-heading"> <?=lang("SIGNUP_TEXT","");?></h2> -->
    <div class="msg"><h3>Registro de Colaboradores</h3></div>

	<div class="form-group-1">

<label for="username">Digite um usuario* (entre <?=$settings->min_un?> e <?=$settings->max_un?> letras)</label>
    	
		<input  class="form-control" type="text" name="username" id="username" placeholder="nome de usuario*" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" required autofocus>

</div>






		<label for="fname">Primeiro Nome*</label>
		<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required>
			




		<label for="lname">Ultimo Nome*</label>
		<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required>



		<label for="email">Email*</label>
		<input  class="form-control" type="text" name="email" id="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required >




<?php

		$character_range = 'Entre '.$settings->min_pw . ' e ' . $settings->max_pw;
		$character_statement = '<span id="character_range" class="gray_out_text">' . $character_range . ' dgitos</span>';

if ($settings->req_cap == 1){
		$num_caps = '1'; //Password must have at least 1 capital
		if($num_caps != 1){
			$num_caps_s = 's';
		}
		$num_caps_statement = '<span id="caps" class="gray_out_text">Ter pelo menos ' . $num_caps . ' um letra MAIUSCULA </span>';
}

if ($settings->req_num == 1){
		$num_numbers = '1'; //Password must have at least 1 number
		if($num_numbers != 1){
			$num_numbers_s = 's';
		}

		$num_numbers_statement = '<span id="number" class="gray_out_text">Pelo menos ' . $num_numbers . ' numero(s)</span>';
}
		$password_match_statement = '<span id="password_match" class="gray_out_text">Digite a senha identica</span>';


		//2.) Apply default class to gray out green check icon
		echo '
			<style>
				.gray_out_icon{
					-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
					filter: grayscale(100%);
				}
				.gray_out_text{
					opacity: .5;
				}
			</style>
		';

		//3.) Javascript to check to see if user has met conditions on keyup (NOTE: It seems like we shouldn't have to include jquery here because it's already included by UserSpice, but the code doesn't work without it.)
		echo '
			<script type="text/javascript">
			$(document).ready(function(){

				$( "#password" ).keyup(function() {
					var pswd = $("#password").val();

					//validate the length
					if ( pswd.length >= ' . $settings->min_pw . ' && pswd.length <= ' . $settings->max_pw . ' ) {
						$("#character_range_icon").removeClass("gray_out_icon");
						$("#character_range").removeClass("gray_out_text");
					} else {
						$("#character_range_icon").addClass("gray_out_icon");
						$("#character_range").addClass("gray_out_text");
					}

					//validate capital letter
					if ( pswd.match(/[A-Z]/) ) {
						$("#num_caps_icon").removeClass("gray_out_icon");
						$("#caps").removeClass("gray_out_text");
					} else {
						$("#num_caps_icon").addClass("gray_out_icon");
						$("#caps").addClass("gray_out_text");
					}

					//validate number
					if ( pswd.match(/\d/) ) {
						$("#num_numbers_icon").removeClass("gray_out_icon");
						$("#number").removeClass("gray_out_text");
					} else {
						$("#num_numbers_icon").addClass("gray_out_icon");
						$("#number").addClass("gray_out_text");
					}
				});

				$( "#confirm" ).keyup(function() {
					var pswd = $("#password").val();
					var confirm_pswd = $("#confirm").val();

					//validate password_match
					if (pswd == confirm_pswd) {
						$("#password_match_icon").removeClass("gray_out_icon");
						$("#password_match").removeClass("gray_out_text");
					} else {
						$("#password_match_icon").addClass("gray_out_icon");
						$("#password_match").addClass("gray_out_text");
					}

				});
			});
			</script>
		';

?>

		<div style="display: inline-block">
			<label for="password">Insira uma senha* (Entre <?=$settings->min_pw?> e <?=$settings->max_pw?> letras )</label>
			<input  class="form-control" type="password" name="password" id="password" placeholder="Password" required autocomplete="off" aria-describedby="passwordhelp">

			<label for="confirm">Confirme sua senha*</label>
			<input  type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm Password" required autocomplete="off" >
		</div>
		<div style="display: inline-block; padding-left: 20px">
			<strong>As senhas devem...</strong><br>
			<span id="character_range_icon" class="glyphicon glyphicon-ok gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $character_statement;?>
			<br>
<?php
if ($settings->req_cap == 1){ ?>
			<span id="num_caps_icon" class="glyphicon glyphicon-ok gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_caps_statement;?>
			<br>
<?php }

if ($settings->req_num == 1){ ?>
			<span id="num_numbers_icon" class="glyphicon glyphicon-ok gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_numbers_statement;?>
			<br>
<?php } ?>
			<span id="password_match_icon" class="glyphicon glyphicon-ok gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $password_match_statement;?>
		</div>
		<br><br>


		<label for="confirm">Termos de condição de uso  e registro</label>
		<textarea id="agreement" name="agreement" rows="5" class="form-control" disabled ><?php require $abs_us_root.$us_url_root.'usersc/includes/user_agreement.php'; ?></textarea>

<br>



	

	<?php if($settings->recaptcha == 1|| $settings->recaptcha == 2){ ?>
	<div class="form-group" align="center">
		<div class="g-recaptcha" data-sitekey="<?=$publickey; ?>"></div>
	</div>
	<?php } ?>
	<input type="hidden" value="<?=Token::generate();?>" name="csrf">
	

        <div class="form-group">
            <input type="checkbox"  id="agreement_checkbox" name="agreement_checkbox" class="filled-in chk-col-pink">
            <label for="agreement_checkbox">Eu li os termos e concordo!</label>
        </div>

	<button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" id="next_button"><i style="  font-size: 30px !important;" class="material-icons">person_add</i> <b>CADASTRAR</b></button>

    <div class="m-t-25 m-b--5 align-center">
        <a href="login.php">Você já está cadastrado?</a>
    </div>

</div>
</form>


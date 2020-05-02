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
?>


        

<form action="forgot_password.php" method="post" class="form ">
	




                    <div class="msg">
                    	<span class="bg-danger"><?=display_errors($errors);?></span>
                        Enter your email address that you used to register. We'll send you an email with your username and a
                        link to reset your password.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                           <input type="text" name="email" placeholder="Email Address" class="form-control" autofocus>
                        </div>

                    </div>

					<input type="hidden" name="csrf" value="<?=Token::generate();?>">
				<p><input type="submit" name="forgotten_password" value="RESETAR MINHA SENHA" class="btn btn-block btn-lg bg-pink waves-effect"></p>
                    
                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="login.php">Fazer login</a>
                    </div>
                </form>






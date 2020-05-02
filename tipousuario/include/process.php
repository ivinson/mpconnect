<?php
   include('config.php');
	$error  = array();
	$res    = array();
	$success = "";
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add")
	{
		if(empty($_POST['nome']))
		{
			$error[] = "Nome field is required";	
		}
		// if(empty($_POST['last_name']))
		// {
		// 	$error[] = "Last Name field is required";	
		// }
		// if(empty($_POST['email']))
		// {
		// 	$error[] = "Email field is required";	
		// }
		// if(empty($_POST['user_name']))
		// {
		// 	$error[] = "User Name field is required";	
		// }
		// if(empty($_POST['password']))
		// {
		// 	$error[] = "Password field is required";	
		// }
		// if($_POST['password'] != $_POST['cpassword'] )
		// {
		// 	$error[] = "Password field and confrim password field is not matched";	
		// }
		
		// if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false && $_POST['email']!= "" ) {
     
  //       } else {
  //         $error[] = "Enter Valid Email address";
  //        }
		 
		// if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['user_name'])) { 
		//    $error[] = "Enter Valid Username";
  //        } 


		if(count($error)>0)
		{
			$resp['msg']    = $error;
			$resp['status'] = false;	
			echo json_encode($resp);
			exit;
		}
		//$pass = md5($_POST['password']);

		  $sqlQuery = "INSERT INTO 	tipousuario(nome)
		  VALUES(:nome)";		   
		  $run = $db_con->prepare($sqlQuery);
		  $run->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);  
		  // $run->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR); 
		  // $run->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
		  // $run->bindParam(':password',$pass, PDO::PARAM_STR); 
		  // $run->bindParam(':user_name', $_POST['user_name'], PDO::PARAM_STR);  
		  $run->execute(); 	
		  
		  $resp['msg']    = "Tipo added successfully";
		  $resp['status'] = true;	
		   echo json_encode($resp);
			exit;	 
		 
		
	}
	else if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit")
	{
		
		if(empty($_POST['nome']))
		{
			$error[] = "First Name field is required";	
			//$error[] = $_POST['nome'];
		}
		// if(empty($_POST['last_name']))
		// {
		// 	$error[] = "Last Name field is required";	
		// }
		// if(empty($_POST['email']))
		// {
		// 	$error[] = "Email field is required";	
		// }
		// if(empty($_POST['user_name']))
		// {
		// 	$error[] = "User Name field is required";	
		// }
		
		// if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false && $_POST['email']!="" ) {
     
  //       } else {
  //         $error[] = "Enter Valid Email address";
  //        }
		 
		// if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['user_name']) && $_POST['user_name']!="" ) { 
		//    $error[] = "Enter Valid Username";
  //        } 


		if(count($error)>0)
		{
			$resp['msg']    = $error;
			$resp['status'] = false;	
			echo json_encode($resp);
			exit;
		}
		
		  $sqlQuery = "UPDATE tipousuario SET nome = :nome
            WHERE id = :id";
		  $run = $db_con->prepare($sqlQuery);
		  $run->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);  
		  
		  // $run->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR); 
		  // $run->bindParam(':email', $_POST['email'], PDO::PARAM_STR); 
		  // $run->bindParam(':password', $_POST['password'], PDO::PARAM_STR); 
		  // $run->bindParam(':user_name', $_POST['user_name'], PDO::PARAM_STR);
		   $run->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

		  $run->execute(); 
		  $resp['msg']    = "Nome updated successfully";
		  $resp['status'] = true;	
		  echo json_encode($resp);
		   exit; 	
	}
	else if(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete")
	{
		  $sqlQuery = "DELETE FROM tipousuario WHERE id =  :id";
	      $run = $db_con->prepare($sqlQuery);
	      $run->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
	      $run->execute();
		  $resp['status'] = true;
		  $resp['msg'] = "Record deleted successfully";
		  echo json_encode($resp);
		  
	}
	else if(isset($_REQUEST['action']) && $_REQUEST['action'] == "list")
	{
	    $statement = $db_con->prepare("select * from tipousuario where id > :id");
        $statement->execute(array(':id' => 0));
		$row = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo "<pre>";
		print_r($row);
		echo "</pre>";
	}

?>
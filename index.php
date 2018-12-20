<?php
session_start();
require 'core/connection.php';
if(!empty($_POST["login"])){
    
	//Retrieve the field values from our login form.
	$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
	$passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
	// $passwordAttempt = sha1($passwordAttempt);

	//Retrieve the user account information for the given username.
	$sql = "SELECT id, username, password FROM users WHERE username = :username";
	$stmt = $pdo->prepare($sql);
	
	//Bind value.
	$stmt->bindValue(':username', $username);
	
	//Execute.
	$stmt->execute();
	
	//Fetch row.
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//If $row is FALSE.
	if($user === false){
			//Could not find a user with that username!
			//PS: You might want to handle this error in a more user-friendly manner!
			die('Incorrect username / password combination!!!!');
	} else{
			//User account found. Check to see if the given password matches the
			//password hash that we stored in our users table.
			
			//Compare the passwords.
			$validPassword = password_verify(sha1($passwordAttempt), $user['password']);
			// echo sha1($passwordAttempt)."</br>";
			// echo $user['password']."</br>";

			// echo sha1($validPassword);
			// die;
			//If $validPassword is TRUE, the login has been successful.
			if(sha1($passwordAttempt)===$user['password']){
					
					//Provide the user with a login session.
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['logged_in'] = time();
					
					//Redirect to our protected page, which we called home.php
					header('Location: core/acceuil.php');
					exit;
					
			} else{
					//$validPassword was FALSE. Passwords do not match.
					die('Incorrect username / password combination!');
			}
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSSM - PROG web</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <style type="text/css">

  	.login-section{
  		margin-top: 60px;
		color : white;
  	}
  	.login-logo{
  		margin-bottom: 40px;
  	}
	form{
   		background-color: #A35119;
   		padding: 20px;
   		border-radius: 5px; 
	}
	label{
		font-weight: bold;
	}
  </style>
  <body>

	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="login-section">
			
					<div class="login-logo text-center">
					  <img src="img\logo.png" width="150" height="180" alt="uca">
					</div>
					
					<form method="POST">
						<h6 class="text-center">Connectez-vous pour commencer votre session</h6>
						<div class="form-group">
							<label for="username">Nom d'utilisateur:</label>
							<input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" name="username">
						</div>
						<div class="form-group">
							<label for="password">Mot de passe:</label>
							<input type="password" class="form-control" name="password" placeholder="Mot de passe" name="pwd">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-default text-center" name="login" value="login">Se connecter</button>
						</div>
						
					</form>			
				</div>				
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>

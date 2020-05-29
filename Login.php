<?php

	session_start();
	if (isset($_SESSION['user_id'])) {
		header('Location: /homepage.php');
	  }

	require './config/config2.php';

	if(!empty($_POST['UserName']) && !empty($_POST['Password'])){
		$records = $conn->prepare('SELECT idUsers, Name, Lastname, Email, Password FROM Users Where Email = "'.$_POST['UserName'].'"');
		$records->bindParam(':UserName', $_POST['Email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		echo var_dump($results);
		//echo var_dump($records);
		echo $results["idUsers"];
		$message = '';

		if(count($results) > 0){
			$_SESSION['user_id'] = $results['id'];
			header("Location: ./homepage.php");
		}else{
			$message = 'test';
			echo 'test2';
		}
	}
	
?>

<!DOCTYPE html>
<html>
    
<head>
	<title>SignUp</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	
</head>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="./images/icon.png"  alt="ToDoListApp">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action='' method='post'>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="UserName" class="form-control input_user" value="" placeholder="Email">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="Password" class="form-control input_pass" value="" placeholder="password">
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="LoginB" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="./Sign-Up.php" class="ml-2">Sign Up</a>
					
					</div>
					</div>
			</div>
		</div>
	</div>
</body>
</html>
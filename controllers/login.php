<?php
	session_start();
  require '../config/config2.php';
  
	if(!empty($_POST['UserName']) && !empty($_POST['Password'])){
		$records = $conn->prepare('SELECT idUsers, Name, Lastname, Email, Password FROM Users Where Email = "'.$_POST['UserName'].'"');
		$records->bindParam(':UserName', $_POST['Email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		$message = '';

		if(count($results) > 0){
			session_start();
			$_SESSION['user_id'] = (int)$results['idUsers'];
  		$_SESSION['username'] = $results['Name'].' '.$results['Lastname'];
			header("Location: ../homepage.php");
		}else{
			echo 'Oh no! Something went wrong';
		}
	}
	
?>
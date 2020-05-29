<?php
	require '../config/config2.php';
	if(!empty($_POST['email']) && !empty($_POST['password']) ){
    $name = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = 'INSERT INTO Users VALUES (idUsers, "'.$name.'", "'.$lastname.'", "'.$email.'", "'.$password.'")';
		$stmt = $conn->prepare($sql);
    $stmt->bindParam(':Email, ', $_POST['Email']);

		if ($stmt->execute()){
      header("Location: ../index.html");
		}else{
			$message = 'An error ocurred';
			echo "message";
		}
	}
?>

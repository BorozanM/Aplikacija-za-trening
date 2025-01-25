<?php

    include 'dbbroker.php';
    include 'model/User.php';

	
		session_start();
	
	// $_SERVER["REQUEST_METHOD"] == "POST" &&
	if( isset($_POST["login"])){ 
    	$email = $_POST["emailLogin"];
		$password = $_POST["passLogin"];

        $user = new User(null,null,$email,$password);
		$result=User::login($user,$conn);

		$id = User::getIdByEmail($user,$conn);
		$_SESSION["currentUser"] = $id;

		if(mysqli_num_rows($result) > 0){
			
			echo '<script>alert("USPEŠNO")</script>';
			header('Location: home.php');
		}
        else{
			echo '<script>alert("Greška pri logovanju.")</script>';
			echo '<script>window.location.href="index.php";</script>'; 
		}
	}

?>
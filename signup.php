<?php

    include 'dbbroker.php';
    include 'model/User.php';

	session_start();
	if(isset($_POST["signup"])){ 
        $name = $_POST["nameSignup"];
    	$email = $_POST["emailSignup"];
		$password = $_POST["passSignup"];

        $user = new User(null,$name,$email,$password);
		$result=User::signup($user,$conn);

		if ($result) {
            // Uspešna registracija
            echo '<script>alert("Uspešna registracija!")</script>';
			echo '<script>window.location.href="home.php";</script>'; 
            exit(); 
        } else {
            // Greška pri registraciji
            echo '<script>alert("Došlo je do greške pri registraciji!")</script>';
        }

	}

?>
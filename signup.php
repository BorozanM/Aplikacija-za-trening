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
            echo '<script>alert("Uspešna registracija! Ulogujte se.")</script>';
			echo '<script>window.location.href="index.php";</script>'; 
            exit(); 
        } else {
            // Greška pri registraciji
            echo '<script>alert("Korisnik sa istim mailom već postoji.")</script>';
			echo '<script>window.location.href="index.php";</script>'; 

        }

	}

?>
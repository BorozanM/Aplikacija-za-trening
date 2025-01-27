
		<?php

include 'dbbroker.php';
include 'model/User.php';


	session_start();

// $_SERVER["REQUEST_METHOD"] == "POST" &&
if (isset($_POST["login"])) { 
    $email = trim($_POST["emailLogin"]);
    $password = trim($_POST["passLogin"]);

    $user = new User(null, null, $email, $password);
    $result = User::login($user, $conn);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc(); 
        $id = $row['id']; 
        $name = $row['name'];
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["currentUser"] = $id;
            $_SESSION["currentUserName"] = $name;
            echo '<script>alert("USPEŠNO")</script>';
            echo '<script>window.location.href="home.php";</script>'; 
        } else {
            echo '<script>alert("Greška pri logovanju. Pogrešna lozinka.")</script>';
            echo '<script>window.location.href="index.php";</script>'; 
        }
    } else {
        echo '<script>alert("Greška pri logovanju. Nema korisnika sa tim emailom.")</script>';
        echo '<script>window.location.href="index.php";</script>';
    }
}

?>
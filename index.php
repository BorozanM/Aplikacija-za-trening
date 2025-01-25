<?php
	include 'login.php';
	// include 'signup.php';

?>


<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login and Registration </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container" >
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Svakim novim treningom <br>počinje nova avantura!</span>
          <span class="text-2">Kreni danas!</span>
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1">Ispuni svoje snove <br> svakim korakom!</span>
          <span class="text-2">Čekamo te!</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Uloguj se</div>
          <form action="login.php" method="POST" >
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="emailLogin" id="emailLogin" placeholder="Unesi email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="passLogin" id="passLogin" placeholder="Unesi lozinku" required>
              </div>
              <!-- <div class="text"><a href="#">Forgot password?</a></div> -->
              
    <div class="button input-box" action="login.php" method="POST">
        <input type="submit" id="login" name="login" value="Potvrdi">
    </div>
                  <div class="text sign-up-text">Nemaš nalog? <label for="flip">Registruj se</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Registruj se</div>
        <form action="signup.php" method="POST">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="name" name="nameSignup" id="nameSignup" placeholder="Unesi svoje ime" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="emailSignup" id="emailSignup" placeholder="Unesi email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="passSignup" id="passSignup" placeholder="Unesi šifru" required>
              </div>
              <div class="button input-box" action="signup.php" method="POST">
                <input type="submit" id="signup" name="signup" value="Potvrdi">
              </div>
              <div class="text sign-up-text">Već imaš nalog? <label for="flip">Uloguj se</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
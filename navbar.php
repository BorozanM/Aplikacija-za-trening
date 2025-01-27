<nav class="header">
  <div class="header-left">
    <a href="#default" class="logo">
      <img src="images/volimSport.jpg" alt="Logo" width="60" height="60">
    </a>
    <span class="greeting">Zdravo, <?php echo htmlspecialchars($userName); ?>!</span>
  </div>
  <div class="header-right">
    <a href="#contact">Treninzi</a>
    <a href="#contact">Kontakt</a>
    <a href="#about">O nama</a>
    <form action="logout.php" method="POST" class="logout-form">
      <button type="submit" name="logout">Odjavi se</button>
    </form>
  </div>
</nav>
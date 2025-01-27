<?php
session_start();
$userId = $_SESSION["currentUser"]; 
$userName = $_SESSION["currentUserName"];

include 'navbar.php';
include 'dbbroker.php';
include 'model/Training.php';

 $trainings = Training::getTrainingByUser($userId, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Prati svaki korak!</h1>
          <p>Pomoću ove aplikacije ćeš brže i efikasnije pratiti napredak svojih treninga iz dana u dan.</p>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Dodaj trening</a></p>
        </div>
      </div>
<!-- ovde je kraj zaglavlja, pocinje tabela -->
      <table class="table">
  <thead>
    <tr>
    
      <th scope="col">Vrsta</th>
      <th scope="col">Trajanje</th>
      <th scope="col">Kalorije</th>
      <th scope="col">Tezina</th>
      <th scope="col">Umor</th>
      <th scope="col">Beleske</th>
      <th scope="col">Datum i vreme</th>

    </tr>
  </thead>
  <tbody>
  <?php
   
    while( $row = $trainings ->fetch_array()):
      $formattedDate = date("Y-m-d H:i", strtotime($row['datumVreme']));
      ?>


    <tr>
          
            <td> <?php echo $row['vrsta']?></td>
            <td> <?php echo $row['trajanje']?></td>
            <td> <?php echo $row['kalorije']?></td>
            <td> <?php echo $row['tezina']?></td>
            <td> <?php echo $row['umor']?></td>
            <td> <?php echo $row['beleske']?></td>
            <td><?php echo $formattedDate; ?></td> <!-- Prikaz formiranog datuma i vremena -->

    </tr>

    <?php endwhile;?>
  </tbody>
</table>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
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
          
            <p><button type="button" class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#addModal">Dodaj trening</button>
          <button type="button" class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#statisticsModal">Statistika</button>
          </p>

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
          
            <td> <?php echo $row['vrsta_naziv']?></td>
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




<!-- Add modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="lblUpdateModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titleUpdate">Dodaj trening</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                              
                        <form  id="addform" style="max-width:500px;margin:auto" method="POST" enctype="multipart/form-data">
 
                            <div class="input-container">
                                <i class="fa fa-user icon"></i>
                                <input class="input-field" type="text" placeholder="Vrsta treninga" name="model" id="model" required>
                            </div>

                            <div class="input-container">
                                <i class="fa fa-pencil icon"></i>
                                <input class="input-field" type="text" placeholder="Trajanje treninga(min)" name="description" id="description" required>
                            </div>
                            
                            <div class="input-container">
                                <i class="fa fa-tag icon"></i>
                                <input class="input-field" type="text" placeholder="Kalorije" name="price" id="price" required>
                            </div>
                            <div class="input-container">
                                <i class="fa fa-tag icon"></i>
                                <input class="input-field" type="text" placeholder="Tezina" name="price" id="price" required>
                            </div>
                            <div class="input-container">
                                <i class="fa fa-tag icon"></i>
                                <input class="input-field" type="text" placeholder="Umor" name="price" id="price" required>
                            </div>
                            <div class="input-container">
                                <i class="fa fa-tag icon"></i>
                                <input class="input-field" type="text" placeholder="Dodatne beleške" name="price" id="price" required>
                            </div>
                            <div class="input-container">
                                <i class="fa fa-tag icon"></i>
                                <input class="input-field" type="text" placeholder="Datum i vreme treninga" name="price" id="price" required>
                            </div>
                       
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="add" name="add"  >  Add</button>
                            
                        </div>                   
                    
                        </form>


                        </div>
                        
                       
                </div>
            </div>
        </div>
<!-- End Add modal -->




<!-- Statistics modal -->
<div class="modal fade" id="statisticsModal" tabindex="-1" role="dialog" aria-labelledby="lblStatisticsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Statistika treninga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="statisticsForm" method="GET">
                    <!-- Izbor meseca -->
                    <div class="form-group">
                        <label for="mesec">Izaberite mesec:</label>
                        <select class="form-control" id="mesec" name="mesec" required>
                            <option value="1">Januar</option>
                            <option value="2">Februar</option>
                            <option value="3">Mart</option>
                            <option value="4">April</option>
                            <option value="5">Maj</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Avgust</option>
                            <option value="9">Septembar</option>
                            <option value="10">Oktobar</option>
                            <option value="11">Novembar</option>
                            <option value="12">Decembar</option>
                        </select>
                    </div>

                    <!-- Izbor godine -->
                    <div class="form-group">
                        <label for="godina">Izaberite godinu:</label>
                        <select class="form-control" id="godina" name="godina" required>
                            <?php
                            $trenutnaGodina = date("Y");
                            for ($i = $trenutnaGodina; $i >= $trenutnaGodina - 5; $i--) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="prikaziStatistiku">Prikaži statistiku</button>
                    </div>
                </form>

                <div id="statistikaRezultat" class="mt-3">
                    <!-- Ovde će se prikazivati statistika -->
                     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Statistics modal -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- JavaScript kod za formu statistike-->
<script>
document.getElementById('prikaziStatistiku').addEventListener('click', function () {
    const mesec = document.getElementById('mesec').value;
    const godina = document.getElementById('godina').value;

    if (!mesec || !godina) {
        alert('Molimo izaberite mesec i godinu.');
        return;
    }

    fetch(`statistika.php?mesec=${mesec}&godina=${godina}`)
        .then(response => response.json())
        .then(data => {
            const rezultatDiv = document.getElementById('statistikaRezultat');
            rezultatDiv.innerHTML = ''; 

            if (data.error) {
                rezultatDiv.innerHTML = `<p class="text-danger">${data.error}</p>`;
                return;
            }

            let tabela = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nedelja</th>
                            <th>Ukupno trajanje</th>
                            <th>Broj treninga</th>
                            <th>Prosečna težina treninga</th>
                            <th>Prosečan umor</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.forEach(stat => {
                tabela += `
                    <tr>
                        <td>${stat.nedelja}</td>
                        <td>${stat.ukupno_trajanje} min</td>
                        <td>${stat.broj_treninga}</td>
                        <td>${parseFloat(stat.prosecan_tezina).toFixed(2)}</td>
                        <td>${parseFloat(stat.prosecan_umor).toFixed(2)}</td>
                    </tr>
                `;
            });

            tabela += `</tbody></table>`;
            rezultatDiv.innerHTML = tabela;
        })
        .catch(error => {
            console.error('Greška:', error);
            document.getElementById('statistikaRezultat').innerHTML = '<p class="text-danger">Došlo je do greške prilikom učitavanja statistike.</p>';
        });
});
</script>


</body>
</html>
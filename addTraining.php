<?php
session_start();
include 'dbbroker.php';  
include 'model/Training.php'; 

if (isset($_POST['add'])) {
    $vrsta_id = $_POST['training_type']; 
    $trajanje = $_POST['duration'];  
    $kalorije = $_POST['calories']; 
    $tezina = $_POST['weight']; 
    $umor = $_POST['fatigue']; 
    $beleske = $_POST['notes'];  
    $datumVreme = $_POST['datetime']; 

    $userId = $_SESSION["currentUser"];

    $training = new Training(
        null,  // automatski ce u bazi?
        $trajanje,
        $kalorije,
        $tezina,
        $umor,
        $beleske,
        $datumVreme,
        $userId,
        $vrsta_id
    );

    $result = Training::addTraining($training, $conn);

    if ($result) {

        header('Location: home.php?message=Trening uspešno dodat');
        exit();
    } else {
        header('Location: home.php?message=Greška prilikom dodavanja treninga');
        exit();
    }
}
?>

<?php
require_once 'dbbroker.php'; 
require_once 'model/Training.php'; 

session_start();
header('Content-Type: application/json');

if (isset($_GET['mesec'], $_GET['godina'])) {
    $mesec = intval($_GET['mesec']);
    $godina = intval($_GET['godina']);
    $userId = $_SESSION['currentUser']; 

    if (!$userId) {
        echo json_encode(['error' => 'Korisnik nije ulogovan.']);
        exit;
    }

    try {
        $stats = Training::getWeeklyStats($mesec, $godina, $userId, $conn);

        if (empty($stats)) {
            echo json_encode(['error' => 'Nema dostupnih podataka za odabrani mesec i godinu.']);
        } else {
            echo json_encode($stats);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Došlo je do greške: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Parametri meseca i godine nisu prosleđeni.']);
}
?>

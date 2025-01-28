<?php

class Training
{
    private $id;
    private $trajanje;
    private $kalorije;
    private $tezina;
    private $umor;
    private $beleske;
    private $datumVreme;
    private $user;
    private $vrsta_id;

    public function __construct(
        $id = null,
        $trajanje = null,
        $kalorije = null,
        $tezina = null,
        $umor = null,
        $beleske = null,
        $datumVreme = null,
        $user = null,
        $vrsta_id = null
    ) {
        $this->id = $id;
        $this->trajanje = $trajanje;
        $this->kalorije = $kalorije;
        $this->tezina = $tezina;
        $this->umor = $umor;
        $this->beleske = $beleske;
        $this->datumVreme = $datumVreme;

        $this->user = $user;
        $this->vrsta_id = $vrsta_id;

    }


    public static function getAllTrainings($conn)
    {
        $query = "SELECT p.*, v.naziv AS vrsta_naziv FROM training p 
                  INNER JOIN vrste_treninga v ON p.vrsta_id = v.id 
                  INNER JOIN user u ON u.id = p.user";
        return $conn->query($query);
    }

    public static function getTrainingByUser($userId, $conn)
    {
        $query = "SELECT p.*, v.naziv AS vrsta_naziv FROM training p 
                  INNER JOIN vrste_treninga v ON p.vrsta_id = v.id 
                  INNER JOIN user u ON u.id = p.user 
                  WHERE u.id = ? 
                  ORDER BY p.datumVreme DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function addTraining($training, $conn): mixed
{
    
    if ($training->trajanje < 0 || $training->kalorije < 0 || $training->tezina < 1 || $training->tezina > 10 || $training->umor < 1 || $training->umor > 10) {
        return false; 
    }

    $query = "INSERT INTO training (trajanje, kalorije, tezina, umor, beleske, datumVreme, user, vrsta_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "iiiissii",
        $training->trajanje,
        $training->kalorije,
        $training->tezina,
        $training->umor,
        $training->beleske,
        $training->datumVreme,
        $training->user,
        $training->vrsta_id
    );
    return $stmt->execute();
}



    public static function getWeeklyStats($mesec, $godina, $userId, $conn)
    {
        $query = "
            SELECT 
    FLOOR((DAY(datumVreme) - 1) / 7) + 1 AS nedelja, 
    SUM(trajanje) AS ukupno_trajanje,
    COUNT(*) AS broj_treninga,
    CASE 
        WHEN AVG(tezina) = FLOOR(AVG(tezina)) THEN FLOOR(AVG(tezina))
        ELSE AVG(tezina)
    END AS prosecan_tezina,
    CASE 
        WHEN AVG(umor) = FLOOR(AVG(umor)) THEN FLOOR(AVG(umor))
        ELSE AVG(umor)
    END AS prosecan_umor
FROM training 
WHERE MONTH(datumVreme) = ?
  AND YEAR(datumVreme) = ?
  AND user = ?
GROUP BY nedelja
ORDER BY nedelja;
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $mesec, $godina, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stats = [];

        while ($row = $result->fetch_assoc()) {
            $stats[] = $row;
        }

        return $stats;
    }

    public static function getTrainingTypes($conn)
    {
        $query = "SELECT DISTINCT vt.id, vt.naziv 
FROM vrste_treninga vt
LEFT JOIN training t ON vt.id = t.vrsta_id";
        $result = $conn->query($query);

        if (!$result) {
            die('Greška u upitu: ' . $conn->error);
        }

        // Čitanje rezultata i vraćanje kao asocijativni niz
        $trainingTypes = [];
        while ($row = $result->fetch_assoc()) {
            $trainingTypes[] = $row;
        }

        return $trainingTypes;
    }


}

?>
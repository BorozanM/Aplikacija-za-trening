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
    private $vrstaId;

    public function __construct(
        $id = null,
        $trajanje = null,
        $kalorije = null,
        $tezina = null,
        $umor = null,
        $beleske = null,
        $datumVreme = null,
        $user = null,
        $vrstaId = null
    ) {
        $this->id = $id;
        $this->trajanje = $trajanje;
        $this->kalorije = $kalorije;
        $this->tezina = $tezina;
        $this->umor = $umor;
        $this->beleske = $beleske;
        $this->datumVreme = $datumVreme;

        $this->user = $user;
        $this->vrstaId = $vrstaId;

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

    public static function addTraining($training, $conn)
    {
        $query = "INSERT INTO training (trajanje, kalorije, tezina, umor, beleske, datumVreme, user, vrstaId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "iiiiissi",
            $training->trajanje,
            $training->kalorije,
            $training->tezina,
            $training->umor,
            $training->beleske,
            $training->datumVreme,
            $training->user,
            $training->vrstaId
        );
        return $stmt->execute();
    }

    // public static function addTraining($training, $conn){

    //     $query= "insert into training(vrsta ,trajanje,kalorije ,tezina, umor, beleske, datumVreme, user ) values
    //     ('$training->vrsta','$training->trajanje',$training->kalorije,$training->tezina,$training->umor,
    //     $training->beleske,$training->datumVreme,$training->user )";

    //     return $conn->query($query);


    // }

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



}

?>
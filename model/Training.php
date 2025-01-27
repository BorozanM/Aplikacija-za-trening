<?php

class Training{
    private $id;
    private $vrsta;
    private $trajanje;
    private $kalorije;
    private $tezina;
    private $umor;
    private $beleske;
    private $datumVreme;
    private $user;

    public function __construct($id=null,$vrsta=null,$trajanje=null,$kalorije=null,$tezina=null,$umor=null,
    $beleske=null,$datumVreme=null,$user=null ) 
    {
        $this->id=$id;
        $this->vrsta=$vrsta;
        $this->trajanje=$trajanje;
        $this->kalorije=$kalorije;
        $this->tezina=$tezina;
        $this->umor=$umor;
        $this->beleske=$beleske;
        $this->datumVreme=$datumVreme;

        $this->user=$user; 

    }


    public static function getAllTrainings($conn){

        $query= "select * from training p inner join user u on u.id=p.user";
        return $conn->query($query);
    }
    
    public static function getTrainingByUser($userId, $conn) {
        $query = "SELECT p.* FROM training p INNER JOIN user u ON u.id = p.user WHERE u.id = ? ORDER BY p.datumVreme DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId); 
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function addTraining($training, $conn){

        $query= "insert into training(vrsta ,trajanje,kalorije ,tezina, umor, beleske, datumVreme, user ) values
        ('$training->vrsta','$training->trajanje',$training->kalorije,$training->tezina,$training->umor,
        $training->beleske,$training->datumVreme,$training->user )";
        
        return $conn->query($query);
        

    }


    



}

?>
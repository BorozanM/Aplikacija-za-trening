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


    public static function addTraining($training, $conn){

        $query= "insert into training(vrsta ,trajanje,kalorije ,tezina, umor, beleske, datumVreme, user ) values
        ('$training->vrsta','$training->trajanje',$training->kalorije,$training->tezina,$training->umor,
        $training->beleske,$training->datumVreme,$training->user )";
        
        return $conn->query($query);
        

    }


    // public static function getLaptopById($id, $conn){

    //     $query= "select * from laptop p inner join user u on u.id=p.user where p.id=$id";
        
    //     return $conn->query($query);


    // }


    // public static function deleteLaptop($id,$conn){

    //     $query = "delete from laptop where id=$id";
    //     return $conn->query($query);

    // }

    // public static function updateLaptop($laptop,$conn){

    //     $query = "update laptop set model='$laptop->model', description = '$laptop->description', price = $laptop->price where id = $laptop->id";
    //     return $conn->query($query);

    // }



}

?>
<?php

class VrstaTreninga {
    private $id;
    private $naziv;

    public function __construct($id = null, $naziv = null) {
        $this->id = $id;
        $this->naziv = $naziv;
    }

    public static function getAllVrste($conn) {
        $query = "SELECT * FROM vrste_treninga";
        return $conn->query($query);
    }

    public static function addVrstaTreninga($vrsta, $conn) {
        $query = "INSERT INTO vrste_treninga (naziv) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $vrsta->naziv);
        return $stmt->execute();
    }

    public static function getVrstaById($id, $conn) {
        $query = "SELECT * FROM vrste_treninga WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function getVrste($conn)
{
    $query = "SELECT id, naziv FROM vrste_treninga"; 
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}
}
?>
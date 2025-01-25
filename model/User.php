<?php
class User{
    private $id;
    private $name;
    private $email;
    private $password;



    public function __construct($id=null, $name=null, $email=null, $password=null){
        $this->id=$id;
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;

    }
   

    public static function login($user,$conn){
        $query = "select * from user where email='$user->email' and password='$user->password'";

        return $conn->query($query);

    }
    
    
    public static function signup($user,$conn){

        $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->bind_param("s", $user->email);  
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return false; 
        }

        $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO `user` (`name`, `email`, `password`) VALUES (?, ?, ?)");
    

        $stmt->bind_param("sss", $user->name, $user->email,$hashedPassword);  // 'sss' svi stringovi
    
        if ($stmt->execute()) {
            // Ako je upit uspešno izvršen, vrati true
            $stmt->close();
            return true;
        } else {
            // Ako je došlo do greške, vrati false
            $stmt->close();
            return false;
        }
    }



    public static function getIdByEmail($user,$conn){
        $query = "  select * from user where email='$user->email' ";
        $myArray = array();
        $result= $conn->query($query);
        if($result){
            while($row = $result->fetch_array()){

                $myArray[] = $row;
            }
        }
        // return $myArray[0]["userId"];
return 1;
    }
 


}



?>
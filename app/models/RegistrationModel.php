<?php
class RegistrationModel extends Model {
    public function loginIsUse($login) {
        $sql = "SELECT * FROM \"User\" WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function addNewUser($email, $login, $password) {
        $insertDataQuery = "
        INSERT INTO \"User\" (email, login, password) 
        VALUES (:email, :login, :password);
    ";
    
    $stmt = $this->db->prepare($insertDataQuery);
    $success = $stmt->execute([
        'email' => $email,
        'login' => $login,
        'password' => $password
    ]);
        
        if ($success) {
            return true;
        } else {
            return false;
        }
    }
}
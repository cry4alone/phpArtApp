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
    
    public function addNewUser($email, $login, $password, $pathToAvatar = null) {
        $insertDataQuery = "
        INSERT INTO \"User\" (email, login, password, pathToAvatar) 
        VALUES (:email, :login, :password, :pathToAvatar);
    ";
    
    $stmt = $this->db->prepare($insertDataQuery);
    $success = $stmt->execute([
        'email' => $email,
        'login' => $login,
        'password' => $password,
        'pathToAvatar' => $pathToAvatar
    ]);
        
        return $success;
    }
}
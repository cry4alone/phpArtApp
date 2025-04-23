<?php
class LoginModel extends Model {
    public function checkLogin($login, $password) {
        $sql = "SELECT * FROM \"User\" WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['login' => $login,'password'=> $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            return true;
        }
        else{
            return false;
        }
    }
}
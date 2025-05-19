<?php
class LoginModel extends Model {
    public function checkLogin($login, $password) {
        $sql = "SELECT * FROM \"User\" WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        if($user){
            $_SESSION['password'] = $user['password'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['pathToAvatar'] = $user['pathtoavatar'];
            $_SESSION['isAdmin'] = $user['admin'];
            return true;
        }
    }
}
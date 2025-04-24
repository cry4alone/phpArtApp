<?php
class RegistrationModel extends Model {
    public function addUser($login, $password, $email) {
        $checkSql = "SELECT COUNT(*) FROM \"User\" WHERE login = :login OR email = :email";
        $checkStmt = $this->db->prepare($checkSql);
        $checkStmt->execute(['login' => $login, 'email' => $email]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            throw new Exception('Пользователь с таким логином или почтой уже существует');
        }

        $sql = "INSERT INTO \"User\" (login, password, email) VALUES (:login, :password, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['login' => $login, 'password' => $password, 'email' => $email]);
    }
}
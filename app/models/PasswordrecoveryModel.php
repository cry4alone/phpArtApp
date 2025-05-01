<?php
class PasswordrecoveryModel extends Model {
    public function resetUserPassword($email, $newpassword) {
        $sql = "SELECT * FROM \"User\" WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            $updateSql = "UPDATE \"User\" SET password = :password WHERE email = :email";
            $updateStmt = $this->db->prepare($updateSql);
            return $updateStmt->execute([
                'password' => $newpassword,
                'email' => $email
            ]);
        }
        return false;
    }
}
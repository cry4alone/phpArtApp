<?php
class ChangeprofileModel extends Model {
    public function updateLoginAndEmail($oldLogin, $newLogin, $newEmail) {
        $sql = "UPDATE \"User\"
            SET login = :newLogin,
                email = :newEmail
            WHERE login = :oldLogin
            RETURNING 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'newLogin' => $newLogin,
            'newEmail' => $newEmail,
            'oldLogin' => $oldLogin,
        ]);

        $updated = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($updated) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($login, $newPassword) {
        $sql = "UPDATE \"User\"
            SET password = :newPassword
            WHERE login = :login
            RETURNING 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'newPassword' => $newPassword,
            'login' => $login,
        ]);

        $updated = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($updated) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePathToVatar($login, $newPathToVatar) {
        $sql = "UPDATE \"User\"
                SET pathtoavatar = :newPathToVatar
                WHERE login = :login
                RETURNING 1;";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $login,
            'newPathToVatar' => $newPathToVatar
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
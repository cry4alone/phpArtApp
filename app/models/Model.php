<?php

class Model {
	protected $db = null;
	public function __construct() {
		$this->db = DB::connectToDB();
	}

	public function emailIsUse($email) {
        $sql = "SELECT * FROM \"User\" WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            return true;
        }
        else{
            return false;
        }
    }

    public function getUser($login) {
        $sql = "SELECT * FROM public.\"User\"
                WHERE login = :login";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'login' => $login,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}
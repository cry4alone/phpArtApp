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
}
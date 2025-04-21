<?php
class DB{
    private static $pdo = null;
    private function __construct() {}

	public static function connectToDB() {
        $dsn = "pgsql:host=db;port=5432;dbname=mydb;user=root;password=root";
        if(self::$pdo === null) {
            try {
                self::$pdo = new PDO($dsn);
            } catch (PDOException $e) {
                echo "Ошибка подключения: " . $e->getMessage();
            }
        }
		return self::$pdo;
	}
}
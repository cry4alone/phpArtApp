<?php
class DB {
    private static $pdo = null;
    private function __construct() {}

    public static function fillDB() {
        $pdo = self::connectToDB();

        $stmt = $pdo->query("SELECT to_regclass('public.\"User\"')");
        $tableExists = $stmt->fetchColumn() !== null;

        if (!$tableExists) {
            $createTableQuery = "
                CREATE TABLE \"User\" (
                    id SERIAL PRIMARY KEY,
                    email VARCHAR(100) NOT NULL,
                    login VARCHAR(100) NOT NULL,
                    password VARCHAR(100) NOT NULL
                );
            ";
            $pdo->exec($createTableQuery);

            $insertDataQuery = "
                INSERT INTO \"User\" (email, login, password) 
                VALUES 
                    ('andrey@example.com', 'andrey', 'qwerty'),
                    ('admin@example.com', 'admin', 'admin');
            ";
            $pdo->exec($insertDataQuery);
        }
    }

    public static function connectToDB() {
        if (self::$pdo === null) {
            try {
                $dsn = "pgsql:host=db;port=5432;dbname=mydb";
                $username = "root";
                $password = "root";
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //чтобы выбрасывал ошибки
            } catch (PDOException $e) {
                die("Ошибка подключения: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
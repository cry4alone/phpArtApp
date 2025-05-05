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
                    password VARCHAR(100) NOT NULL,
                    pathtoavatar VARCHAR(100)
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

        // Проверка существования таблицы "images"
        $stmt = $pdo->query("SELECT to_regclass('public.images')");
        $imagesTableExists = $stmt->fetchColumn() !== null;

    if (!$imagesTableExists) {
        $createImagesTableQuery = "
            CREATE TABLE images (
                id SERIAL PRIMARY KEY,
                filename TEXT NOT NULL,
                title VARCHAR(50),
                description VARCHAR(255),
                is_shared BOOLEAN DEFAULT FALSE,
                user_id INTEGER REFERENCES \"User\"(id) ON DELETE CASCADE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $pdo->exec($createImagesTableQuery);

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
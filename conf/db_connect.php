<?php
class DB{

	//Заполнение БД тестовыми данными
	public static function fillDB(){
		$connection = self::connectToDB();

		//Наличие таблицы User
		$result = pg_query($connection, "SELECT to_regclass('public.\"User\"');");
        $tableExists = pg_fetch_result($result, 0, 0) !== null;

		if (!$tableExists) {
            $createTableQuery = "
                CREATE TABLE \"User\" (
                    id SERIAL PRIMARY KEY,
					email VARCHAR(100) NOT NULL,
                    login VARCHAR(100) NOT NULL,
					password VARCHAR(100) NOT NULL
                );
            ";
            pg_query($connection, $createTableQuery);

            $insertDataQuery = "
                INSERT INTO \"User\" (email, login, password) 
                VALUES 
                    ('andrey@example.com', 'andrey', 'qwerty'),
                    ('admin@example.com', 'admin', 'admin');
            ";
            pg_query($connection, $insertDataQuery);
        }
	}

	public static function connectToDB() {
		$connection = pg_connect("host=db port=5432 dbname=mydb user=root password=root");
		return $connection;
	}
}
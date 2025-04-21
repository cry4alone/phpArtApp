<?php
class DB{

	public static function connectToDB() {
		static $connection = pg_connect("host=db port=5432 dbname=mydb user=root password=root");
		return $connection;
	}
}
<?php
include_once ('C:\xampp\htdocs\trex\app\config.php');
class Database {

    private static function connect() {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=' . DBName .';charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function querySingle($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    public static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode(' ', $query)[0] == 'SELECT') {
            //$data = $statement->fetchAll();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }


}

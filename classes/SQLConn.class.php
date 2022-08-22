<?php
class SQLConn {
    private $database;
    private $username;
    private $password;
    private $servername;
    private $charset;

    protected function connect() {
        // set Properties
        $this->servername = "Localhost";
        $this->database = "kasse";
        $this->username = "root";
        $this->password = "";
        $this->charset = "utf8mb4";

        // create Connection
        try {
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->database.";charset=".$this->charset;
            $pdo = new PDO($dsn, $this->username, $this->password);
            // Return Einstellung: In diesem Fall assoziatives Array
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // ErrorSettings
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            // Return false, falls Fehlermeldung, mit der Fehlermeldung
            return [false => $e->getMessage()];
        }



    }
}
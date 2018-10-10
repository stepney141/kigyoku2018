<?php

class GyokuwebDB extends PDO
{
    public static function Instance()
    {
        static $pdo = null;
        if ($pdo === null) {
            try {
                $pdo = new static();
            } catch (PDOException $e) {
                echo "Failed to connect to the database.";
            }
        }
        return $pdo;
    }

    private function __construct($file = "db.ini")
    {
        if (!$settings = parse_ini_file($file, true)) {
            throw new RuntimeException("Unable to open " . $file . ".");
        }

        $db = $settings["database"];

        $opt = function ($key, $name = null) use ($db) {
            return !empty($db[$key]) ? (";" . ($name ?? $key) . "=" . $db[$key]) : "";
        };
        
        $dsn = $db["driver"] . ":host=" . $db["host"]
            . $opt("port")
            . $opt("schema", "dbname")
            . $opt("charset");

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        parent::__construct($dsn, $db["username"], $db["password"], $options);
    }
}

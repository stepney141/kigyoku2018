<?php
function f()
{
    $db = [
        "driver" => "mysql",
        "host" => "mysql636.db.sakura.ne.jp",
        "schema" => "gyokuweb_2018",
        "username" => "gyokuweb",
        "password" => "kigyokusai2015"
    ];
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

    //$pdo = new PDO($dsn, $db["username"], $db["password"], $options);
}
echo "Hello";
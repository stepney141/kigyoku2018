<?php

include "dbconn.php";

$jsonstr = file_get_contents("posts.json");
                  
$json = json_decode($jsonstr, true);
$entries = $json["entries"];

$json = [
    "entries" => $entries
];

$pdo = GyokuwebDB::Instance();

$sth = $pdo->prepare('INSERT INTO blog (time, caption, markdown, html, author) VALUES (:time, :caption, :markdown, :html, :author);');

foreach ($entries as $entry) {
    $sth->execute([
        ':time' => (new DateTime($entry["date"]))->format("Y-m-d H:i:s"),
        ':caption' => $entry["title"],
        ':markdown' => $entry["content"]["markdown"],
        ':html' => $entry["content"]["html"],
        ':author' => $entry["author"],
    ]);
}

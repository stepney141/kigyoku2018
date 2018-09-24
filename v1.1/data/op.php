<?php
$jsonstr = file_get_contents("posts.json");
                  
$json = json_decode($jsonstr, true);
$entries = $json["entries"];

$json = [
    "entries" => $entries
];

$jsonstr = json_encode($json, JSON_UNESCAPED_UNICODE);
file_put_contents("posts_new.json", $jsonstr);

echo $jsonstr;
/*
$pat = 'img src=\\\"([^\"]*)\\"';
$rep = 'img src=\"blog/images/$1\"';
*/
?>
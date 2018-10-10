<?php

include_once "dbconn.php";

$file = new SplFileObject("groupsdb.csv");
$file->setFlags(SplFileObject::READ_CSV);

$column = $file->current();
$file->next();

while ($file->valid()) {
    $line = $file->current();
    if (!is_null($line[0])) {
        $record = [];
        foreach ($line as $i => $value) {
            if ($column[$i] === "") {
                continue;
            }
            $record[$column[$i]] = $value;
        }
        $records[] = $record;
    }
    $file->next();
}

$keys = [
    "企画名" => ":name",
    "団体名" => ":groupname",
    "教室" => ":location",
    "紹介文" => ":summary",
    "@画像" => ":thumbimg",
    "企画名ふりがな" => ":name_furigana",
    "団体名ふりがな" => ":groupname_furigana"
];

$buildings = [
    "#一号館" => 'bd1',
    "#二号館" => 'bd2',
    "#三号館" => 'bd3',
    "#四号館" => 'bd4',
    "#校庭" => 'yd'
];

$categories = [
    "#受験生向け" => 'academic',
    "#アクティビティ" => 'activity',
    "#文化系企画" => 'display_literature',
    "#理科系企画" => 'display_science',
    "#動画" => 'video',
    "#音楽" => 'music',
    "#パフォーマンス" => 'performance',
    "#試合観戦" => 'game_watching',
    "#飲食" => 'foods',
    "#購買" => 'purchase',
];

$maplist = [];

foreach ($records as $record) {
    $map = [];
    $bs = [];
    $cs = [];
    foreach ($record as $key => $value) {
        if ($key[0] === "#") {
            if ($value === "TRUE") {
                if (isset($buildings[$key])) {
                    $bs[] = $buildings[$key];
                } else if (isset($categories[$key])) {
                    $cs[] = $categories[$key];
                }
            }
        } else {
            $map[$keys[$key]] = $value;
        }
    }
    $map[':building'] = implode(',', $bs);
    $map[':category'] = implode(',', $cs);
    $maplist[] = $map;
}

$pdo = GyokuwebDB::Instance();

$sth = $pdo->prepare("
    INSERT INTO exhibits
        (name, groupname, building, location, summary, category, thumbimg, name_furigana, groupname_furigana) VALUES
        (:name, :groupname, :building, :location, :summary, :category, :thumbimg, :name_furigana, :groupname_furigana);
        ");

foreach ($maplist as $map) {
    $sth->execute($map);
}

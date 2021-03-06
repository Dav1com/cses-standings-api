<?php

$mysql_host = '';
$mysql_user = '';
$mysql_pass = '';
$mysql_db = '';

header('Content-type: application/json');
header('Cache-Control: public, max-age=270, inmutable');
header('Access-Control-Allow-Origin: *');

$mysql = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

if ($mysql->errno) {
    echo '{"error":"MySQL connection error"}';
    exit;
}

$sql = "SELECT * FROM `cses_cache`";
$result = $mysql->query($sql);

if (!$result) {
    echo '{"error":"MySQL query error"}';
    exit;
}

$json = array();

while ($row = $result->fetch_assoc()) {
    $json[$row['Id']] = json_decode($row['Response']);
}

echo json_encode($json);

$mysql->close();

<?php

require './scrapper.php';
require './cses-get-ids.php';

$mysql_host = '';
$mysql_user = '';
$mysql_pass = '';
$mysql_db = '';

$mysql = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

foreach (getIds() as $id) {    
    $result = getUserTasks($id);
    $json = json_encode($result);
    $sql = "INSERT INTO `cses_cache` VALUES ($id, '$json') ON DUPLICATE KEY UPDATE Response = '$json'";
    $mysql->query($sql);
    sleep(1);
}

$mysql->close();

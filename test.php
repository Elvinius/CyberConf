<?php


$dsn = "mysql:host=127.0.0.1;dbname=cyberconf";
$user = "app_user";
$passwd = "eCHBgnV5GVIKAZ1h";

$pdo = new PDO($dsn, $user, $passwd);

$stm = $pdo->query("SELECT * FROM occupation");

$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {

    printf("{$row['id']} {$row['name']} \n");
}
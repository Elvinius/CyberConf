<?php


$dsn = "mysql:host=localhost;dbname=cyberconf";
$user = "app_user";
$passwd = "eCHBgnV5GVIKAZ1h";

$pdo = new PDO($dsn, $user, $passwd);

$stm = $pdo->query("SELECT * FROM county");

$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {

    printf("{$row['id']} {$row['name']} \n");
}
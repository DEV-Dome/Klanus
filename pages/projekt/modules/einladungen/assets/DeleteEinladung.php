<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";

$id = intval(xss_clean($_POST["id"]), 10);

$sth = $pdo->prepare("DELETE FROM projekt_einladungen WHERE  ID = ?");
$sth->bindParam(1, $id);
$sth->execute();

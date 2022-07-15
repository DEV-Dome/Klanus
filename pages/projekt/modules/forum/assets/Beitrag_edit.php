<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$name = trim(xss_clean($_POST["name"]));
$pinned = trim(xss_clean($_POST["pinned"]));
$bid = trim(xss_clean($_POST["bid"]));

$rang = new Rang($_SESSION['Rang'], $pdo);
$prang = new projektRang($_SESSION['PRang'], $pdo);

$int_pinned = 0;
if($pinned) $int_pinned = 1;

$sqlstr = "UPDATE projekt_forum_beitrage SET IsAngepinnt = ?, Name = ? WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $int_pinned);
$sth->bindParam(2, $name);
$sth->bindParam(3, $bid);
$sth->execute();

echo "Beitrag edit";

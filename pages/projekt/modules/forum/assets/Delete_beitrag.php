<?php
session_start();

include "../../../../../php/sicherheit/XSS.php";
include "../../../../../php/sql/connection.php";
include "../../../../../php/rang/Rang.php";
include "../../rang/projektRang.php";

$bid = trim(xss_clean($_POST["bid"]));

$sqlstr = "UPDATE projekt_forum_beitrage SET Status = 3 WHERE ID = ?";
$sth = $pdo->prepare($sqlstr);
$sth->bindParam(1, $bid);
$sth->execute();

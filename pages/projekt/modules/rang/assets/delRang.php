<?php
session_start();
$id = $_GET["id"];

include "../../../../../php/sql/connection.php";

$pdo->query("DELETE FROM projekt_rang_permission_syc WHERE Rang = " . $id);
$pdo->query("DELETE FROM projekt_rang WHERE ID = " . $id);

echo "Rang gelöscht";
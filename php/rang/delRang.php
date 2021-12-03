<?php
session_start();
$id = $_GET["id"];

include "../sql/connection.php";

$pdo->query("DELETE FROM rang_permission_syc WHERE Rang = " . $id);
$pdo->query("DELETE FROM rang WHERE ID = " . $id);

echo "Rang gelöscht";
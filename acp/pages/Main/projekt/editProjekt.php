<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

$overPath = "../";
if(!isset($_SESSION["Login"]) || !isset($_GET["id"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}
include_once "../../../../php/sql/connection.php";
include_once "../../../../php/rang/rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("projekt.edit")){
    exit("not permission");
}
$id = $_GET["id"];

$sth = $pdo->prepare("SELECT * FROM projekt WHERE ID = ?");
$sth->bindParam(1, $id);
$sth->execute();

$name = "";
$kurzel = "";
$desc = "";
$status = -1;

foreach($sth->fetchAll() as $row) {
    $name = $row["Name"];
    $kurzel = $row["Kurzel"];
    $desc = $row["Beschreibung"];

    $status = $row["Status"];
}


?>

<link href="css/Projekt/projektErstellen.css" rel="stylesheet">

<div class="headline_conatiner" >
    Projekt bearbeiten
</div>

<div class="page_main page_main_scroll_hidden" >
    <input oninput="setNewProjektName(this.value, <?php echo $id?>)" value="<?php echo $name; ?>" type="text" placeholder="Name" id="name" class="input_fild_normal">
    <input oninput="setNewProjektKurzel(this.value, <?php echo $id?>);" value="<?php echo $kurzel; ?>" type="text" placeholder="Kürzel" id="kurzel" class="input_fild_normal">

    <textarea oninput="setNewProjektBeschreibung(this.value, <?php echo $id?>);" id="beschreibung" class="input_fild_normal input_fild_normal_textarea" rows="4" placeholder="Beschreibung"><?php echo $desc; ?></textarea>

    <select onchange="setNewProjektStatus(this.value, <?php echo $id?>);" id="projektType" class="input_fild_half">
        <?php
        $sth = $pdo->prepare("SELECT * FROM projekt_status WHERE IsDisabled != 1");
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            if($row["ID"] == $status){
                echo "<option selected value='".$row["ID"]."'>".$row["Name"]."</option>";
            }else {
                echo "<option value='".$row["ID"]."'>".$row["Name"]."</option>";
            }
        }
        ?>
    </select>

   <!-- <button onclick="newProjeckt(document.getElementById('name').value, document.getElementById('kurzel').value, document.getElementById('beschreibung').value, document.getElementById('projektType').value)" class="buttonCrate">Projekt Erstellen</button> -->

    <div id="feedback_hub" class="feedback_hub">Feedback</div>
</div>
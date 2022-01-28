<?php
session_start();

$overPath = "../../../../";
if(!isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "../index.php";
    </script>
    <?php
    exit();
}

// rang
include_once "../../../../php/sql/connection.php";
include_once "../../../../php/rang/rang.php";
$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("rang.edit")){
    exit("not permission");
}

$id =  $_POST["id"];

$sth = $pdo->prepare("SELECT user.name as 'u-name',Email  FROM user,rang WHERE user.Rang = rang.ID AND user.ID = ?");
$sth->bindParam(1, $id);
$sth->execute();

$name = "";
$email = "";

foreach($sth->fetchAll() as $row) {
    $name = $row["u-name"];
    $email = $row["Email"];
}

?>
<link href="css/User/User.css" rel="stylesheet">
<link href="css/User/User_handy.css" rel="stylesheet">
<link href="css/User/user_tablet.css" rel="stylesheet">

<div class="headline_conatiner" >
    User Bearbeiten
</div>

<div class="page_main" >
    <input value="<?php echo $name ?>" type="text" placeholder="Name" id="name" class="input_fild_normal">

    <input value="<?php echo $email ?>" type="text" placeholder="Email" id="email" class="input_fild_normal">

    <input  type="password" placeholder="password" id="pw" class="input_fild_half">
    <input  type="password" placeholder="password wiederholen" id="pww" class="input_fild_half">

    <select class="input_fild_half">
        <option>Rang 1</option>
        <option>Rang 2</option>
        <option>Rang 3</option>
    </select>

    <div class="input_fild_checkbox_holder">AGB <input class="input_fild_checkbox" type="checkbox"></div>


</div>

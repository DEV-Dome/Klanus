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
//
//Permission abfrage!
?>
<link href="css/User/User.css" rel="stylesheet">
<link href="css/User/User_handy.css" rel="stylesheet">
    <div class="headline_conatiner">
        User
    </div>

    <div class="page_main" >
        <?php
        $sth = $pdo->prepare("SELECT * FROM User ORDER BY ID");
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            $userRang = new Rang($row["Rang"], $pdo);
            echo "<div class='conatiner_user'>";
                $loadPgClasses = "userListeBild";
                $loadPgOnClick = "";
                $outputpfad = "../";
                $bid =  intval($row["ID"], 10);
                include "../../../../php/user/get/UserImage.php";
                ?>

            <iii class="userListName" ><?php echo $row["Name"]?></iii>

            <button  class="button userEditButton"><i class="bi bi-pencil"></i></button>
            <button  class="button userBlockButton"><i class="bi bi-slash-circle"></i></button>
            <button  class="button userBlockButton"><i class="bi bi-x-circle"></i></button>
            <button  class="button userMessageButton"><i class="bi bi-chat-dots"></i></button>

            <button class="userUbersichtRang" style="background-color: <?php echo $userRang->bgColor?>;color: <?php echo $userRang->color?>;"><?php echo $userRang->name . "<br/>"; ?></button>
        </div>
        <?php
        }

        ?>
    </div>

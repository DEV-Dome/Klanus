<?php
session_start();
error_reporting(E_ALL);


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
include "../../../../php/sql/connection.php";
include "../../../../php/rang/Rang.php";

$rang = new Rang($_SESSION['Rang'], $pdo);
if(!$rang->hasPermission("user.overview")){
    exit("not permission");
}

?>
<link href="css/user/user.css" rel="stylesheet">
<link href="css/user/user_handy.css" rel="stylesheet">
<link href="css/user/user_tablet.css" rel="stylesheet">

    <div class="headline_conatiner">
        User
    </div>

    <div class="page_main" >
        <?php
        $sth = $pdo->prepare("SELECT * FROM user ORDER BY ID");
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

            <iii class="userListName" ><?php echo substr($row["Name"], 0, 18);  if(strlen($row["Name"]) >= 19) echo " [...]"; ?></iii>

            <div class="conatiner_button" style="">
                <button onclick="loadMainPage('user/userEdit.php', '<?php echo $row["ID"]; ?>')" class="button userEditButton"><i class="bi bi-pencil"></i></button>
                <button  class="button userBlockButton"><i class="bi bi-slash-circle"></i></button>
                <button  class="button userBlockButton"><i class="bi bi-x-circle"></i></button>
                <button  class="button userMessageButton"><i class="bi bi-chat-dots"></i></button>
            </div>


            <button class="userUbersichtRang" style="background-color: <?php echo $userRang->bgColor?>;color: <?php echo $userRang->color?>;"><?php echo $userRang->name . "<br/>"; ?></button>
        </div>
        <?php
        }

        ?>
    </div>

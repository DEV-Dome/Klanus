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
    <div class="headline_conatiner">
        User
    </div>

    <div class="page_main" >
        <?php
        $sth = $pdo->prepare("SELECT * FROM User ORDER BY ID");
        $sth->execute();

        foreach($sth->fetchAll() as $row) {
            $userRang = new Rang($row["Rang"], $pdo);
            ?>
            <div class="container columMainbereich">
                <div class="row">
                    <div class="col">
                        <?php
                        $loadPgClasses = "userListeBild";
                        $loadPgOnClick = "";
                        $outputpfad = "../";
                        $bid =  intval($row["ID"], 10);
                        include "../../../../php/user/get/UserImage.php";
                        ?>

                        <span class="userListName" ><?php echo $row["Name"]?></span>
                    </div>
                    <div class="col">
                        <button class="userUbersichtRang" style="background-color: <?php echo $userRang->bgColor?>;color: <?php echo $userRang->color?>;"><?php echo $userRang->name . "<br/>"; ?></button>
                    </div>
                    <div class="col">
                        <button  class="button userEditButton"><i class="bi bi-pencil"></i></button>
                        <button  class="button userBlockButton"><i class="bi bi-slash-circle"></i></button>
                        <button  class="button userBlockButton"><i class="bi bi-x-circle"></i></button>
                        <button  class="button userMessageButton"><i class="bi bi-chat-dots"></i></button>
                    </div>
                </div>
            </div>

      <!--  <div class="rangUbersichtConatiner">
            <i class="userNameDisplay"></i>


        </div> -->
        <?php
        }

        ?>
    </div>

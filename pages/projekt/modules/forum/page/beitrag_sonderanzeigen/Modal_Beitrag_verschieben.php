<div id="Modal_beitrag_verschieben" class="modal" style="display: none;">
    <div id="modal-content_kommentar" class="modal-content">
        <span class="close">&times;</span>

        <p class="modal_headline">Beitrag Verschieben:</p>

        <select class="input_fild_normal">
            <?php
            $sqlstr = "SELECT projekt_forum_forn.Name AS 'fName' FROM projekt_forum_forn,projekt_forum_kategorien WHERE kategorien = projekt_forum_kategorien.ID AND Projekt = ?";
            $sth = $pdo->prepare($sqlstr);
            $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
            $sth->execute();
            foreach($sth->fetchAll() as $row) {
                echo '<option>'.$row["fName"].'</option>';
            }
            ?>
        </select>

        <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub_kommentar">Feedback</div>

        <div class="modal_button_conatiner">
            <button onclick="Mede_kommentar()" class="button modal_button button_grun">Beitrag verschieben</button>
        </div>
    </div>
</div>
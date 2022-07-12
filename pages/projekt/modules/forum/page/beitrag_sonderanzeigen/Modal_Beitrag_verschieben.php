<div id="Modal_beitrag_verschieben" class="modal" style="display: none;">
    <div id="modal-content_kommentar" class="modal-content">
        <span class="close">&times;</span>

        <p class="modal_headline">Beitrag Verschieben:</p>

        <select id="Beitrag_move_select" class="input_fild_normal">
            <?php
            $select = "projekt_forum_forn.Name AS 'fName',projekt_forum_kategorien.Name AS 'kName',projekt_forum_forn.ID AS 'fid', ";
            $select .= "KannSehen";

            $sqlstr  = "SELECT $select FROM projekt_forum_forn,projekt_forum_kategorien WHERE kategorien = projekt_forum_kategorien.ID AND Projekt = ?";
            $sqlstr .= "ORDER BY projekt_forum_kategorien.prioritat, projekt_forum_forn.prioritat";

            $sth = $pdo->prepare($sqlstr);
            $sth->bindParam(1, $_SESSION["projekt.aktiv"]);
            $sth->execute();

            $lastgoup = "";
            foreach($sth->fetchAll() as $row) {
                //abfrage ob das Forum gesehen werden darf ...
                $skip = false;

                $sqlstr1 = "SELECT * FROM projekt_rang WHERE  ID = ?";
                $sth1 = $pdo->prepare($sqlstr1);
                $sth1->bindParam(1, $row["KannSehen"]);
                $sth1->execute();
                foreach($sth1->fetchAll() as $row1) {
                    if($prang->prioritat >= $row1["Prioritat"]){
                        $skip = false;
                    }else {
                        $skip = true;
                    }
                }
                if($skip) continue;


                //drastellen des Selectes
                if($lastgoup != $row["kName"]){
                    if($lastgoup = ""){
                        echo "<optgroup label='". $row["kName"] ."'>";
                    }else {
                        echo "</optgroup>";
                        echo "<optgroup label='". $row["kName"] ."'>";
                    }
                }
                if($row["fid"] == $fid){
                    echo '<option disabled selected value="-1">'.$row["fName"].'</option>';
                }else {
                    echo '<option value="'.$row["fid"].'">'.$row["fName"].'</option>';
                }
                $lastgoup = $row["kName"];
            }
            echo "</optgroup>";
            ?>
        </select>

        <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub_kommentar">Feedback</div>

        <div class="modal_button_conatiner">
            <button onclick="Beitrag_move(document.getElementById('Beitrag_move_select').value , <?php echo $bid ?>)" class="button modal_button button_grun">Beitrag verschieben</button>
        </div>
    </div>
</div>
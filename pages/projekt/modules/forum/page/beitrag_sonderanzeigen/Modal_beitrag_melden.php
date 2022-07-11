<div id="myModal" class="modal" style="display: none;">
    <div id="modal-content" class="modal-content">
        <span class="close">&times;</span>


        <p class="modal_headline">Beitrag Melden:</p>

        <div id="edtior_melden_beitrag">
            <?php
            if($grund != ""){
                echo $grund;
            }else {
                echo "<p>Wieso muss dieser Beitrag entfernt werden ?</p>";
            }
            ?>
        </div>

        <div class="feedback_hub" style="margin-top: 1%!important; margin-bottom: 1%; width: 92% !important;" id="feedback_hub">Feedback</div>

        <?php
        if(!$beitrag_gemeldet) {
            ?>
            <div class="modal_button_conatiner">
                <button onclick="Mede_beitrag(<?php echo $bid; ?>)" class="button modal_button button_grun">Beitrag Melden</button>
            </div>
            <?php
        }else  {
            ?>
            <div class="modal_button_conatiner">
                <p class="">Du hast disen Beitrag schon gemeldt!</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
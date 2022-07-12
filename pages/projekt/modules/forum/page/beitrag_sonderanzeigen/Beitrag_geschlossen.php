<div class="beitrag_verwalter">
    <div style="text-align: center; width: 100%!important;" class="beitrag_abzeige_conatiner beitrag_abzeige_conatiner_beitraginfo">
        <i class="bi bi-lock"></i>
        Der Beitrag wurde am <b><?php echo $dt_erstellt_am->format("d.m.Y") ?></b> um <b><?php echo $dt_erstellt_am->format("H:i") ?></b> Uhr von <span style="color: <?php echo $row["Color"]; ?>"><?php echo utf8_encode(ucfirst($row["uname"])) ?></span> geschlossen
    </div>
</div>
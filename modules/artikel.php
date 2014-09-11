<div class="row">
    <div class="large-12 columns">
        <div class="panel radius">
            <h3>Artikelumsatzliste</h3>
            <p>
                Sie sehe hier vier verschiedene Listen. Die erste zeigt die zehn Umsatzstärksten Artikel des Monats, die
                zweite die zehn Umsatzschwächsten des aktuellen Monats.<br />
                Die Die dritte und vierte sind gleich aufgebaut nur dass die Zeitspanne dabei ein ganzes Jahr bzw. 12
                Monate beträgt.<br>
                <b>Sie müssen über die nötigen Berechtigungen verfügen um alles zu sehen!</b>
            </p>
        </div>
        <?php
        if($_SESSION['userrole'] != 3) die(printError("Sie haben keine berechtigungen für diese Seite!"));
        ?>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>10 Umsatzstärkste des Monats</h3>
        <?php
        $stmt = $db->query("SELECT * FROM v_artikelumsatz_month_top");
        if(!$stmt)
            printError("Die View 'v_artikelumsatz_month_top' existiert nicht!");
        else
            getTableFromStmt($stmt);
        ?>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>10 Umsatzschwächste des Monats</h3>
        <?php
        $stmt = $db->query("SELECT * FROM v_artikelumsatz_month_flop");
        if(!$stmt)
            printError("Die View 'v_artikelumsatz_month_flop' existiert nicht!");
        else
            getTableFromStmt($stmt);
        ?>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>10 Umsatzstärkste des Jahres</h3>
        <?php
        $stmt = $db->query("SELECT * FROM v_artikelumsatz_year_top");
        if(!$stmt)
            printError("Die View 'v_artikelumsatz_year_top' existiert nicht!");
        else
            getTableFromStmt($stmt);
        ?>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>10 Umsatzschwächste des Jahres</h3>
        <?php
        $stmt = $db->query("SELECT * FROM v_artikelumsatz_year_flop");
        if(!$stmt)
            printError("Die View 'v_artikelumsatz_year_flop' existiert nicht!");
        else
            getTableFromStmt($stmt);
        ?>
    </div>
</div>


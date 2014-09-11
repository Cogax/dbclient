<div class="row">
    <div class="large-12 columns">
        <div class="panel radius">
            <h3>Buchhaltung</h3>
            <p>
                Sie sehen hier alle Mitarbeiter und die dazugehörigen Daten. Unter anderem wird
                auch der Lohn des Mitarbeiter angezeigt.<br>
                <b>Sie sehen jeweils nur die Daten, auf welche Sie Berechtigungen haben!</b>
            </p>
        </div>
    </div>
</div>

<?php
if($_SESSION['userrole'] == 1):
    // Mitarbeiter
?>
    <div class="row">
        <div class="large-12 columns">
            <h3>Ausgestellte Lohnabrechnungen</h3>
            <?php
            $stmt = $db->query("SELECT * FROM v_lohnabrechnung_mitarbeiter");
            if(!$stmt)
                printError("Die View 'v_Lohnabrechnung_mitarbeiter' existiert nicht!");
            else
                getTableFromStmt($stmt);
            ?>
        </div>
    </div>
<?php
endif;
?>

<?php
if($_SESSION['userrole'] == 2):
    // Abteilungsleiter
    ?>
    <div class="row">
        <div class="large-12 columns">
            <h3>Daten pro Abteilung</h3>
            <?php
            $stmt = $db->query("SELECT * FROM v_lohnabrechnung_abteilung");
            if(!$stmt)
                printError("Die View 'v_Lohnabrechnung_mitarbeiter' existiert nicht!");
            else
                getTableFromStmt($stmt);
            ?>
        </div>
    </div>
<?php
endif;
?>

<?php
if($_SESSION['userrole'] == 3):
    // Führer
    ?>
    <div class="row">
        <div class="large-12 columns">
            <h3>Detaildaten</h3>
            <?php
            $stmt = $db->query("SELECT * FROM v_lohnabrechnung_total");
            if(!$stmt)
                printError("Die View 'v_Lohnabrechnung_mitarbeiter' existiert nicht!");
            else
                getTableFromStmt($stmt);
            ?>
        </div>
    </div>
<?php
endif;
?>
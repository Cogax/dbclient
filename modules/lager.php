<div class="row">
    <div class="large-12 columns">
        <div class="panel radius">
            <h3>Lager</h3>
            <p>
                Sie haben hier die Möglichkeit eine Lieferantenbestellung (für das Lager) zu erfassen<br>
                <b>Sie müssen über die nötigen Berechtigungen verfügen um alles zu sehen!</b>
            </p>
        </div>
        <?php
        //if($_SESSION['userrole'] != 3) die(printError("Sie haben keine berechtigungen für diese Seite!"));
        ?>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <h3>Einfache Lieferantenbestellung erfassen</h3>
        <?php printInfo('Es werden nur Artikel angezeigt, welche auch einem Lieferanten zugeordnet sind und im Lager geführt werden!'); ?>
        <div class="row">
            <div class="large-8 small-8 columns">
                <form enctype="multipart/form-data" action="" method="POST">
                    <div class="row collapse">
                        <div class="small-6 large-6 columns">
                            <select name="artikel">
                                <?php
                                $sql =
                                    "SELECT
                                        id,
                                        bezeichnung,
                                        nummer
                                    FROM
                                        artikel
                                    where 
                                        lager = 1
                                    AND 
                                        id in (SELECT distinct artikelId FROM lieferantArtikel);";
                                $stmt = $db->query($sql);
                                if(!$stmt)
                                    printError("Fehler bei den Tabellenangaben!");
                                else {
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row["id"].'">'.$row["bezeichnung"].' ('.$row['nummer'].')</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="small-3 large-3 columns">
                            <input type="number" name="menge" placeholder="Menge" />
                        </div>
                        <div class="small-3 large-3 columns">
                            <input type="submit" name="erfassen" value="Bestellen" class="button postfix" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if(isset($_POST['erfassen'])) {

            // Bestellung erfassen
            $sql = "call lieferantenbestellung(?, ?);";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1, (int)$_POST['artikel'], PDO::PARAM_INT);
            $stmt->bindValue(2, (int)$_POST['menge'], PDO::PARAM_INT);
            $stmt->execute();
            if(!$stmt)
                printError("Die Prozedur 'lieferantenbestellung' besteht nicht!");
            else
                printSuccess("Die Bestellung wurde erfasst!");
        }
        ?>
    </div>
</div>
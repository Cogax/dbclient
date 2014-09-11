<div class="row">
    <div class="large-12 columns">
        <div class="panel radius">
            <h3>Lieferantenbestellungen</h3>
            <p>
                Sie sehen hier alle Lieferantenbestellungen. Es kann auch nach einzelnen
                LIeferanten gesucht werden.<br>
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
        <h3>Bestellungen nach Lieferant</h3>
        <div class="row">
            <div class="large-4 small-4 columns">
                <form enctype="multipart/form-data" action="" method="POST">
                    <div class="row collapse">
                        <div class="small-8 large-9 columns">
                            <select name="lieferant">
                                <option value="all" <?php print (!isset($_POST["lieferant"]) ? "selected" : ""); ?>>Alle</option>
                                <?php
                                $sql =
                                    "SELECT
                                        a.id as id,
                                        b.name as name
                                    FROM
                                        lieferant a,
                                        kontakt b
                                    WHERE
                                      a.id = b.id;";
                                $stmt = $db->query($sql);
                                if(!$stmt)
                                    printError("Fehler bei den Tabellenangaben!");
                                else {
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.$row["id"].'" '.((isset($_POST["lieferant"]) && $_POST["lieferant"] == $row["id"]) ? "selected" : "").'>'.$row["name"].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 large-3 columns">
                            <input type="submit" class="button postfix" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if(isset($_POST['lieferant'])) {
            $sql =
                "SELECT
                    a.id,
                    a.nummer,
                    a.datum,
                    d.name as lieferant
                FROM
                    belegkopf a,
                    einkaufBelegkopf b,
                    lieferant c,
                    kontakt d
                WHERE
                    b.id = a.id
                AND
                    c.id = b.lieferantid
                AND
                    d.id = c.id";

            if($_POST['lieferant'] != 'all') {
                $sql .= " AND c.id =?";
            }
            $sql .= ";";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_POST['lieferant']));
            if(!$stmt)
                printError("Fehler bei den Tabellenangaben!");
            else
                getTableFromStmt($stmt);
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <h3>Alle Lieferantenbestellungen</h3>
        <?php
        $sql =
            "SELECT
                a.id,
                a.nummer,
                a.datum,
                d.name as lieferant
            FROM
                belegkopf a,
                einkaufBelegkopf b,
                lieferant c,
                kontakt d
            WHERE
                b.id = a.id
            AND
                c.id = b.lieferantid
            AND
                d.id = c.id;";
        $stmt = $db->query($sql);
        if(!$stmt)
            printError("Fehler bei den Tabellenangaben!");
        else
            getTableFromStmt($stmt);
        ?>
    </div>
</div>
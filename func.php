<?php
function printError($msg) {
    echo
        '<div data-alert class="alert-box alert radius">
            '.$msg.'
        </div>';
}

function printSuccess($msg) {
    echo
        '<div data-alert class="alert-box success radius">
            '.$msg.'
        </div>';
}

function printInfo($msg) {
    echo
        '<div data-alert class="alert-box info radius">
            '.$msg.'
            <a href="#" class="close">&times;</a>
        </div>';
}

function getTableFromStmt($stmt) {
    global $db;
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($results) == 0) {
        printError("Keine Einträge vorhanden");
        return false;
    }

    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    foreach($results[0] as $key => $val) {
        echo '<th>'.$key.'</th>';
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach($results as $arr) {
        echo '<tr>';
        foreach($arr as $val) {
            echo '<td>'.$val.'</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
?>
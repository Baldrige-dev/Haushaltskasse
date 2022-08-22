<?php
require_once "includes/main.inc.php";
if(isset($_GET['c'])) {
    $typeForm = Array(0 => "Gutschrift", 1 => "Abbuchung");
    $selectedType = $controller->changeData[0]['Art'];

    $katForm = Array(1 => "Gehalt", 2 => "Miete", 3 => "Strom", 4 => "KFZ", 5 => "Versicherung", 6 => "Staat", 7 => "Medien", 8 => "Spass", 9 => "Sonstiges");
    $selectedKat = $controller->changeData[0]['KID'];
    ?>

    <div id="change" class="modal">
        <form class="modal-content" action="kasse.php" method="post">
            <br>
            <div class="div-modal">
                <p><b>Hier können Sie die bestehende Buchung anpassen:</b></p>
                <p>Bitte ändern Sie die entsprechenden Daten vor der Buchung ab.</p>
            </div>
            <br>
            <div class="div-modal">
                <input type="hidden" name="formid" value="change">
                <input type="hidden" name="id" value="<?php echo $controller->changeData[0]['ID'];?>>">
                <label for="date"><b>Buchungstag:</b></label>
                <input type="date" placeholder="Buchungstag" name="date" value="<?php echo $controller->changeData[0]['Datum'];?>" required>
                <br>
                <label for="type"><b>Gutschrift/Abbuchung:</b></label>
                <select id="type" name="type" required>
                    <?php
                    foreach($typeForm as $key => $val) {
                        echo "<option value=\"" . $key . "\"" . ($key == $selectedType ? " selected=\"selected\">" : ">") . $val . "</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="kat"><b>Kategorie:</b></label>
                <select id="kat" name="kat" required>
                    <?php
                    foreach($katForm as $key => $val) {
                        echo "<option value=\"" . $key . "\"" . ($key == $selectedKat ? " selected=\"selected\">" : ">") . $val . "</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="optional"><b>Nur für Sonstiges als Freitext:</b></label><br>
                <input type="text" placeholder="Sonstiges" name="optional" value="<?php echo ($selectedKat == 9  ? $controller->changeData[0]['Freitext'] : ""); ?>">
                <br>
                <label for="betrag"><b>Betrag:</b></label>
                <input type="number" min="0.00" max="1000000.00" step="0.01" name="betrag" value="<?php echo $controller->changeData[0]['Betrag'];?>" required>
                <br>
                <input type="hidden" id="vorlage" name="vorlage" value="0">
                <input type="hidden" placeholder="Vorlagenname" name="bezeichnung">
                <br><br>
                <button type="submit" name="submit">Buchung ändern</button>
            </div>
            <br>
            <div class="div-modal">
                <button type="button" onclick="document.getElementById('buchung').style.display='none'" class="cancelbtn"><a href="kasse.php">Abbrechen</a></button>
            </div>
            <br>
        </form>
    </div>
<?php
}
?>
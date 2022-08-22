<?php
require_once "includes/main.inc.php";

$typeForm = Array(0 => "Gutschrift", 1 => "Abbuchung");
$selectedType = $controller->vorlagenData[0]['Art'];

$katForm = Array(1 => "Gehalt", 2 => "Miete", 3 => "Strom", 4 => "KFZ", 5 => "Versicherung", 6 => "Staat", 7 => "Medien", 8 => "Spass", 9 => "Sonstiges");
$selectedKat = $controller->vorlagenData[0]['KID'];

?>
<br>
<input type="hidden" name="formid" value="buchung">
<label for="date"><b>Buchungstag:</b></label>
<input type="date" placeholder="Buchungstag" name="date" required>
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
<input type="text" placeholder="Sonstiges" name="optional" value="<?php echo ($selectedKat == 9  ? $controller->vorlagenData[0]['Freitext'] : ""); ?>">
<br>
<label for="betrag"><b>Betrag:</b></label>
<input type="number" min="0.00" max="1000000.00" step="0.01" name="betrag" value="<?php echo $controller->vorlagenData[0]['Betrag'];?>" required>
<br>
<input type="hidden" id="vorlage" name="vorlage" value="0">
<input type="hidden" placeholder="Vorlagenname" name="bezeichnung">
<br><br>
<button type="submit" name="submit">Buchung erfassen</button>



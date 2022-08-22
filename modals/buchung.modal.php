<div id="buchung" class="modal">
    <form class="modal-content" action="kasse.php" method="post">
        <br>
        <div class="div-modal">
            <p><b>Eine neue Buchung erfassen:</b></p>
            <p>Hier können Sie eine neue Buchung erfassen. Insofern die Buchung als Vorlage gespeichert werden soll, setzen Sie bitte den Haken.</p>
        </div>
        <br>
        <div class="div-modal">
            <input type="hidden" name="formid" value="buchung">
            <label for="date"><b>Buchungstag:</b></label>
            <input type="date" placeholder="Buchungstag" name="date" required>
            <br>
            <label for="type"><b>Gutschrift/Abbuchung:</b></label>
            <select id="type" name="type" required>
                <option value="0">Gutschrift</option>
                <option value="1">Abbuchung</option>
            </select>
            <br>
            <label for="kat"><b>Kategorie:</b></label>
            <select id="kat" name="kat" required>
                <option value="1">Gehalt</option>
                <option value="2">Miete</option>
                <option value="3">Strom</option>
                <option value="4">KFZ</option>
                <option value="5">Versicherung</option>
                <option value="6">Staat</option>
                <option value="7">Medien</option>
                <option value="8">Spass</option>
                <option value="9">Sonstiges</option>
            </select>
            <br>
            <label for="optional"><b>Nur für Sonstiges als Freitext:</b></label><br>
            <input type="text" placeholder="Sonstiges" name="optional">
            <br>
            <label for="betrag"><b>Betrag:</b></label>
            <input type="number" min="0.00" max="1000000.00" step="0.01" placeholder="Betrag" name="betrag" required>
            <br>
            <input type="checkbox" id="vorlage" name="vorlage" value="1">
            <label for="vorlage"> Als Vorlage speichern? </label>
            <br>
            <label for="bezeichnung">Bitte Vorlagenbezeichnung angeben:</label><br>
            <input type="text" placeholder="Vorlagenname" name="bezeichnung">
            <br>
            <button type="submit" name="submit">Buchung speichern</button>
        </div>
        <br>
        <div class="div-modal">
            <button type="button" onclick="document.getElementById('buchung').style.display='none'" class="cancelbtn"><a href="kasse.php">Abbrechen</a></button>
        </div>
        <br>
    </form>
</div>
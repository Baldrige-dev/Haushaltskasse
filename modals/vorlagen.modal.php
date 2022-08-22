<div id="vorlagen" class="modal">
    <form class="modal-content" action="kasse.php?v=1" method="POST">
        <br>
        <div class="div-modal">
            <p><b>Bitte eine Vorlage wählen:</b></p>
            <p>Im Anschluss können Sie die Daten verändern falls nötig</p>
        </div>
        <br>
        <div class="div-modal">
            <input type="hidden" name="formid" value="vorlagen">
            <?php
            if(isset($_GET['v'])) {
                include_once "includes/vorlage.inc.php";
            } else {
                $pdo = new SQLM();
                $vorlagen = $pdo->selectAlleVorlagen()
                ?>
                <br>
                <label for="vor">Bitte Vorlage wählen:</label><br>
                <select id="vorlagen" name="vor" required>
                    <?php
                    foreach ($vorlagen as $row) {
                        echo "<option value=\"".$row['Verweis']."\">".$row['Bezeichnung']."</option>";
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit" name="submit">Vorlage wählen</button>
                <?php
            }
            ?>
        </div>
        <br>
        <div class="div-modal">
            <button type="button" onclick="document.getElementById('buchung').style.display='none'" class="cancelbtn"><a href="kasse.php">Abbrechen</a></button>
        </div>
        <br>
    </form>
</div>
<?php
include 'includes/main.inc.php';

// oeffne modal vorlagen falls $_GET
if(isset($_GET['v'])) { ?>
    <script>
        document.getElementById('vorlagen').style.display='block';
    </script>
<?php
}
if(isset($_GET['a'])) { ?>
    <script>
        document.getElementById('auswertung').style.display='block';
    </script>
    <?php
}
if(isset($_GET['c'])) { ?>
    <script>
        document.getElementById('change').style.display='block';
    </script>
    <?php
}
?>
            <br>
            <input class="searchInput" id="myInput" type="text" placeholder="...Tabellensuche...">
            <br>
            <br>
            <form  action="kasse.php" method="post">
                <input type="hidden" name="formid" value="filter">
                <label for="sdate"><b>Startdatum:</b></label>
                <input type="date" placeholder="Startdatum" name="sdate">
                <label for="edate"><b>Enddatum:</b></label>
                <input type="date" placeholder="Enddatum" name="edate">
                <button class="btn-filter" type="submit" name="submit">Daten filtern</button>
            </form>
            <br>
            <table style="text-align: center; border-color: black">
                <tr style="background-color: dimgrey; color: white">
                    <th>Datum</th>
                    <th>Art</th>
                    <th>Kategorie</th>
                    <th>Betrag</th>
                    <th></th>
                    <th></th>
                </tr>
                <tbody id="myTable">
                <?php
                // Ausgabe der gespeicherten Werte

                $pdo = new SQLM();
                $data = $pdo->selectAllWithKategorie();
                // Alle werte bis zum heutigen Tag werden zusammengerechnet
                $date_now = date("Y-m-d");
                $guthaben = 0;
                $guthaben2 = 0;
                foreach($data as $row) {
                    if($row['Art'] == 0){
                        $guthaben += $row['Betrag'];
                    } else {
                        $guthaben -= $row['Betrag'];
                    }
                    if($row['Datum'] <= $date_now) {
                        if($row['Art'] == 0){
                            $guthaben2 += $row['Betrag'];
                        } else {
                            $guthaben2 -= $row['Betrag'];
                        }
                    }
                }

                // $data wird für die Ausgabe in der Tabelle umgeschrieben den aktuellen Monat auszugeben.
                // Alternativ kann der Benutzer, dass Start und Enddatum verändern.
                if(isset($_POST['submit']) && $_POST['formid'] === "filter") {
                    if($_POST['sdate'] == "") {
                        $sdate = date('Y-m-01');
                    } else {
                        $sdate = $_POST['sdate'];
                    }
                    if($_POST['edate'] == "") {
                        $edate = date('Y-m-t');
                    } else {
                        $edate = $_POST['edate'];
                    }
                    $pdo = new SQLM();
                    $data = $pdo->selectAllWhereDataBetweenWithJoin($sdate, $edate);
                } else {
                    $sdate = date('Y-m-01');
                    $edate = date('Y-m-t');
                    $pdo = new SQLM();
                    $data = $pdo->selectAllWhereDataBetweenWithJoin($sdate, $edate);
                }

                // Ausgabe der Tabellendaten

                foreach($data as $row) {
                    if($row['Art'] == 0){
                        $art = "Gutschrift";
                        $style = "style='background-color: lightgreen'";
                        $vorzeichen = "";
                    } else {
                        $art = "Abbuchung";
                        $style = "style='background-color: red'";
                        $vorzeichen = "-";
                    }
                    echo "<tr $style>";
                    echo "<td>".$row['Datum']."</td>";
                    echo "<td>".$art."</td>";
                    echo "<td>".$row['Bezeichnung']."</td>";
                    echo "<td>".$vorzeichen.number_format($row['Betrag'], 2, '.', '')." €</td>";
                    echo "<td><a href=\"kasse.php?c=".$row['ID']."\">&#9998;</a></td>";
                    echo "<td><a href=\"kasse.php?d=".$row['ID']."\" onclick=\"return confirm('Damit wird der Eintrag gelöscht! Bitte bestätigen!?')\">X</a></td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <br>
            <table style="text-align: center; background-color: dimgrey; color: white; border-color: black">
                <tr>
                    <td><b>Guthaben nach Buchung aller Vormerkungen:</b></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b><?php echo $guthaben ?> €</b></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table style="text-align: center; background-color: dimgrey; color: white; border-color: black">
                <tr>
                    <td><b>Aktuelles Guthaben:</b></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b><?php echo $guthaben2 ?> €</b></td>
                    <td></td>
                </tr>
            </table>
            <br>
        </div>
        <br>
        <br>
        <div class="div-footer" style="background-color: dimgrey; color: white">
            <h3>&copy; Michael Frank 2022</h3>
        </div>
    </div>
    <!--<script scr="js/kasse.js"></script>-->
    </body>
</html>


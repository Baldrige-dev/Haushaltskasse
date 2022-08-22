<?php
require_once "includes/main.inc.php"
?>
<div id="auswertung" class="modal">
    <form class="modal-content" action="kasse.php?a=1" method="post">
        <br>
        <div class="div-modal">
            <p><b>Auswertung:</b></p>
            <p>Hier sehen Sie eine Auswertung Ihrer Einnahmen und Ausgaben.</p>
        </div>
        <br>
        <div class="div-modal">
            <br>
            <input type="hidden" name="formid" value="auswertung">
            <label for="sdate"><b>Startdatum:</b></label>
            <input type="date" placeholder="Startdatum" name="sdate" required>
            <br>
            <label for="edate"><b>Enddatum:</b></label>
            <input type="date" placeholder="Enddatum" name="edate" required>
            <br>
            <br>
            <button type="submit" name="submit">Auswertung starten</button>
            <br>
        </div>
        <br>
        <?php
        if(isset($_GET['a'])) {
            $color = array(
                "hotpink",
                "steelblue",
                "greenyellow",
                "orange",
                "powderblue",
                "tan",
                "silver",
                "aquamarine",
                "royalblue"
            );
        ?>
        <table>
            <thead style="background-color: beige;">
            <td><b>Beschreibung</b></td>
            <td><b>Einnahmen in €</b></td>
            <td><b>Einnahmen in %</b></td>
            <td><b>Ausgaben in €</b></td>
            <td><b>Ausgaben in %</b></td>
            </thead>
            <tbody>
            <?php
            for($i = 0; $i<10; $i++) {
                if($i == 9) {
                    echo "<tr style='background-color: beige'>";
                    echo "<td><b>".$controller->auswertungBeschreibung[$i]."</b></td>";
                    echo "<td><b>".number_format($controller->auswertungData[0][0][$i], 2, '.', '')." €</b></td>";
                    echo "<td><b>".number_format($controller->auswertungData[0][1][$i], 2, '.', '')." %</b></td>";
                    echo "<td><b>".number_format($controller->auswertungData[1][0][$i], 2, '.', '')." €</b></td>";
                    echo "<td><b>".number_format($controller->auswertungData[1][1][$i], 2, '.', '')." %</b></td>";
                } else {
                    echo "<tr style='background-color: $color[$i]'>";
                    echo "<td>".$controller->auswertungBeschreibung[$i]."</td>";
                    echo "<td>".number_format($controller->auswertungData[0][0][$i], 2, '.', '')." €</td>";
                    echo "<td>".number_format($controller->auswertungData[0][1][$i], 2, '.', '')." %</td>";
                    echo "<td>".number_format($controller->auswertungData[1][0][$i], 2, '.', '')." €</td>";
                    echo "<td>".number_format($controller->auswertungData[1][1][$i], 2, '.', '')." %</td>";
                }


                echo "</tr>";

            }
            ?>
            </tbody>
        </table>

        <br>
        <div class="div-modal">
            <div class="div-leg"><b>Einahmen</b></div>
            <div class="div-leg"><b>Ausgaben</b></div>
            <div class="pie-chart1"></div>
            <div class="pie-chart1"></div>
            <?php
            } else {
            ?>
            <div class="div-modal">
            <?php
            }
            ?>
            <br>
            <button type="button" onclick="document.getElementById('buchung').style.display='none'" class="cancelbtn"><a href="kasse.php">Abbrechen</a></button>
        </div>
        <br>
    </form>
</div>
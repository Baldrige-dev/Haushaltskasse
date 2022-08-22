<?php
class Contr {
    // Deklaration der verschiedenen Datencontainer für die Haushaltskasse
    public $auswertungBeschreibung = "";
    public $auswertungData = "";
    public $vorlagenData = "";
    public $changeData = "";

    // Hier wird geprüft welche Form ausgeführt wird.
    public function splitter() {
        if(isset($_POST['submit'])) {
            if($_POST['formid'] === "vorlagen") {
                $this->vorlagen($_POST['vor']);
            }
            if($_POST['formid'] === "auswertung") {
                $this->auswertung();
            }
            if($_POST['formid'] === "buchung") {
                $this->buchung();
            }
            if($_POST['formid'] === "change") {
                $this->changeData($_POST['id']);
            }
        }
        if(isset($_GET['c'])) {
            $this->change($_GET['c']);
        }
        if(isset($_GET['d'])) {
            $pdo = new SQLM();
            $pdo->deleteData($_GET['d']);
        }
    }

    public function change($id) {
        $pdo = new SQLM();
        $this->changeData = $pdo->selectDataWhereID($id);
    }

    public function changeData($id) {
        $date = trim($_POST['date']);
        $type = $_POST['type'];
        $kat = $_POST['kat'];
        $optional = trim($_POST['optional']);
        $betrag = trim($_POST['betrag']);

        if($kat != 9) {
            $optional = "NULL";
        }

        $pdo = new SQLM();
        $this->changeData = $pdo->updateData($date, $type, $kat, $betrag, $optional, $id);
    }
    public function vorlagen($id) {
        $pdo = new SQLM();
        $this->vorlagenData = $pdo->selectDataWhereID($id);
        echo "<script>";
        echo "document.getElementById('vorlagen').style.display='block'";
        echo "</script>";
    }

    public function buchung () {
        $date = trim($_POST['date']);
        $type = $_POST['type'];
        $kat = $_POST['kat'];
        $optional = trim($_POST['optional']);
        $betrag = trim($_POST['betrag']);
        $istVorlage = 0;
        $bezeichnung = "";

        if(isset($_POST['vorlage'])) {
            $istVorlage = $_POST['vorlage'];
            $bezeichnung = trim($_POST['bezeichnung']);
        }

        if($kat != 9) {
            $optional = "NULL";
        }

        $pdo = new SQLM();
        $pdo->newBuchung($date, $type, $kat, $betrag, $optional, $istVorlage, $bezeichnung);
    }

    public function auswertung() {
        $pdo = new SQLM();
        $data = $pdo->selectAllWhereDataBetween($_POST['sdate'], $_POST['edate']);
        // Deklaration der benötigen Variablen
        $gesamt1 = 0;
        $gesamt2 = 0;
        $gehalt1 = 0;
        $gehalt2 = 0;
        $miete1 = 0;
        $miete2 = 0;
        $strom1 = 0;
        $strom2 = 0;
        $kfz1 = 0;
        $kfz2 = 0;
        $versicherung1 = 0;
        $versicherung2 = 0;
        $staat1 = 0;
        $staat2 = 0;
        $medien1 = 0;
        $medien2 = 0;
        $spass1 = 0;
        $spass2 = 0;
        $sonstiges1 = 0;
        $sonstiges2 = 0;

        foreach($data as $row) {
            // Einnahmen:
            if($row['Art'] == 0) {
                // Gesamt
                $gesamt1 += $row['Betrag'];
                // Gehalt
                if($row['KID'] == 1) {
                    $gehalt1 += $row['Betrag'];
                }
                // Miete
                if($row['KID'] == 2) {
                    $miete1  += $row['Betrag'];
                }
                // Strom
                if($row['KID'] == 3) {
                    $strom1  += $row['Betrag'];
                }
                // KFZ
                if($row['KID'] == 4) {
                    $kfz1  += $row['Betrag'];
                }
                // Versicherung
                if($row['KID'] == 5) {
                    $versicherung1 += $row['Betrag'];
                }
                // Staat
                if($row['KID'] == 6) {
                    $staat1 += $row['Betrag'];
                }
                // Medien
                if($row['KID'] == 7) {
                    $medien1 += $row['Betrag'];
                }
                // Spass
                if($row['KID'] == 8) {
                    $spass1 += $row['Betrag'];
                }
                // Sonstiges
                if($row['KID'] == 9) {
                    $sonstiges1 += $row['Betrag'];
                }
            }
            // Ausgaben:
            if($row['Art'] == 1) {
                // Gesamt
                $gesamt2 += $row['Betrag'];
                // Gehalt
                if($row['KID'] == 1) {
                    $gehalt2 += $row['Betrag'];
                }
                // Miete
                if($row['KID'] == 2) {
                    $miete2 += $row['Betrag'];
                }
                // Strom
                if($row['KID'] == 3) {
                    $strom2  += $row['Betrag'];
                }
                // KFZ
                if($row['KID'] == 4) {
                    $kfz2 += $row['Betrag'];
                }
                // Versicherung
                if($row['KID'] == 5) {
                    $versicherung2 += $row['Betrag'];
                }
                // Staat
                if($row['KID'] == 6) {
                    $staat2 += $row['Betrag'];
                }
                // Medien
                if($row['KID'] == 7) {
                    $medien2 += $row['Betrag'];
                }
                // Spass
                if($row['KID'] == 8) {
                    $spass2 += $row['Betrag'];
                }
                // Sonstiges
                if($row['KID'] == 9) {
                    $sonstiges2 += $row['Betrag'];
                }
            }
        }
        // Berechnung Prozent
        $ges1Pro = 100;
        $gehalt1Pro = ($gesamt1 === 0) ? 0 : ($gehalt1*100)/$gesamt1 ;
        $miete1Pro = ($gesamt1 === 0) ? 0 : ($miete1*100)/$gesamt1;
        $strom1Pro = ($gesamt1 === 0) ? 0 : ($strom1*100)/$gesamt1;
        $kfz11Pro = ($gesamt1 === 0) ? 0 : ($kfz1*100)/$gesamt1;
        $versicherung1Pro = ($gesamt1 === 0) ? 0 : ($versicherung1*100)/$gesamt1;
        $staat1Pro = ($gesamt1 === 0) ? 0 : ($staat1*100)/$gesamt1;
        $medien1Pro = ($gesamt1 === 0) ? 0 : ($medien1*100)/$gesamt1;
        $spass1Pro = ($gesamt1 === 0) ? 0 : ($spass1*100)/$gesamt1;
        $sonstiges1Pro = ($gesamt1 === 0) ? 0 : ($sonstiges1*100)/$gesamt1;
        $ges2Pro = 100;
        $gehalt2Pro = ($gesamt2 === 0) ? 0 : ($gehalt2*100)/$gesamt2;
        $miete2Pro = ($gesamt2 === 0) ? 0 : ($miete2*100)/$gesamt2;
        $strom2Pro = ($gesamt2 === 0) ? 0 : ($strom2*100)/$gesamt2;
        $kfz12Pro = ($gesamt2 === 0) ? 0 : ($kfz2*100)/$gesamt2;
        $versicherung2Pro = ($gesamt2 === 0) ? 0 : ($versicherung2*100)/$gesamt2;
        $staat2Pro = ($gesamt2 === 0) ? 0 : ($staat2*100)/$gesamt2;
        $medien2Pro = ($gesamt2 === 0) ? 0 : ($medien2*100)/$gesamt2;
        $spass2Pro = ($gesamt2 === 0) ? 0 : ($spass2*100)/$gesamt2;
        $sonstiges2Pro = ($gesamt2 === 0) ? 0 : ($sonstiges2*100)/$gesamt2;

        $this->auswertungBeschreibung = array("Gehalt", "Miete", "Strom", "KFZ", "Versicherung", "Staat", "Medien", "Spass", "Sonstiges", "Gesamt");
        $this->auswertungData = array (
            array(
                array($gehalt1, $miete1, $strom1, $kfz1, $versicherung1, $staat1, $medien1, $spass1, $sonstiges1, $gesamt1),
                array($gehalt1Pro, $miete1Pro, $strom1Pro, $kfz11Pro, $versicherung1Pro, $staat1Pro, $medien1Pro, $spass1Pro, $sonstiges1Pro, $ges1Pro)
            ),
            array(
                array($gehalt2, $miete2, $strom2, $kfz2, $versicherung2, $staat2, $medien2, $spass2, $sonstiges2, $gesamt2),
                array($gehalt2Pro, $miete2Pro, $strom2Pro, $kfz12Pro, $versicherung2Pro, $staat2Pro, $medien2Pro, $spass2Pro, $sonstiges2Pro, $ges2Pro)
            )
        );

    }
}

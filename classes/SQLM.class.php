<?php
class SQLM extends SQLConn {
    public function newBuchung ($datum, $typ, $kategorie, $betrag, $freitext, $vorlage, $bezeichnung) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("INSERT INTO data (Datum, Betrag, Art, KID, Freitext) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $datum);
        $stmt->bindParam(2, $betrag);
        $stmt->bindParam(3, $typ);
        $stmt->bindParam(4, $kategorie);
        $stmt->bindParam(5, $freitext);
        $stmt->execute();

        if($vorlage == 1) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("INSERT INTO vorlage (Bezeichnung, Verweis) VALUES (?,?)");
            $stmt->bindParam(1, $bezeichnung);
            $stmt->bindParam(2, $id);
            $idArray = $pdo->query("SELECT MAX(ID) AS ID FROM data")->fetch();
            $id = $idArray['ID'];
            $stmt->execute();
        }
    }

    public function selectAllWithKategorie() {
        $pdo = $this->connect();
        return $pdo->query(
            "SELECT data.ID as ID, data.Datum as Datum, data.Betrag as Betrag, 
       kategorie.Bezeichnung as Bezeichnung, data.KID as KID, data.Art as Art 
FROM data JOIN kategorie ON data.KID = kategorie.ID ORDER BY data.Datum"
        )->fetchAll();
    }

    public function selectAllWhereDataBetween($sdate, $edate) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM data WHERE Datum BETWEEN ? AND ?");
        $stmt->execute([$sdate, $edate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllWhereDataBetweenWithJoin($sdate, $edate) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT data.ID as ID, data.Datum as Datum, data.Betrag as Betrag, 
       kategorie.Bezeichnung as Bezeichnung, data.KID as KID, data.Art as Art 
FROM data JOIN kategorie ON data.KID = kategorie.ID WHERE data.Datum BETWEEN ? AND ? ORDER BY data.Datum");
        $stmt->execute([$sdate, $edate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAlleVorlagen() {
        $pdo = $this->connect();
        return $pdo->query("SELECT * FROM vorlage JOIN data ON vorlage.Verweis = data.ID")->fetchAll();
    }

    public function selectDataWhereID($id) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM data WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateData($datum, $typ, $kategorie, $betrag, $freitext, $id) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE data SET Datum = ?, Betrag = ?, Art = ?, KID = ?, Freitext = ?WHERE ID = ?;");
        $stmt->bindParam(1, $datum);
        $stmt->bindParam(2, $betrag);
        $stmt->bindParam(3, $typ);
        $stmt->bindParam(4, $kategorie);
        $stmt->bindParam(5, $freitext);
        $stmt->bindParam(6, $id);
        $stmt->execute();
    }

    public function deleteData($id) {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("DELETE FROM data WHERE ID = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
?>

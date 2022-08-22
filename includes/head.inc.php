<?php
session_start();
// $controller führt alles aus, was Formulare angeht
$controller = new Contr();
$controller->splitter();
?>
<!doctype html>
<html lang="de">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="stylesheet" href="css/style.css"> -->
    <title>Haushaltskasse</title>
</head>
<body>
<div class="background-overlay">
    <br>
    <div class="main-headline" style="background-color: dimgray; color: white">
        <h1>Haushaltskasse</h1>
    </div>
    <br>
    <div class="div-main">
        <br>
        <button class="btn-vorlagen" onclick="document.getElementById('vorlagen').style.display='block'">Vorlagen</button>
        <button class="btn-auswertung" onclick="document.getElementById('auswertung').style.display='block'">Auswertung</button>
        <button class="btn-plus" onclick="document.getElementById('buchung').style.display='block'">Buchung</button>
        <br>
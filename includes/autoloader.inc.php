<?php
// registriert die angesprochene Funktion im Autoloader
spl_autoload_register('classesAutoLoader');

function classesAutoLoader($className)
{
    // Da die Funktion voraussichtlich aus dem Hauptverzeichnis aufgerufen wird, ist der Path classes/
    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path.$className.$extension;

    // Sollte die Datei nicht existieren wird geprüft, ob man sich in einem Unterverzeichnis befindet
    if(!file_exists($fullPath)) {
        $fullPath = "../".$path.$className.$extension;
        // Wird die Datei immer noch nicht gefunden, wird false gemeldet.
        if(!file_exists($fullPath)) {
            return false;
        }
    }
    // Der Pfad zur Klasse wird EINMAL hinzugefügt
    include_once $fullPath;
    // return true wenn alles geklappt hat
    return true;
}

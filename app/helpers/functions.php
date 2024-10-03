<?php

/**
 * Functie voor het loggen van de errors die ontstaan door try-catch
 * De volgende zaken worden gelogd
 * - Errormessage van de fout
 * - datum en tijd wanneer de fout is opgetreden
 * - bestand waar de fout is opgetreden
 * - regelnummer van de fout
 * - method waarin de fout is opgetreden
 * - ip-adres van de veroorzaker van de fout
 */

function logger($line, $method, $file, $error)
{
    /**
     * We gaan de tijd toevoegen waarop de error plaatsvond
     */
    date_default_timezone_set('Europe/Amsterdam');
    $time = "Datum/tijd: " . date('d-m-Y H:i:s', time()) . "\t";

    /**
     * De error uit de code
     */
    $error = "De error is: " . $error . "\t";

    /**
     * Het ip-adres van degene die de error veroorzaakt
     */
    $remote_ip = "Remote IP-adres: " . $_SERVER['REMOTE_ADDR'] . "\t";

    /**
     * Filename waar de error heeft plaatsgevonden.
     */
    $filename = "Filename: " . $file . "\t";

    /**
     * Methodname waar de error heeft plaatsgevonden.
     */
    $methodname = "Methodname: " . $method . "\t";

    /**
     * Regelnummer waar de fout heeft plaatsgevonden
     */
    $linenumber = "Linenumber: " . $line . "\t";

    /**
     * Regel met info over de error die wordt opgeslagen in het log-bestand
     */
    $content = $time . $remote_ip . $error . $filename . $methodname . $linenumber . "\r";

    /**
     * Hier definiëren we een logbestand en het pad ernaartoe
     */
    $pathToLogFile = APPROOT . "/logs/nonfunctionallog.txt";

    /**
     * Check of het bestand bestaat. Als dat niet zo is dan wordt het bestand aangemaakt
     * en er wordt een kopje ingezet Non Functional Log
     */
    if (!file_exists($pathToLogFile)) {
        file_put_contents($pathToLogFile, "Non Functional Log\r");
    }

    /**
     * Hier wordt de error weggeschreven in het log-bestand op een nieuwe regel
     */
    file_put_contents($pathToLogFile, $content, FILE_APPEND);
}
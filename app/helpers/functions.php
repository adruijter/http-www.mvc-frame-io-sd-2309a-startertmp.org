<?php

/**
 * Functie voor het loggen van de errors die ontstaan door try-catch
 * De volgende zaken worden gelogd
 * - Errormessage van de fout
 * - datum en tijd wanneer de fout is opgetreden
 * - bestand waar de fout is opgetreden
 * - regelnummer van de fout
 * - method waarin de fout is opgetreden
 */

function logger()
{
    /**
     * We gaan de tijd toevoegen waarop de error plaatsvond
     */
    date_default_timezone_set('Europe/Amsterdam');
    $time = date('d-m-Y H:i:s', time());
    echo "<p>$time</p>";
}
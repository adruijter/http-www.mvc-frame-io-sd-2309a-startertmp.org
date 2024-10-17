<?php
    /**
     * We includen hier alle libraries die we nodig hebben
     * voor het mvc-framework
     */
    require_once 'libraries/Core.php';
    require_once 'libraries/BaseController.php';
    require_once 'libraries/Database.php';
    require_once 'helpers/functions.php';
    require_once 'validators/CountriesValidator.php';
    require_once 'config/config.php';
    require_once 'config/constants.php';
    require_once 'helpers/messages.php';

    /**
     * Maak een instantie of object van de Core-Class
     */
    $init = new Core();

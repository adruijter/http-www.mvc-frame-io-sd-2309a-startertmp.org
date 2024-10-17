<?php

class CountriesValidator
{
    public static function validateCountriesInputFields($data)
    {
        if ( empty($data['country'])) {
            $data['countryError'] = "U bent verplicht een land in te vullen";
        }
        if ( strlen($data['country']) > 30) {
            $data['countryError'] = "Uw land heeft meer letters dan is toegestaan (minder 9 is toegestaan) kies een ander land";
        }
        if ( empty($data['capitalCity'])) {
            $data['capitalCityError'] = "U bent verplicht een hoofdstad in te vullen";
        }
        if ( empty($data['continent'])) {
            $data['continentError'] = "U bent verplicht een continent in te vullen";
        }
        if ( empty($data['population'])) {
            $data['populationError'] = "U bent verplicht het aantal inwoners in te vullen";
        }
        if ( !is_numeric($data['population']))
        {
            $data['populationError'] = "U bent verplicht een numeriek getal in te vullen";
        }
        if ( $data['population'] < 0 || $data['population'] > 4294967295) {
            $data['populationError'] = "Uw aantal inwoners is te groot of negatief";
        }
        if  (!in_array($data['continent'], CONTINENTS)) {
            $data['continentError'] = "Het door u opgegeven continent bestaat niet, kies er een uit de lijst";
        }
        
        // Hier komt de validatie voor de postcode met behulp van de preg_match functie en regular expressions 
        if (!preg_match('/^\d{4}[a-zA-Z]{2}$/', $data['zipcode'])) {
            $data['zipcodeError'] = "De postcode moet bestaan uit 4 cijfers en 2 letters";
        }

        if (
            empty($data['countryError']) 
            && empty($data['capitalCityError'])
            && empty($data['continentError'])
            && empty($data['populationError'])
            && empty($data['zipcodeError'])
        ) {
            $data['isValidView'] = true;
        } else {
            $data['isValidView'] = false;
        }

        return $data;
    }
}
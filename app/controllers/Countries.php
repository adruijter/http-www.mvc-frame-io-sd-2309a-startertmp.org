<?php

class Countries extends BaseController
{
    private $countryModel;

    public function __construct()
    {
        $this->countryModel = $this->model('Country');
    }

    public function index()
    {
        $data = [
            'title' => 'Landen van de Wereld',
            'dataRows' => NULL,
            'message' => NULL,
            'messageColor' => NULL,
            'visibility' => 'display:none'
        ];

        $countries = $this->countryModel->getCountries();

        if (is_null($countries)) {
            //Foutmelding en in de tabel geen records
            $data['message'] = TRY_CATCH_ERROR;
            $data['messageColor'] = FORM_DANGER_COLOR;
            $data['visibility'] = '';
            $data['dataRows'] = NULL;
            
            header('Refresh:3; ' . URLROOT . '/homepages/index');
        } else {
                $data['dataRows'] = $countries;
        }       

        $this->view('countries/index', $data);
    }

    /**
     * Creates a new country.
     *
     * This method is responsible for rendering the create view and passing the necessary data to it.
     *
     * @return void
     */
    public function create()
    {
        $data = [
            'title' => 'Voeg een nieuw land toe',
            'message' => '',
            'messageColor' => 'dark',
            'visibility' => 'display:none;',
            'disableButton' => '',
            'country' => '',
            'capitalCity' => '',
            'continent' => '',
            'population' => '',
            'zipcode' => '',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            /**
             * Maak het $_POST-array schoon van ongewenste tekens en tags
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /**
             * Doe de post-waarden in het $data array
             */
            $data['country'] = trim($_POST['country']);
            $data['capitalCity'] = trim($_POST['capitalCity']);
            $data['continent'] = trim($_POST['continent']);
            $data['population'] = trim($_POST['population']);
            $data['zipcode'] = trim($_POST['zipcode']);

 
            /**
             * Valideer de formuliervelden
             */
            $data = $this->validateCreateCountry($data);
            
            /**
             * We checken of er geen Validatie Errors zijn
             */
            if (
                empty($data['countryError']) 
                && empty($data['capitalCityError'])
                && empty($data['continentError'])
                && empty($data['populationError'])
                && empty($data['zipcodeError'])
            ) {
                /**
                 * Roep de createCountry methode aan van het countryModel object waardoor
                 * de gegevens in de database worden opgeslagen
                 */
                $result = $this->countryModel->createCountry($_POST);

                /**
                 * Als er een fout is in de modelmethod dan wordt dit gelogd en gemeld
                 * aan de gebruiker
                 */
                if (is_null($result)) {
                    $data['visibility'] = 'flex';
                    $data['message'] = ERROR_SP_CREATE_COUNTRY;
                    $data['messageColor'] = FORM_DANGER_COLOR;
                    $data['disableButton'] = 'disabled';
                } else {
                    $data['visibility'] = '';
                    $data['message'] = FORM_SUCCESS;
                    $data['messageColor'] = FORM_SUCCESS_COLOR;

                }
                /**
                 * Na het opslaan van de formulier wordt de gebruiker teruggeleid naar de index-pagina
                 */
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['visibility'] = '';
                $data['message'] = FORM_DANGER;
                $data['messageColor'] = FORM_DANGER_COLOR;

                $this->view('countries/create', $data);
            }
        }

        $this->view('countries/create', $data);
    }

    public function validateCreateCountry($data)
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
        return $data;
    }

    public function update($countryId)
    {
        $result = $this->countryModel->getCountry($countryId) ?? header("Refresh:3; url=" . URLROOT . "/countries/index");

        $data = [
            'title' => 'Wijzig land',
            'message' => is_null($result) ? 'Er is een fout opgetreden, wijzigen is niet mogelijk' : '',
            'messageVisibility' => is_null($result) ? 'flex' : 'none',
            'messageColor' => is_null($result) ? 'danger' : '',
            'disableButton' => is_null($result) ? 'disabled' : '',
            'Id' => $result->Id ?? '',
            'country' => $result->Name ?? '-',
            'capitalCity' => $result->CapitalCity ?? '-',
            'continent' => $result->Continent ?? '-',
            'population' => $result->Population ?? '-',
            'zipcode' => $result->Zipcode ?? '-',
            'countryError' => '',
            'capitalCityError' => '',
            'continentError' => '',
            'populationError' => '',
            'zipcodeError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data['country'] = trim($_POST['country']);
            $data['capitalCity'] = trim($_POST['capitalCity']);
            $data['continent'] = trim($_POST['continent']);
            $data['population'] = trim($_POST['population']);
            $data['zipcode'] = trim($_POST['zipcode']);

            $data = $this->validateCreateCountry($data);

            /**
             * Wanneer alle error-key values leeg zijn dan kunnen we de update uitvoeren
             */

            if (
                empty($data['countryError'])
                && empty($data['capitalCityError'])
                && empty($data['continentError'])
                && empty($data['populationError'])
                && empty($data['zipcodeError'])
            ) {
                $result = $this->countryModel->updateCountry($_POST);

                if (is_null($result)) {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Het updaten is niet gelukt';
                    $data['messageColor'] = 'danger';
                    $data['disableButton'] = 'disabled';
                } else {
                    $data['messageVisibility'] = 'flex';
                    $data['message'] = 'Het updaten is gelukt';
                    $data['messageColor'] = 'success';
                }
                header("Refresh:3; url=" . URLROOT . "/countries/index");
            } else {
                $data['messageVisibility'] = 'flex';
                $data['message'] = 'U heeft enkele verkeerde waardes ingevuld';
                $data['messageColor'] = 'danger';
            }
            $this->view('countries/update', $data);            
            // header("Refresh:3; url=" . URLROOT . "/countries/index");
        }
            
            
            
            
        

        $this->view('countries/update', $data);
    }

    public function delete($countryId)
    {
       $result = $this->countryModel->deleteCountry($countryId);

       $data = [
           'message' => 'Het record is verwijderd. U wordt doorgestuurd naar de index-pagina.'
       ];

       header("Refresh:1; " . URLROOT . "/countries/index");

       $this->view('countries/delete', $data);
    }
} 